<?php

namespace App\Exports;

use Illuminate\Support\Collection;
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
use App\Models\CapaianProfilLulusan;
use App\Models\MataKuliah;
use Illuminate\Support\Facades\DB;

class PemetaanCplMkExport implements FromCollection, WithHeadings, WithCustomStartCell, WithTitle, WithStyles, WithEvents
{
    protected $kodeProdi;
    protected $namaProdi;
    protected $cpls;
    protected $mks;
    protected $relasi;
    protected $idTahun;

    public function __construct($kodeProdi, $idTahun)
    {
        $this->kodeProdi = $kodeProdi;
        $this->idTahun = $idTahun;
        $this->namaProdi = DB::table('prodis')->where('kode_prodi', $kodeProdi)->value('nama_prodi');

        // Get CPLs for this program
        $this->cpls = CapaianProfilLulusan::whereIn('id_cpl', function ($query) use ($kodeProdi) {
            $query->select('id_cpl')
                  ->from('cpl_pl')
                  ->join('profil_lulusans', 'cpl_pl.id_pl', '=', 'profil_lulusans.id_pl')
                  ->where('profil_lulusans.kode_prodi', $kodeProdi)
                  ->when($this->idTahun, function ($query) {
                      $query->where('profil_lulusans.id_tahun', $this->idTahun);
                  });
        })->orderBy('kode_cpl', 'asc')->get();

        // Get MKs for this program
        $this->mks = MataKuliah::whereIn('kode_mk', function ($query) use ($kodeProdi) {
            $query->select('kode_mk')
                  ->from('cpl_mk')
                  ->join('capaian_profil_lulusans', 'cpl_mk.id_cpl', '=', 'capaian_profil_lulusans.id_cpl')
                  ->join('cpl_pl', 'capaian_profil_lulusans.id_cpl', '=', 'cpl_pl.id_cpl')
                  ->join('profil_lulusans', 'cpl_pl.id_pl', '=', 'profil_lulusans.id_pl')
                  ->where('profil_lulusans.kode_prodi', $kodeProdi)
                  ->when($this->idTahun, function ($query) {
                      $query->where('profil_lulusans.id_tahun', $this->idTahun);
                  });
        })->orderBy('kode_mk', 'asc')->get();

        // Get mapping relations
        $this->relasi = DB::table('cpl_mk')->get()->groupBy('kode_mk');
    }

    public function collection()
    {
        $data = new Collection();

        foreach ($this->mks as $mk) {
            $row = [
                'Prodi' => $this->namaProdi,
                'Kode' => $mk->kode_mk,
                'Mata Kuliah' => $mk->nama_mk,
                'Wajib' => ($mk->kompetensi_mk === 'utama') ? 'v' : '',
            ];

            foreach ($this->cpls as $cpl) {
                $terkait = isset($this->relasi[$mk->kode_mk]) &&
                           in_array($cpl->id_cpl, $this->relasi[$mk->kode_mk]->pluck('id_cpl')->toArray());

                $row[$cpl->kode_cpl] = $terkait ? 'v' : '';
            }

            $data[] = $row;
        }

        return $data;
    }

    public function headings(): array
    {
        $row1 = ['7. Pemetaan CPL-MK', '', '', '', ''];
        foreach ($this->cpls as $cpl) {
            $row1[] = '';
        }

        $row2 = ['Prodi', 'Kode', 'Mata Kuliah', 'Wajib'];
        foreach ($this->cpls as $cpl) {
            $row2[] = $cpl->kode_cpl;
        }

        return [$row1, $row2];
    }

    public function startCell(): string
    {
        return 'A1';
    }

    public function title(): string
    {
        return 'Pemetaan CPL-MK';
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
                'startColor' => ['rgb' => '2F6739'],
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                ],
            ],
        ]);

        $sheet->getStyle("A3:{$lastColumn}{$lastRow}")->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                ],
            ],
            'alignment' => [
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ]);

        $sheet->getStyle("A3:A{$lastRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("B3:B{$lastRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("D3:D{$lastRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("E3:{$lastColumn}{$lastRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        return [];
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
                $sheet->getColumnDimension('C')->setWidth(35);
                $sheet->getColumnDimension('D')->setWidth(10);

                for ($i = 5; $i <= $totalCols; $i++) {
                    $col = Coordinate::stringFromColumnIndex($i);
                    $sheet->getColumnDimension($col)->setWidth(8);
                }
            },
        ];
    }
}
