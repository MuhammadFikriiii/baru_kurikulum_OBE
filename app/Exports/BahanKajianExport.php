<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class BahanKajianExport implements 
    FromCollection, 
    WithHeadings, 
    WithStyles, 
    WithColumnWidths, 
    WithTitle,
    WithMapping,
    WithEvents
{
    protected $kodeProdi;

    public function __construct($kodeProdi)
    {
        $this->kodeProdi = $kodeProdi;
    }

    public function collection()
    {
        $data = DB::table('bahan_kajians as bk')
            ->select(
                'bk.kode_bk',
                'bk.nama_bk',
                'bk.deskripsi_bk',
                'bk.referensi_bk',
                'bk.status_bk',
                'bk.knowledge_area',
                'prodis.nama_prodi'
            )
            ->leftJoin('cpl_bk', 'bk.id_bk', '=', 'cpl_bk.id_bk')
            ->leftJoin('capaian_profil_lulusans as cpl', 'cpl_bk.id_cpl', '=', 'cpl.id_cpl')
            ->leftJoin('cpl_pl', 'cpl.id_cpl', '=', 'cpl_pl.id_cpl')
            ->leftJoin('profil_lulusans as pl', 'cpl_pl.id_pl', '=', 'pl.id_pl')
            ->leftJoin('prodis', 'pl.kode_prodi', '=', 'prodis.kode_prodi')
            ->where('prodis.kode_prodi', $this->kodeProdi)
            ->groupBy(
                'bk.kode_bk',
                'bk.nama_bk',
                'bk.deskripsi_bk',
                'bk.referensi_bk',
                'bk.status_bk',
                'bk.knowledge_area',
                'prodis.nama_prodi'
            )
            ->get()
            ->map(function ($item, $key) {
                $item->no = $key + 1;
                return $item;
            });

        return $data;
    }

    public function map($row): array
    {
        return [
            $row->no,
            $row->nama_prodi,
            $row->kode_bk,
            $row->nama_bk,
            $row->deskripsi_bk,
            $row->referensi_bk,
            $row->status_bk,
            $row->knowledge_area,
        ];
    }

    public function headings(): array
    {
        return [
            'NO.',
            'PRODI',
            'KODE BAHAN KAJIAN',
            'NAMA BAHAN KAJIAN',
            'DESKRIPSI',
            'REFERENSI',
            'STATUS',
            'KNOWLEDGE AREA',
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 6,
            'B' => 20,
            'C' => 20,
            'D' => 40,
            'E' => 40,
            'F' => 30,
            'G' => 15,
            'H' => 20,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $lastRow = $sheet->getHighestRow();

        $headerStyle = [
            'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '1E6F41']],
            'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]],
        ];

        $dataStyle = [
            'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]],
            'alignment' => ['vertical' => Alignment::VERTICAL_CENTER, 'wrapText' => true],
        ];

        $sheet->getStyle('A2:H2')->applyFromArray($headerStyle); // Header row
        $sheet->getStyle('A3:H' . $lastRow)->applyFromArray($dataStyle); // Data rows

        $sheet->getRowDimension(1)->setRowHeight(15); // Judul
        $sheet->getRowDimension(2)->setRowHeight(30);
        for ($i = 3; $i <= $lastRow; $i++) {
            $descLength = strlen($sheet->getCell('E' . $i)->getValue());
            if ($descLength > 200) {
                $sheet->getRowDimension($i)->setRowHeight(80);
            } elseif ($descLength > 100) {
                $sheet->getRowDimension($i)->setRowHeight(60);
            }
            
            // Alternating background
            if ($i % 2 == 0) {
                $sheet->getStyle("A{$i}:H{$i}")->getFill()
                    ->setFillType(Fill::FILL_SOLID)
                    ->getStartColor()->setRGB('F0F0F0');
            }
        }

        $sheet->getStyle('A3:A' . $lastRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('B3:B' . $lastRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('C3:C' . $lastRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('G3:G' . $lastRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('D3:D' . $lastRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('F3:F' . $lastRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('H3:H' . $lastRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('E3:E' . $lastRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        return [];
    }

    public function title(): string
    {
        return 'Bahan Kajian';
    }

    public function registerEvents(): array
    {
        return [
            BeforeSheet::class => function (BeforeSheet $event) {
                $sheet = $event->sheet;

                $sheet->setCellValue('A1', '4. Daftar Bahan Kajian');
                $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(10);
            },
        ];
    }
}