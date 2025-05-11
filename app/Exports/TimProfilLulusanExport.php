<?php

namespace App\Exports;

use App\Models\ProfilLulusan;
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

class TimProfilLulusanExport implements 
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
        $data = ProfilLulusan::where('kode_prodi', $this->kodeProdi)
            ->with('prodi')
            ->get();
            
        // Add row number to each item
        $counter = 1;
        $data->each(function($item) use (&$counter) {
            $item->row_num = $counter++;
        });
        
        return $data;
    }
    
    public function map($item): array
    {
        return [
            $item->kode_pl,
            $item->prodi->nama_prodi ?? '-',
            $item->deskripsi_pl,
            $item->profesi_pl,
            $item->unsur_pl,
            $item->keterangan_pl,
            $item->sumber_pl,
        ];
    }

    public function headings(): array
    {
        return [
            'KODE PROFIL LULUSAN',
            'PRODI',
            'DESKRIPSI PROFIL LULUSAN',
            'PROFESI',
            'UNSUR',
            'KETERANGAN',
            'SUMBER'
        ];
    }
    
    // Menentukan lebar kolom spesifik berdasarkan konten
    public function columnWidths(): array
    {
        return [
            'A' => 12,     // Kode Profil Lulusan
            'B' => 20,     // Prodi
            'C' => 40,     // Deskripsi Profil Lulusan
            'D' => 35,     // Profesi
            'E' => 12,     // Unsur
            'F' => 25,     // Keterangan
            'G' => 15,     // Sumber
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Get last row
        $lastRow = $sheet->getHighestRow();
        
        // Style for headers
        $headerStyle = [
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
                'wrapText' => true,
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '1E6F41'], // Dark green like in the screenshot
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                ],
            ],
        ];
        
        // Style for data rows
        $dataStyle = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                ],
            ],
            'alignment' => [
                'vertical' => Alignment::VERTICAL_TOP,
                'wrapText' => true, // This makes text wrap instead of overflow
            ],
        ];
        
        // Apply styles
        $sheet->getStyle('A2:G2')->applyFromArray($headerStyle);
        $sheet->getStyle('A3:G' . $lastRow)->applyFromArray($dataStyle);
        
        // Set row height for header
        $sheet->getRowDimension(2)->setRowHeight(30);
        
        // Set dynamic row height for data rows based on content length
        for ($i = 3; $i <= $lastRow; $i++) {
            // Check for text length in columns with potentially long content (C and D)
            $descriptionLength = strlen($sheet->getCell('C' . $i)->getValue());
            $professionLength = strlen($sheet->getCell('D' . $i)->getValue());
            
            // Set higher rows for longer content
            $maxLength = max($descriptionLength, $professionLength);
            if ($maxLength > 300) {
                $sheet->getRowDimension($i)->setRowHeight(120);
            } elseif ($maxLength > 200) {
                $sheet->getRowDimension($i)->setRowHeight(100);
            } elseif ($maxLength > 100) {
                $sheet->getRowDimension($i)->setRowHeight(80);
            } else {
                $sheet->getRowDimension($i)->setRowHeight(60);
            }
        }
        
        // Add alternating row colors
        for ($i = 3; $i <= $lastRow; $i++) {
            if ($i % 2 == 0) {
                $sheet->getStyle('A' . $i . ':G' . $i)->getFill()
                    ->setFillType(Fill::FILL_SOLID)
                    ->getStartColor()->setRGB('F0F0F0');
            }
        }
        
        // Center align specific columns
        $sheet->getStyle('A3:A' . $lastRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('E3:E' . $lastRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        
        return [];
    }
    
    public function title(): string
    {
        return 'Profil Lulusan';
    }

    /**
     * Register events
     */
    public function registerEvents(): array
    {
        return [
            BeforeSheet::class => function(BeforeSheet $event) {
                $sheet = $event->sheet;
                
                // Title in the first row
                $sheet->setCellValue('A1', 'Profil Lulusan');
                $sheet->mergeCells('A1:G1');
                $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
                $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            },
        ];
    }
}