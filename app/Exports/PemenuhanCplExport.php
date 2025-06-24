<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;

class PemenuhanCplExport implements FromArray, WithHeadings, WithTitle, WithStyles
{
    protected $kodeProdi;
    protected $idTahun;

    public function __construct($kodeProdi, $idTahun)
    {
        $this->kodeProdi = $kodeProdi;
        $this->idTahun = $idTahun;
    }

    public function array(): array
    {
        $dataCPL = DB::table('capaian_profil_lulusans as cpl')
            ->join('cpl_pl', 'cpl.id_cpl', '=', 'cpl_pl.id_cpl')
            ->join('profil_lulusans as pl', 'cpl_pl.id_pl', '=', 'pl.id_pl')
            ->where('pl.kode_prodi', $this->kodeProdi)
            ->when($this->idTahun, function ($query) {
                $query->where('pl.id_tahun', $this->idTahun);
            })
            ->select('cpl.id_cpl', 'cpl.kode_cpl')
            ->get();

        $mkCPL = DB::table('cpl_mk')
            ->join('mata_kuliahs as mk', 'cpl_mk.kode_mk', '=', 'mk.kode_mk')
            ->join('capaian_profil_lulusans as cpl', 'cpl_mk.id_cpl', '=', 'cpl.id_cpl')
            ->join('cpl_pl', 'cpl.id_cpl', '=', 'cpl_pl.id_cpl')
            ->join('profil_lulusans as pl', 'cpl_pl.id_pl', '=', 'pl.id_pl')
            ->where('pl.kode_prodi', $this->kodeProdi)
            ->when($this->idTahun, function ($query) {
                $query->where('pl.id_tahun', $this->idTahun);
            })
            ->select('cpl.id_cpl', 'mk.nama_mk', 'mk.semester_mk')
            ->get()
            ->groupBy('id_cpl');

        $rows = [];

        foreach ($dataCPL as $item) {
            $row = [$item->kode_cpl];

            for ($i = 1; $i <= 8; $i++) {
                $semesterMks = $mkCPL->get($item->id_cpl)?->filter(fn($mk) => $mk->semester_mk == $i)
                    ->pluck('nama_mk')
                    ->unique()
                    ->toArray() ?? [];

                $row[] = implode("\n", $semesterMks);
            }

            $rows[] = $row;
        }

        return $rows;
    }

    public function headings(): array
    {
        return array_merge(['CPL'], array_map(fn($i) => "Semester $i", range(1, 8)));
    }

    public function title(): string
    {
        return 'Pemenuhan CPL';
    }

    public function styles(Worksheet $sheet)
    {
        // Insert judul baris 1
        $sheet->insertNewRowBefore(1, 1);
        $sheet->setCellValue('A1', '11. Pemenuhan CPL');
        $sheet->mergeCells('A1:I1');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);

        // Header baris 2
        $headerRange = 'A2:I2';
        $sheet->getStyle($headerRange)->getFont()->setBold(true)->getColor()->setRGB('FFFFFF');
        $sheet->getStyle($headerRange)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('226C32');
        $sheet->getStyle($headerRange)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle($headerRange)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);

        // Auto wrap dan align untuk seluruh tabel (baris 3 ke bawah)
        $lastRow = $sheet->getHighestRow();
        $sheet->getStyle("A3:I{$lastRow}")->applyFromArray([
            'alignment' => [
                'wrapText' => true,
                'vertical' => Alignment::VERTICAL_TOP,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                ],
            ],
        ]);

        // Kolom CPL center
        $sheet->getStyle("A3:A{$lastRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Kolom semester kiri
        foreach (range('B', 'I') as $col) {
            $sheet->getColumnDimension($col)->setWidth(30);
            $sheet->getStyle("{$col}3:{$col}{$lastRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
        }

        return [];
    }
}
