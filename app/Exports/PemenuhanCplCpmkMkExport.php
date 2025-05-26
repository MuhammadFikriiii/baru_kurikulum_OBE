<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PemenuhanCplCpmkMkExport implements FromArray, WithHeadings, WithStyles, WithColumnWidths, WithTitle, ShouldAutoSize
{
    protected $matrix;
    protected $prodiName;
    protected $kodeProdi;

    public function __construct($kodeProdi = null)
    {
        $this->kodeProdi = $kodeProdi ?? Auth::user()->kode_prodi;
        $this->generateMatrix();
    }

    /**
     * Generate matrix data same as controller
     */
    private function generateMatrix()
    {
        $kodeProdi = $this->kodeProdi;

        $data = DB::table('capaian_profil_lulusans as cpl')
            ->join('cpl_pl', 'cpl.id_cpl', '=', 'cpl_pl.id_cpl')
            ->join('profil_lulusans as pl', 'cpl_pl.id_pl', '=', 'pl.id_pl')
            ->join('prodis', 'pl.kode_prodi', '=', 'prodis.kode_prodi')
            ->leftJoin('cpl_cpmk as cpl_cpmk', 'cpl_cpmk.id_cpl', '=', 'cpl.id_cpl')
            ->leftJoin('capaian_pembelajaran_mata_kuliahs as cpmk', 'cpl_cpmk.id_cpmk', '=', 'cpmk.id_cpmk')
            ->leftJoin('cpmk_mk', 'cpl_cpmk.id_cpmk', '=', 'cpmk_mk.id_cpmk')
            ->leftJoin('mata_kuliahs as mk', 'cpmk_mk.kode_mk', '=', 'mk.kode_mk')
            ->where('prodis.kode_prodi', $kodeProdi)
            ->select(
                'cpl.kode_cpl',
                'cpl.deskripsi_cpl',
                'cpmk.kode_cpmk',
                'cpmk.deskripsi_cpmk',
                'mk.kode_mk',
                'nama_mk',
                'mk.semester_mk',
                'prodis.nama_prodi'
            )
            ->orderBy('cpl.kode_cpl')
            ->orderBy('cpmk.kode_cpmk')
            ->get();

        $matrix = [];
        $this->prodiName = '';

        foreach ($data as $row) {
            $kode_cpl = $row->kode_cpl;
            $kode_cpmk = $row->kode_cpmk;
            $semester = $row->semester_mk;

            if (empty($this->prodiName) && !empty($row->nama_prodi)) {
                $this->prodiName = $row->nama_prodi;
            }

            $matrix[$kode_cpl]['deskripsi'] = $row->deskripsi_cpl;
            $matrix[$kode_cpl]['prodi'] = $row->nama_prodi;
            
            if (!empty($kode_cpmk)) {
                $matrix[$kode_cpl]['cpmk'][$kode_cpmk]['deskripsi'] = $row->deskripsi_cpmk;
                $matrix[$kode_cpl]['cpmk'][$kode_cpmk]['prodi'] = $row->nama_prodi;

                if ($semester >= 1 && $semester <= 8 && !empty($row->nama_mk)) {
                    $matrix[$kode_cpl]['cpmk'][$kode_cpmk]['semester'][$semester][] = $row->nama_mk;
                }
            }
        }

        $this->matrix = $matrix;
    }

    /**
     * @return array
     */
    public function array(): array
    {
        $exportData = [];

        foreach ($this->matrix as $kode_cpl => $cpl) {
            if (empty($cpl['cpmk'])) {
                // If CPL has no CPMK, create a single row
                $row = [
                    $kode_cpl,
                    '-',
                    '', '', '', '', '', '', '', ''
                ];
                $exportData[] = $row;
            } else {
                $first = true;
                foreach ($cpl['cpmk'] as $kode_cpmk => $cpmk) {
                    $row = [];
                    
                    // CPL column (only for first row of each CPL)
                    if ($first) {
                        $row[] = $kode_cpl;
                        $first = false;
                    } else {
                        $row[] = '';
                    }

                    // CPMK column
                    $row[] = $kode_cpmk ?? '-';

                    // Semester columns (1-8)
                    for ($i = 1; $i <= 8; $i++) {
                        $mataKuliah = '';
                        if (!empty($cpmk['semester'][$i])) {
                            $mataKuliah = implode("\n", array_unique($cpmk['semester'][$i]));
                        }
                        $row[] = $mataKuliah;
                    }

                    $exportData[] = $row;
                }
            }
        }

        return $exportData;
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'CPL',
            'CPMK',
            'Semester 1',
            'Semester 2',
            'Semester 3',
            'Semester 4',
            'Semester 5',
            'Semester 6',
            'Semester 7',
            'Semester 8'
        ];
    }

    /**
     * @param Worksheet $sheet
     * @return array
     */
    public function styles(Worksheet $sheet)
    {
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();

        return [
            // Header row styling
            1 => [
                'font' => [
                    'bold' => true,
                    'color' => ['rgb' => 'FFFFFF'],
                ],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'color' => ['rgb' => '166534'], // Green-800
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
            ],
            // All cells border and alignment
            'A1:' . $highestColumn . $highestRow => [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => ['rgb' => '000000'],
                    ],
                ],
                'alignment' => [
                    'vertical' => Alignment::VERTICAL_TOP,
                    'wrapText' => true,
                ],
            ],
            // CPL and CPMK columns center alignment
            'A:B' => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
            ],
            // Semester columns center alignment
            'C:J' => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_TOP,
                ],
            ],
        ];
    }

    /**
     * @return array
     */
    public function columnWidths(): array
    {
        return [
            'A' => 15,  // CPL
            'B' => 15,  // CPMK
            'C' => 25,  // Semester 1
            'D' => 25,  // Semester 2
            'E' => 25,  // Semester 3
            'F' => 25,  // Semester 4
            'G' => 25,  // Semester 5
            'H' => 25,  // Semester 6
            'I' => 25,  // Semester 7
            'J' => 25,  // Semester 8
        ];
    }

    /**
     * @return string
     */
    public function title(): string
    {
        $prodiName = !empty($this->prodiName) ? $this->prodiName : 'Program Studi';
        return 'Pemetaan CPL-CPMK-MK - ' . $prodiName;
    }
}