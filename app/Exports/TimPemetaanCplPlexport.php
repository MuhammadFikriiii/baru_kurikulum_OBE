<?php

namespace App\Exports;

use App\Models\CapaianProfilLulusan;
use App\Models\ProfilLulusan;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;

class TimPemetaanCplPlExport implements FromArray, WithTitle, WithStyles, WithColumnWidths, ShouldAutoSize
{
    protected $kodeProdi;

    public function __construct($kodeProdi)
    {
        $this->kodeProdi = $kodeProdi;
    }

    public function array(): array
    {
        // Get profile lulusan data based on kode_prodi
        $pls = ProfilLulusan::where('kode_prodi', $this->kodeProdi)->get();
        
        // Get CPLs related to this prodi through the relationships
        $cpls = DB::table('capaian_profil_lulusans')
            ->join('cpl_pl', 'capaian_profil_lulusans.id_cpl', '=', 'cpl_pl.id_cpl')
            ->join('profil_lulusans', 'cpl_pl.id_pl', '=', 'profil_lulusans.id_pl')
            ->where('profil_lulusans.kode_prodi', $this->kodeProdi)
            ->select('capaian_profil_lulusans.*')
            ->distinct()
            ->orderBy('capaian_profil_lulusans.kode_cpl')
            ->get();

        // Get CPL-PL mapping
        $pemetaan = DB::table('cpl_pl')
            ->join('capaian_profil_lulusans', 'cpl_pl.id_cpl', '=', 'capaian_profil_lulusans.id_cpl')
            ->join('profil_lulusans', 'cpl_pl.id_pl', '=', 'profil_lulusans.id_pl')
            ->where('profil_lulusans.kode_prodi', $this->kodeProdi)
            ->select('cpl_pl.id_cpl', 'cpl_pl.id_pl')
            ->get();
            
        // Create mapping matrix
        $pemetaanMatrix = [];
        foreach ($pemetaan as $map) {
            $pemetaanMatrix[$map->id_cpl][$map->id_pl] = true;
        }

        // Title row (row 1)
        $title = ['3. Pemetaan CPL dan PL', '', '', '', '', ''];
        
        // Header row (row 2)
        $header = ['Kode', 'CPL'];
        foreach ($pls as $pl) {
            $header[] = $pl->kode_pl ?? $pl->kode;
        }
        
        // Start with empty row and then add title and header rows
        $data = [
            $title,
            $header
        ];

        // Data rows (starting at row 3)
        foreach ($cpls as $cpl) {
            $row = [
                $cpl->kode_cpl,                // First column is CPL code
                $cpl->deskripsi_cpl ?? ''      // Second column is CPL description
            ]; 
            
            foreach ($pls as $pl) {
                // Check if there's a mapping between CPL and PL
                $row[] = isset($pemetaanMatrix[$cpl->id_cpl][$pl->id_pl]) ? 'v' : '';
            }
            $data[] = $row;
        }

        return $data;
    }

    public function styles(Worksheet $sheet)
    {
        // Style for title cell (A1)
        $sheet->getStyle('A1')->getFont()->setBold(true);
        
        // Style for the header row (row 2)
        $lastCol = $sheet->getHighestColumn();
        
        // Style for column headers (row 2)
        $sheet->getStyle('A2:' . $lastCol . '2')->applyFromArray([
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => [
                    'rgb' => '1E6F41', // Bright green as shown in the image
                ],
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                ],
            ],
            'font' => [
                'bold' => true,
                'color' => [
                    'rgb' => 'FFFFFF', // White text color
                ],
            ],
        ]);

        // Center alignment for header cells and "v" cells
        $sheet->getStyle('C2:' . $lastCol . $sheet->getHighestRow())->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        
        // Add borders to all data cells
        $sheet->getStyle('A1:' . $lastCol . $sheet->getHighestRow())->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                ],
            ],
        ]);
        
        // Add light blue background to the row indices and code column as shown in the image
        $sheet->getStyle('A3:A' . $sheet->getHighestRow())->applyFromArray([
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => [
                    'rgb' => 'D9E1F2', // Light blue color
                ],
            ],
        ]);

        // Vertical alignment for all cells
        $sheet->getStyle('A1:' . $lastCol . $sheet->getHighestRow())->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
        
        // Wrap text for CPL descriptions
        $sheet->getStyle('B3:B' . $sheet->getHighestRow())->getAlignment()->setWrapText(true);
        
        return [
            // Add additional styling if needed
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 12, // Width for Kode column
            'B' => 70, // Width for CPL description column
            // Other columns will be auto-sized
        ];
    }

    public function title(): string
    {
        return 'Pemetaan CPL - PL';
    }
}