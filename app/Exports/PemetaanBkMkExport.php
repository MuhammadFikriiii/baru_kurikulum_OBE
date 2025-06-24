<?php

namespace App\Exports;

use App\Models\BahanKajian;
use App\Models\Prodi;
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
    protected $idTahun;
    protected $namaProdi;

    public function __construct($kodeProdi, $idTahun)
    {
        $this->kodeProdi = $kodeProdi;
        $this->idTahun = $idTahun;
        $this->namaProdi = Prodi::where('kode_prodi', $kodeProdi)->value('nama_prodi') ?? '-';
    }

    public function collection()
    {
        $bks = BahanKajian::whereIn('id_bk', function ($query) {
            $query->select('cpl_bk.id_bk')
                ->from('cpl_bk')
                ->join('cpl_pl', 'cpl_bk.id_cpl', '=', 'cpl_pl.id_cpl')
                ->join('profil_lulusans', 'cpl_pl.id_pl', '=', 'profil_lulusans.id_pl')
                ->where('profil_lulusans.kode_prodi', $this->kodeProdi)
                ->when($this->idTahun, function ($q) {
                    $q->where('profil_lulusans.id_tahun', $this->idTahun);
                });
        })->orderBy('kode_bk')->get();

        $mks = DB::table('mata_kuliahs')
            ->join('bk_mk', 'mata_kuliahs.kode_mk', '=', 'bk_mk.kode_mk')
            ->join('cpl_mk', 'mata_kuliahs.kode_mk', '=', 'cpl_mk.kode_mk')
            ->join('capaian_profil_lulusans', 'cpl_mk.id_cpl', '=', 'capaian_profil_lulusans.id_cpl')
            ->join('cpl_pl', 'capaian_profil_lulusans.id_cpl', '=', 'cpl_pl.id_cpl')
            ->join('profil_lulusans', 'cpl_pl.id_pl', '=', 'profil_lulusans.id_pl')
            ->where('profil_lulusans.kode_prodi', $this->kodeProdi)
            ->when($this->idTahun, function ($query) {
                $query->where('profil_lulusans.id_tahun', $this->idTahun);
            })
            ->select('mata_kuliahs.kode_mk', 'mata_kuliahs.nama_mk', 'mata_kuliahs.jenis_mk', 'mata_kuliahs.kompetensi_mk')
            ->distinct()
            ->orderBy('mata_kuliahs.kode_mk')
            ->get();

        $relasi = DB::table('bk_mk')->get()->groupBy('kode_mk');

        $data = [];

        foreach ($mks as $mk) {
            $row = [
                'Prodi' => $this->namaProdi,
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
                ->where('profil_lulusans.kode_prodi', $this->kodeProdi)
                ->when($this->idTahun, function ($q) {
                    $q->where('profil_lulusans.id_tahun', $this->idTahun);
                });
        })->orderBy('kode_bk')->get();

        $row1 = ['6. Pemetaan BK-MK', '', '', '', ''];
        foreach ($bks as $bk) {
            $row1[] = '';
        }

        $row2 = ['Prodi', 'Kode', 'Jenis', 'Mata Kuliah', 'Wajib'];
        foreach ($bks as $bk) {
            $row2[] = $bk->kode_bk;
        }

        return [
            $row1,
            $row2
        ];
    }

    public function startCell(): string
    {
        return 'A1';
    }

    public function title(): string
    {
        return 'Pemetaan BK-MK';
    }

    public function styles(Worksheet $sheet)
    {
        $totalCols = count($this->headings()[1]);
        $lastColumn = Coordinate::stringFromColumnIndex($totalCols);
        $lastRow = $sheet->getHighestRow();

        $sheet->mergeCells("A1:{$lastColumn}1");
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(12);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);

        $sheet->getStyle("A2:{$lastColumn}2")->applyFromArray([
            'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '2F6739']],
            'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]],
        ]);

        $sheet->getStyle("A3:{$lastColumn}{$lastRow}")->applyFromArray([
            'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]],
            'alignment' => ['vertical' => Alignment::VERTICAL_CENTER],
        ]);

        $sheet->getStyle("B3:B{$lastRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("C3:C{$lastRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("E3:{$lastColumn}{$lastRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A3:A{$lastRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
        $sheet->getStyle("D3:D{$lastRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);

        return $sheet;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $totalCols = count($this->headings()[1]);
                $lastColumn = Coordinate::stringFromColumnIndex($totalCols);

                $sheet->getColumnDimension('A')->setWidth(20);
                $sheet->getColumnDimension('B')->setWidth(15);
                $sheet->getColumnDimension('C')->setWidth(15);
                $sheet->getColumnDimension('D')->setWidth(35);
                $sheet->getColumnDimension('E')->setWidth(10);

                for ($i = 6; $i <= $totalCols; $i++) {
                    $col = Coordinate::stringFromColumnIndex($i);
                    $sheet->getColumnDimension($col)->setWidth(8);
                }
            },
        ];
    }
}
