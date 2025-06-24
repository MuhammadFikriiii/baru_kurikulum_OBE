<?php

namespace App\Exports;

use App\Models\CapaianProfilLulusan;
use App\Models\BahanKajian;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Border;

class PemetaanCplMkBkExport implements FromCollection, WithHeadings, WithTitle, ShouldAutoSize, WithStyles, WithEvents
{
    protected $kodeProdi;
    protected $idTahun;

    public function __construct($kodeProdi, $idTahun)
    {
        $this->kodeProdi = $kodeProdi;
        $this->idTahun = $idTahun;
    }

    public function collection()
    {
        $cpls = CapaianProfilLulusan::whereIn('id_cpl', function ($query) {
            $query->select('id_cpl')
                ->from('cpl_pl')
                ->join('profil_lulusans as pl', 'cpl_pl.id_pl', '=', 'pl.id_pl')
                ->where('pl.kode_prodi', $this->kodeProdi)
                ->when($this->idTahun, function ($query) {
                    $query->where('pl.id_tahun', $this->idTahun);
                });
        })
            ->orderBy('kode_cpl', 'asc')
            ->get();

        $bks = BahanKajian::whereIn('id_bk', function ($query) {
            $query->select('id_bk')
                ->from('cpl_bk')
                ->join('capaian_profil_lulusans as cpl', 'cpl_bk.id_cpl', '=', 'cpl.id_cpl')
                ->join('cpl_pl', 'cpl.id_cpl', '=', 'cpl_pl.id_cpl')
                ->join('profil_lulusans as pl', 'cpl_pl.id_pl', '=', 'pl.id_pl')
                ->where('pl.kode_prodi', $this->kodeProdi)
                ->when($this->idTahun, function ($query) {
                    $query->where('pl.id_tahun', $this->idTahun);
                });
        })
            ->orderBy('kode_bk', 'asc')
            ->get();

        $mkCplBk = DB::table('mata_kuliahs as mk')
            ->leftJoin('cpl_mk', 'mk.kode_mk', '=', 'cpl_mk.kode_mk')
            ->leftJoin('bk_mk', 'mk.kode_mk', '=', 'bk_mk.kode_mk')
            ->leftJoin('capaian_profil_lulusans as cpl', 'cpl_mk.id_cpl', '=', 'cpl.id_cpl')
            ->leftJoin('cpl_pl', 'cpl.id_cpl', '=', 'cpl_pl.id_cpl')
            ->leftJoin('profil_lulusans as pl', 'cpl_pl.id_pl', '=', 'pl.id_pl')
            ->leftJoin('bahan_kajians as bk', 'bk_mk.id_bk', '=', 'bk.id_bk')
            ->where('pl.kode_prodi', $this->kodeProdi)
            ->when($this->idTahun, function ($query) {
                $query->where('pl.id_tahun', $this->idTahun);
            })
            ->select('cpl_mk.id_cpl', 'bk_mk.id_bk', 'mk.nama_mk')
            ->get();

        $matrix = [];
        foreach ($mkCplBk as $row) {
            if ($row->id_cpl && $row->id_bk) {
                $matrix[$row->id_cpl][$row->id_bk][] = $row->nama_mk;
            }
        }

        $data = collect();

        foreach ($cpls as $cpl) {
            $row = ['CPL' => $cpl->kode_cpl ?? $cpl->id_cpl];
            foreach ($bks as $bk) {
                $bkKey = $bk->kode_bk ?? $bk->id_bk;
                $row[$bkKey] = isset($matrix[$cpl->id_cpl][$bk->id_bk])
                    ? implode("\n", array_unique($matrix[$cpl->id_cpl][$bk->id_bk]))
                    : '-';
            }
            $data[] = $row;
        }

        return $data;
    }

    public function headings(): array
    {
        $bks = BahanKajian::whereIn('id_bk', function ($query) {
            $query->select('id_bk')
                ->from('cpl_bk')
                ->join('capaian_profil_lulusans as cpl', 'cpl_bk.id_cpl', '=', 'cpl.id_cpl')
                ->join('cpl_pl', 'cpl.id_cpl', '=', 'cpl_pl.id_cpl')
                ->join('profil_lulusans as pl', 'cpl_pl.id_pl', '=', 'pl.id_pl')
                ->where('pl.kode_prodi', $this->kodeProdi)
                ->when($this->idTahun, function ($query) {
                    $query->where('pl.id_tahun', $this->idTahun);
                });
        })
            ->orderBy('kode_bk', 'asc')
            ->get();

        $headings = ['CPL / BK'];
        foreach ($bks as $bk) {
            $headings[] = $bk->kode_bk ?? $bk->id_bk;
        }
        return $headings;
    }

    public function title(): string
    {
        return 'Pemetaan CPL-MK-BK';
    }

    public function styles(Worksheet $sheet)
    {
        $lastColumn = $sheet->getHighestColumn();
        $lastRow = $sheet->getHighestRow();
        $range = "A1:{$lastColumn}{$lastRow}";

        $sheet->getStyle($range)->getAlignment()->setWrapText(true);
        $sheet->getStyle($range)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $sheet->getStyle($range)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        return [
            1 => [
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '1E5631'],
                ],
            ],
            $range => [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => ['rgb' => '000000'],
                    ],
                ],
            ],
            'A' => [
                'font' => ['bold' => true],
            ],
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $sheet->insertNewRowBefore(1, 1);
                $sheet->setCellValue('A1', '8. Pemetaan CPL-MK-BK');
            },
        ];
    }
}
