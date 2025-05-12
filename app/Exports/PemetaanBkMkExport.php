<?php

namespace App\Exports;

use App\Models\BahanKajian;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;

class PemetaanBkMkExport implements FromCollection, WithHeadings, WithCustomStartCell, WithTitle, WithStyles, WithEvents
{
    protected $kodeProdi;
    protected $namaProdi;

    public function __construct($kodeProdi)
    {
        $this->kodeProdi = $kodeProdi;
        $this->namaProdi = DB::table('prodis')->where('kode_prodi', $kodeProdi)->value('nama_prodi');
    }

    public function collection()
    {
        $bks = BahanKajian::whereIn('id_bk', function ($query) {
            $query->select('cpl_bk.id_bk')
                ->from('cpl_bk')
                ->join('cpl_pl', 'cpl_bk.id_cpl', '=', 'cpl_pl.id_cpl')
                ->join('profil_lulusans', 'cpl_pl.id_pl', '=', 'profil_lulusans.id_pl')
                ->where('profil_lulusans.kode_prodi', $this->kodeProdi);
        })->orderBy('kode_bk')->get();

        $mks = DB::table('mata_kuliahs')
            ->join('bk_mk', 'mata_kuliahs.kode_mk', '=', 'bk_mk.kode_mk')
            ->join('cpl_mk', 'mata_kuliahs.kode_mk', '=', 'cpl_mk.kode_mk')
            ->join('capaian_profil_lulusans', 'cpl_mk.id_cpl', '=', 'capaian_profil_lulusans.id_cpl')
            ->join('cpl_pl', 'capaian_profil_lulusans.id_cpl', '=', 'cpl_pl.id_cpl')
            ->join('profil_lulusans', 'cpl_pl.id_pl', '=', 'profil_lulusans.id_pl')
            ->where('profil_lulusans.kode_prodi', $this->kodeProdi)
            ->select('mata_kuliahs.kode_mk', 'mata_kuliahs.nama_mk', 'mata_kuliahs.jenis_mk', 'mata_kuliahs.kompetensi_mk')
            ->distinct()
            ->orderBy('mata_kuliahs.kode_mk')
            ->get();

        $relasi = DB::table('bk_mk')->get()->groupBy('kode_mk');

        $data = [];

        foreach ($mks as $mk) {
            $row = [
                'Prodi' => $this->namaProdi,  // ✅ Menggunakan nama_prodi
                'Kode' => $mk->kode_mk,
                'Jenis' => $mk->jenis_mk ?? '',
                'Mata Kuliah' => $mk->nama_mk,
                'Wajib' => ($mk->kompetensi_mk === 'utama') ? 'v' : '',
            ];

            foreach ($bks as $bk) {
                $terkait = isset($relasi[$mk->kode_mk]) &&
                           in_array($bk->id_bk, $relasi[$mk->kode_mk]->pluck('id_bk')->toArray());

                $row[$bk->kode_bk] = $terkait ? 'v' : '';
            }

            $data[] = $row;
        }

        return new Collection($data);
    }

    public function headings(): array
    {
        $bks = BahanKajian::whereIn('id_bk', function ($query) {
            $query->select('cpl_bk.id_bk')
                ->from('cpl_bk')
                ->join('cpl_pl', 'cpl_bk.id_cpl', '=', 'cpl_pl.id_cpl')
                ->join('profil_lulusans', 'cpl_pl.id_pl', '=', 'profil_lulusans.id_pl')
                ->where('profil_lulusans.kode_prodi', $this->kodeProdi);
        })->orderBy('kode_bk')->get();

        $headers = ['Prodi', 'Kode', 'Jenis', 'Mata Kuliah', 'Wajib'];
        foreach ($bks as $bk) {
            $headers[] = $bk->kode_bk;
        }

        return $headers;
    }

    public function startCell(): string
    {
        return 'A2';
    }

    public function title(): string
    {
        return 'Pemetaan BK-MK';
    }

    public function styles(Worksheet $sheet)
    {
        $totalCols = count($this->headings());
        $lastColumn = Coordinate::stringFromColumnIndex($totalCols);

        // ✅ Judul baris 1
        $sheet->setCellValue('A1', '6. Pemetaan BK-MK');
        $sheet->mergeCells("A1:{$lastColumn}1");

        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A1')->getFill()->setFillType(Fill::FILL_SOLID)
            ->getStartColor()->setRGB('FFFFFF');

        return [
            1 => ['font' => ['bold' => true, 'size' => 14]],
            2 => ['font' => ['bold' => true]],  // ✅ Header berada di baris 2
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                $totalCols = count($this->headings());
                $totalRows = count($this->collection()) + 2;  // ✅ Data mulai baris 3
                $lastColumn = Coordinate::stringFromColumnIndex($totalCols);

                // ✅ Header styling baris 2
                $sheet->getStyle("A2:{$lastColumn}2")->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'color' => ['rgb' => 'FFFFFF'],
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                    ],
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => '1E5631'],
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => '000000'],
                        ],
                    ],
                ]);

                // ✅ Isi tabel dari baris 3 ke bawah
                $sheet->getStyle("A3:{$lastColumn}{$totalRows}")->applyFromArray([
                    'alignment' => [
                        'vertical' => Alignment::VERTICAL_CENTER,
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'wrapText' => true,
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => '000000'],
                        ],
                    ],
                ]);

                // Auto width
                for ($i = 1; $i <= $totalCols; $i++) {
                    $col = Coordinate::stringFromColumnIndex($i);
                    $sheet->getColumnDimension($col)->setAutoSize(true);
                }

                // Auto height untuk semua baris
                for ($i = 2; $i <= $totalRows; $i++) {
                    $sheet->getRowDimension($i)->setRowHeight(-1);
                }
            },
        ];
    }
}