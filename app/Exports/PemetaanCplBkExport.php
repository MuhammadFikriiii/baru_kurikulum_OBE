<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Maatwebsite\Excel\Events\BeforeSheet;
use Maatwebsite\Excel\Events\AfterSheet;

class PemetaanCplBkExport implements FromArray, WithHeadings, WithTitle, WithEvents
{
    protected $kodeProdi;
    protected $idTahun;
    protected $bks;
    protected $cpls;
    protected $relasi;

    public function __construct($kodeProdi, $idTahun)
    {
        $this->kodeProdi = $kodeProdi;
        $this->idTahun = $idTahun;

        $this->bks = DB::table('bahan_kajians as bk')
            ->select('bk.id_bk', 'bk.kode_bk')
            ->leftJoin('cpl_bk', 'bk.id_bk', '=', 'cpl_bk.id_bk')
            ->leftJoin('capaian_profil_lulusans as cpl', 'cpl_bk.id_cpl', '=', 'cpl.id_cpl')
            ->leftJoin('cpl_pl', 'cpl.id_cpl', '=', 'cpl_pl.id_cpl')
            ->leftJoin('profil_lulusans as pl', 'cpl_pl.id_pl', '=', 'pl.id_pl')
            ->where('pl.kode_prodi', $this->kodeProdi)
            ->when($this->idTahun, function ($query) {
                $query->where('pl.id_tahun', $this->idTahun);
            })
            ->distinct()
            ->orderBy('bk.kode_bk')
            ->get();

        $this->cpls = DB::table('capaian_profil_lulusans as cpl')
            ->select('cpl.id_cpl', 'cpl.kode_cpl', 'cpl.deskripsi_cpl')
            ->leftJoin('cpl_pl', 'cpl.id_cpl', '=', 'cpl_pl.id_cpl')
            ->leftJoin('profil_lulusans as pl', 'cpl_pl.id_pl', '=', 'pl.id_pl')
            ->where('pl.kode_prodi', $this->kodeProdi)
            ->when($this->idTahun, function ($query) {
                $query->where('pl.id_tahun', $this->idTahun);
            })
            ->distinct()
            ->orderBy('cpl.kode_cpl')
            ->get();

        $this->relasi = DB::table('cpl_bk')
            ->select('id_cpl', 'id_bk')
            ->get()
            ->groupBy('id_cpl');
    }

    public function array(): array
    {
        $data = [];

        foreach ($this->cpls as $cpl) {
            $row = [
                $cpl->deskripsi_cpl,
                $cpl->kode_cpl,
            ];

            foreach ($this->bks as $bk) {
                $hasRelasi = isset($this->relasi[$cpl->id_cpl]) &&
                    $this->relasi[$cpl->id_cpl]->pluck('id_bk')->contains($bk->id_bk);
                $row[] = $hasRelasi ? '✓' : '';
            }

            $data[] = $row;
        }

        return $data;
    }

    public function headings(): array
    {
        $headings = ['Deskripsi CPL', 'Kode CPL'];
        foreach ($this->bks as $bk) {
            $headings[] = $bk->kode_bk;
        }
        return $headings;
    }

    public function title(): string
    {
        return 'Pemetaan CPL-BK';
    }

    public function registerEvents(): array
    {
        return [
            BeforeSheet::class => function (BeforeSheet $event) {
                $event->sheet->setCellValue('A1', '5. Pemetaan CPL - BK');
                $lastColumn = $event->sheet->getHighestColumn();
                $event->sheet->mergeCells("A1:{$lastColumn}1");
                $event->sheet->getStyle("A1")->getFont()->setBold(true)->setSize(10);
            },

            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet;

                $totalCols = count($this->bks) + 2;
                $totalRows = count($this->cpls) + 2;
                $lastCol = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($totalCols);

                $sheet->getStyle("A2:{$lastCol}2")->applyFromArray([
                    'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
                    'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '1E5631']],
                    'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => '000000']]],
                ]);

                $sheet->getStyle("A3:{$lastCol}{$totalRows}")->applyFromArray([
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
                    'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => '000000']]],
                ]);

                $sheet->getStyle("A3:A{$totalRows}")
                    ->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_JUSTIFY)
                    ->setWrapText(true);

                for ($row = 3; $row <= $totalRows; $row++) {
                    $sheet->getRowDimension($row)->setRowHeight(90);
                }

                $sheet->getColumnDimension('A')->setWidth(50);

                for ($i = 2; $i <= $totalCols; $i++) {
                    $col = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($i);
                    $sheet->getColumnDimension($col)->setAutoSize(true);
                }
            }
        ];
    }
}
