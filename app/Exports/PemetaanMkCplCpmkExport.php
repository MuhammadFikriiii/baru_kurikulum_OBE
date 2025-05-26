<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PemetaanMkCplCpmkExport implements FromArray, WithHeadings, WithStyles, WithColumnWidths, WithTitle
{
    protected $kodeProdi;

    public function __construct($kodeProdi)
    {
        $this->kodeProdi = $kodeProdi;
    }

    /**
     * @return array
     */
    public function array(): array
{
    // Get all CPL data
    $semuaCpl = DB::table('capaian_profil_lulusans as cpl')
        ->join('cpl_pl', 'cpl.id_cpl', '=', 'cpl_pl.id_cpl')
        ->join('profil_lulusans as pl', 'cpl_pl.id_pl', '=', 'pl.id_pl')
        ->join('prodis', 'pl.kode_prodi', '=', 'prodis.kode_prodi')
        ->where('prodis.kode_prodi', $this->kodeProdi)
        ->select('cpl.id_cpl', 'cpl.kode_cpl', 'cpl.deskripsi_cpl', 'prodis.nama_prodi')
        ->orderBy('cpl.kode_cpl')
        ->get();

    // Get relations data first to know which MK we need
    $relasi = DB::table('cpl_cpmk')
        ->join('capaian_pembelajaran_mata_kuliahs as cpmk', 'cpl_cpmk.id_cpmk', '=', 'cpmk.id_cpmk')
        ->join('capaian_profil_lulusans as cpl', 'cpl_cpmk.id_cpl', '=', 'cpl.id_cpl')
        ->join('cpmk_mk', 'cpl_cpmk.id_cpmk', '=', 'cpmk_mk.id_cpmk')
        ->join('mata_kuliahs as mk', 'cpmk_mk.kode_mk', '=', 'mk.kode_mk')
        ->join('cpl_pl', 'cpl.id_cpl', '=', 'cpl_pl.id_cpl')
        ->join('profil_lulusans as pl', 'cpl_pl.id_pl', '=', 'pl.id_pl')
        ->join('prodis', 'pl.kode_prodi', '=', 'prodis.kode_prodi')
        ->where('prodis.kode_prodi', $this->kodeProdi)
        ->select(
            'mk.kode_mk',
            'mk.nama_mk',
            'mk.semester_mk',
            'cpl.kode_cpl',
            'cpl.deskripsi_cpl',
            'cpmk.kode_cpmk',
            'cpmk.deskripsi_cpmk',
            'prodis.nama_prodi'
        )
        ->orderBy('mk.kode_mk')
        ->orderBy('cpl.kode_cpl')
        ->get();

    // Get all unique MK codes from relations
    $mkCodesFromRelations = $relasi->pluck('kode_mk')->unique();

    // Get additional MK that might not have CPMK relations but are linked to CPL
    $mkCodesFromCplMk = DB::table('cpl_mk')
        ->join('capaian_profil_lulusans as cpl', 'cpl_mk.id_cpl', '=', 'cpl.id_cpl')
        ->join('cpl_pl', 'cpl.id_cpl', '=', 'cpl_pl.id_cpl')
        ->join('profil_lulusans as pl', 'cpl_pl.id_pl', '=', 'pl.id_pl')
        ->where('pl.kode_prodi', $this->kodeProdi)
        ->pluck('cpl_mk.kode_mk')
        ->unique();

    // Merge all MK codes
    $allMkCodes = $mkCodesFromRelations->merge($mkCodesFromCplMk)->unique();

    // Get all MK details for the combined codes
    $semuaMk = DB::table('mata_kuliahs as mk')
        ->whereIn('mk.kode_mk', $allMkCodes)
        ->select('mk.kode_mk', 'mk.nama_mk', 'mk.semester_mk')
        ->orderBy('mk.kode_mk')
        ->get();

    // Build matrix - Initialize with ALL MK
    $matrix = [];
    
    // Initialize matrix with ALL mata kuliah
    foreach ($semuaMk as $mk) {
        $matrix[$mk->kode_mk]['nama'] = $mk->nama_mk;
        $matrix[$mk->kode_mk]['semester'] = $mk->semester_mk;
        
        // Initialize all CPL columns as empty
        foreach ($semuaCpl as $cpl) {
            $matrix[$mk->kode_mk]['cpl'][$cpl->kode_cpl]['cpmks'] = [];
        }
    }

    // Now populate the matrix with CPMK data (only for MK that have relations)
    foreach ($relasi as $row) {
        // Check if the MK exists in matrix before accessing it
        if (isset($matrix[$row->kode_mk])) {
            // Add CPMK to the appropriate CPL
            if (!in_array($row->kode_cpmk, $matrix[$row->kode_mk]['cpl'][$row->kode_cpl]['cpmks'])) {
                $matrix[$row->kode_mk]['cpl'][$row->kode_cpl]['cpmks'][] = $row->kode_cpmk;
            }
            
            // Store CPMK details
            $matrix[$row->kode_mk]['cpl'][$row->kode_cpl]['cpmk_details'][$row->kode_cpmk] = [
                'nama_prodi' => $row->nama_prodi,
                'deskripsi_cpmk' => $row->deskripsi_cpmk,
            ];
        } else {
            // If MK from relations is not in our matrix, add it
            $matrix[$row->kode_mk]['nama'] = $row->nama_mk;
            $matrix[$row->kode_mk]['semester'] = $row->semester_mk;
            
            // Initialize all CPL columns
            foreach ($semuaCpl as $cpl) {
                $matrix[$row->kode_mk]['cpl'][$cpl->kode_cpl]['cpmks'] = [];
            }
            
            // Add the current CPMK
            $matrix[$row->kode_mk]['cpl'][$row->kode_cpl]['cpmks'][] = $row->kode_cpmk;
            $matrix[$row->kode_mk]['cpl'][$row->kode_cpl]['cpmk_details'][$row->kode_cpmk] = [
                'nama_prodi' => $row->nama_prodi,
                'deskripsi_cpmk' => $row->deskripsi_cpmk,
            ];
        }
    }

    // Convert matrix to array format for Excel
    $data = [];
    foreach ($matrix as $kodeMk => $mk) {
        $row = [
            $kodeMk,                    // Kode MK
            $mk['nama'] ?? 'Unknown'    // Nama Mata Kuliah (with fallback)
        ];
        
        // Add CPL data for each column
        foreach ($semuaCpl as $cpl) {
            $cpmks = [];
            if (isset($mk['cpl'][$cpl->kode_cpl]['cpmks']) && !empty($mk['cpl'][$cpl->kode_cpl]['cpmks'])) {
                $cpmks = $mk['cpl'][$cpl->kode_cpl]['cpmks'];
            }
            $row[] = implode("\n", $cpmks); // Use newline to separate multiple CPMK codes
        }
        
        $data[] = $row;
    }

    return $data;
}

/**
 * Get count of data rows - Updated to match the new logic
 */
private function getDataRowCount(): int
{
    // Get all unique MK codes from relations
    $mkCodesFromRelations = DB::table('cpl_cpmk')
        ->join('capaian_pembelajaran_mata_kuliahs as cpmk', 'cpl_cpmk.id_cpmk', '=', 'cpmk.id_cpmk')
        ->join('capaian_profil_lulusans as cpl', 'cpl_cpmk.id_cpl', '=', 'cpl.id_cpl')
        ->join('cpmk_mk', 'cpl_cpmk.id_cpmk', '=', 'cpmk_mk.id_cpmk')
        ->join('mata_kuliahs as mk', 'cpmk_mk.kode_mk', '=', 'mk.kode_mk')
        ->join('cpl_pl', 'cpl.id_cpl', '=', 'cpl_pl.id_cpl')
        ->join('profil_lulusans as pl', 'cpl_pl.id_pl', '=', 'pl.id_pl')
        ->join('prodis', 'pl.kode_prodi', '=', 'prodis.kode_prodi')
        ->where('prodis.kode_prodi', $this->kodeProdi)
        ->pluck('mk.kode_mk')
        ->unique();

    // Get additional MK codes from cpl_mk
    $mkCodesFromCplMk = DB::table('cpl_mk')
        ->join('capaian_profil_lulusans as cpl', 'cpl_mk.id_cpl', '=', 'cpl.id_cpl')
        ->join('cpl_pl', 'cpl.id_cpl', '=', 'cpl_pl.id_cpl')
        ->join('profil_lulusans as pl', 'cpl_pl.id_pl', '=', 'pl.id_pl')
        ->where('pl.kode_prodi', $this->kodeProdi)
        ->pluck('cpl_mk.kode_mk')
        ->unique();

    // Merge and count unique MK codes
    return $mkCodesFromRelations->merge($mkCodesFromCplMk)->unique()->count();
}

    /**
     * @return array
     */
    public function headings(): array
    {
        // Get CPL data for headings
        $semuaCpl = DB::table('capaian_profil_lulusans as cpl')
            ->join('cpl_pl', 'cpl.id_cpl', '=', 'cpl_pl.id_cpl')
            ->join('profil_lulusans as pl', 'cpl_pl.id_pl', '=', 'pl.id_pl')
            ->join('prodis', 'pl.kode_prodi', '=', 'prodis.kode_prodi')
            ->where('prodis.kode_prodi', $this->kodeProdi)
            ->select('cpl.kode_cpl')
            ->orderBy('cpl.kode_cpl')
            ->get();

        $headings = ['Kode MK', 'Nama Mata Kuliah'];
        
        foreach ($semuaCpl as $cpl) {
            $headings[] = $cpl->kode_cpl;
        }
        
        return $headings;
    }

    /**
     * @param Worksheet $sheet
     * @return array
     */
    public function styles(Worksheet $sheet)
    {
        // Get CPL count for determining last column
        $cplCount = DB::table('capaian_profil_lulusans as cpl')
            ->join('cpl_pl', 'cpl.id_cpl', '=', 'cpl_pl.id_cpl')
            ->join('profil_lulusans as pl', 'cpl_pl.id_pl', '=', 'pl.id_pl')
            ->join('prodis', 'pl.kode_prodi', '=', 'prodis.kode_prodi')
            ->where('prodis.kode_prodi', $this->kodeProdi)
            ->count();

        $lastColumn = $this->getColumnLetter(2 + $cplCount); // 2 for Kode MK and Nama MK + CPL columns
        $lastRow = $this->getDataRowCount() + 1; // +1 for header row
        
        return [
            // Header row styling
            1 => [
                'font' => [
                    'bold' => true,
                    'color' => ['rgb' => 'FFFFFF']
                ],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '166534'] // Green-800 equivalent
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
            ],
            
            // All cells border and alignment
            "A1:{$lastColumn}{$lastRow}" => [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => ['rgb' => '000000'],
                    ],
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_TOP,
                    'wrapText' => true,
                ],
            ],
            
            // Data rows styling
            "A2:{$lastColumn}{$lastRow}" => [
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'FFFFFF']
                ],
            ],
        ];
    }

    /**
     * @return array
     */
    public function columnWidths(): array
    {
        // Get CPL count for determining column widths
        $cplCount = DB::table('capaian_profil_lulusans as cpl')
            ->join('cpl_pl', 'cpl.id_cpl', '=', 'cpl_pl.id_cpl')
            ->join('profil_lulusans as pl', 'cpl_pl.id_pl', '=', 'pl.id_pl')
            ->join('prodis', 'pl.kode_prodi', '=', 'prodis.kode_prodi')
            ->where('prodis.kode_prodi', $this->kodeProdi)
            ->count();

        $widths = [
            'A' => 15, // Kode MK
            'B' => 40, // Nama Mata Kuliah
        ];
        
        // Set width for CPL columns
        for ($i = 0; $i < $cplCount; $i++) {
            $columnLetter = $this->getColumnLetter(3 + $i); // Start from column C
            $widths[$columnLetter] = 20;
        }
        
        return $widths;
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Pemetaan MK-CPL-CPMK';
    }

    /**
     * Convert column number to Excel column letter
     */
    private function getColumnLetter($columnNumber): string
    {
        $columnLetter = '';
        while ($columnNumber > 0) {
            $columnNumber--;
            $columnLetter = chr(65 + ($columnNumber % 26)) . $columnLetter;
            $columnNumber = intval($columnNumber / 26);
        }
        return $columnLetter;
    }

    /**
     * Get count of data rows
     */
    /*private function getDataRowCount(): int
    {
        // Count ALL mata kuliah for this prodi
        $semuaMkIds = DB::table('cpl_mk')
            ->join('capaian_profil_lulusans as cpl', 'cpl_mk.id_cpl', '=', 'cpl.id_cpl')
            ->join('cpl_pl', 'cpl.id_cpl', '=', 'cpl_pl.id_cpl')
            ->join('profil_lulusans as pl', 'cpl_pl.id_pl', '=', 'pl.id_pl')
            ->where('pl.kode_prodi', $this->kodeProdi)
            ->pluck('cpl_mk.kode_mk')
            ->unique();

        return DB::table('mata_kuliahs as mk')
            ->whereIn('mk.kode_mk', $semuaMkIds)
            ->count();
    }*/
}