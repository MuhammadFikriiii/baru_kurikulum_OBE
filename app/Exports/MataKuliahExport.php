<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

class MataKuliahExport implements FromCollection, WithHeadings, WithTitle, WithStyles, WithColumnWidths, WithCustomStartCell
{
    protected $kodeProdi;

    public function __construct($kodeProdi)
    {
        $this->kodeProdi = $kodeProdi;
    }

    public function collection()
    {
        $mata_kuliahs = DB::table('mata_kuliahs as mk')
            ->select(
                'mk.kode_mk',
                'mk.nama_mk',
                'mk.sks_mk',
                'mk.kompetensi_mk',
                'mk.semester_mk'
            )
            ->leftJoin('cpl_mk', 'mk.kode_mk', '=', 'cpl_mk.kode_mk')
            ->leftJoin('capaian_profil_lulusans as cpl', 'cpl_mk.id_cpl', '=', 'cpl.id_cpl')
            ->leftJoin('cpl_pl', 'cpl.id_cpl', '=', 'cpl_pl.id_cpl')
            ->leftJoin('profil_lulusans as pl', 'cpl_pl.id_pl', '=', 'pl.id_pl')
            ->leftJoin('prodis', 'pl.kode_prodi', '=', 'prodis.kode_prodi')
            ->where('prodis.kode_prodi', '=', $this->kodeProdi)
            ->groupBy('mk.kode_mk', 'mk.nama_mk', 'mk.sks_mk', 'mk.kompetensi_mk', 'mk.semester_mk')
            ->get();

        $formattedData = [];
        
        foreach ($mata_kuliahs as $mk) {
            $rowData = [
                $mk->kode_mk,
                $mk->nama_mk, 
                $mk->sks_mk,
                ucfirst($mk->kompetensi_mk),
                ($mk->semester_mk == 1) ? 'v' : '',
                ($mk->semester_mk == 2) ? 'v' : '',
                ($mk->semester_mk == 3) ? 'v' : '',
                ($mk->semester_mk == 4) ? 'v' : '',
                ($mk->semester_mk == 5) ? 'v' : '',
                ($mk->semester_mk == 6) ? 'v' : '',
                ($mk->semester_mk == 7) ? 'v' : '',
                ($mk->semester_mk == 8) ? 'v' : '',
            ];
            
            $formattedData[] = $rowData;
        }
        
        return collect($formattedData);
    }

    public function headings(): array
    {
        return [
            ['9. Susunan Mata Kuliah', '', '', '', '', '', '', '', '', '', ''],
            ['Kode MK', 'Mata Kuliah', 'SKS', 'Kompetensi', 'Semester', '', '', '', '', '', ''],
            ['', '', '', '', '1', '2', '3', '4', '5', '6', '7', '8']
        ];
    }
    
    public function startCell(): string
    {
        return 'A1';
    }

    public function styles(Worksheet $sheet)
    {
        $lastRow = $sheet->getHighestRow();
        $lastColumn = 'L'; // Sesuaikan dengan jumlah semester (sampai semester 8 = kolom L)
        
        // Styling for title row
        $sheet->mergeCells('A1:L1');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(12);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
        
        // Styling for header rows (Kode MK, Mata Kuliah, etc.)
        $sheet->mergeCells('E2:L2');
        $sheet->getStyle('A2:L3')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'], // White text
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '2F6739'], // Dark green
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                ],
            ],
        ]);
        
        // Data cells styling
        $sheet->getStyle('A4:L' . $lastRow)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                ],
            ],
            'alignment' => [
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ]);
        
        // Center align SKS column and semester columns
        $sheet->getStyle('C4:L' . $lastRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        
        // Left align for nama MK and Kompetensi columns
        $sheet->getStyle('B4:B' . $lastRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
        $sheet->getStyle('D4:D' . $lastRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
        
        // Border styling for entire table
        $sheet->getStyle('A1:L'.$lastRow)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                ],
            ],
        ]);
        
        return $sheet;
    }

    public function columnWidths(): array
    {
        return [
            'A' => 15, // Kode MK
            'B' => 35, // Nama MK
            'C' => 8,  // SKS
            'D' => 15, // Kompetensi
            'E' => 8,  // Semester 1
            'F' => 8,  // Semester 2
            'G' => 8,  // Semester 3
            'H' => 8,  // Semester 4
            'I' => 8,  // Semester 5
            'J' => 8,  // Semester 6
            'K' => 8,  // Semester 7
            'L' => 8,  // Semester 8
        ];
    }

    public function title(): string
    {
        return 'Mata Kuliah';
    }
}