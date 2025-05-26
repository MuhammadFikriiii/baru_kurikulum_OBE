<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Illuminate\Support\Facades\DB;

class PemetaanCplCpmkMkExport implements FromArray, WithHeadings, WithStyles, WithColumnWidths, ShouldAutoSize
{
    protected $matrix;
    protected $kodeProdi;

    public function __construct($kodeProdi)
    {
        $this->kodeProdi = $kodeProdi;
        $this->matrix = $this->buildMatrix();
    }

    /**
     * Build matrix data dari database
     */
    private function buildMatrix()
    {
        $matrix = [];

        try {
            // Query yang sama persis kayak di controller index
            $data = DB::table('capaian_profil_lulusans as cpl')
                ->join('cpl_pl', 'cpl.id_cpl', '=', 'cpl_pl.id_cpl')
                ->join('profil_lulusans as pl', 'cpl_pl.id_pl', '=', 'pl.id_pl')
                ->join('prodis', 'pl.kode_prodi', '=', 'prodis.kode_prodi')
                ->leftJoin('cpl_cpmk', 'cpl.id_cpl', '=', 'cpl_cpmk.id_cpl')
                ->leftJoin('capaian_pembelajaran_mata_kuliahs as cpmk', 'cpl_cpmk.id_cpmk', '=', 'cpmk.id_cpmk')
                ->leftJoin('cpmk_mk', 'cpmk.id_cpmk', '=', 'cpmk_mk.id_cpmk')
                ->leftJoin('mata_kuliahs as mk', 'cpmk_mk.kode_mk', '=', 'mk.kode_mk')
                ->select(
                    'cpl.id_cpl',
                    'cpl.kode_cpl',
                    'cpl.deskripsi_cpl',
                    'cpmk.id_cpmk',
                    'cpmk.kode_cpmk',
                    'cpmk.deskripsi_cpmk',
                    'mk.nama_mk'
                )
                ->where('prodis.kode_prodi', $this->kodeProdi)
                ->orderBy('cpl.kode_cpl', 'asc')
                ->orderBy('cpmk.id_cpmk', 'asc')
                ->get();

            // Build matrix persis kayak di controller
            foreach ($data as $row) {
                // Pastikan CPL selalu masuk ke matrix meskipun tidak ada CPMK
                if (!isset($matrix[$row->kode_cpl])) {
                    $matrix[$row->kode_cpl]['deskripsi'] = $row->deskripsi_cpl;
                }

                // Jika ada CPMK, tambahkan ke dalam CPL
                if ($row->kode_cpmk) {
                    $matrix[$row->kode_cpl]['cpmk'][$row->kode_cpmk]['deskripsi'] = $row->deskripsi_cpmk;

                    if ($row->nama_mk) {
                        $matrix[$row->kode_cpl]['cpmk'][$row->kode_cpmk]['mk'][] = $row->nama_mk;
                    }
                }


                $matrix[$row->kode_cpl]['deskripsi'] = $row->deskripsi_cpl;
                $matrix[$row->kode_cpl]['cpmk'][$row->kode_cpmk]['deskripsi'] = $row->deskripsi_cpmk;

                // Hanya tambahkan mata kuliah jika tidak null
                if ($row->nama_mk) {
                    $matrix[$row->kode_cpl]['cpmk'][$row->kode_cpmk]['mk'][] = $row->nama_mk;
                }
            }
        } catch (\Exception $e) {
            // Jika terjadi error, return array kosong
            $matrix = [];
        }

        return $matrix;
    }



    /**
     * @return array
     */
    public function array(): array
    {
        $data = [];

        // Pastikan matrix adalah array dan tidak kosong
        if (!is_array($this->matrix) || empty($this->matrix)) {
            return $data;
        }

        foreach ($this->matrix as $kode_cpl => $cpl) {
            // Pastikan struktur cpl valid
            if (!isset($cpl['cpmk']) || !is_array($cpl['cpmk'])) {
                continue;
            }

            $first = true;

            foreach ($cpl['cpmk'] as $kode_cpmk => $cpmk) {
                // Pastikan mk adalah array
                $mata_kuliah_array = isset($cpmk['mk']) && is_array($cpmk['mk']) ? $cpmk['mk'] : [];
                $mata_kuliah = implode("\n", array_unique($mata_kuliah_array));

                if ($first) {
                    // Baris pertama untuk CPL ini - tampilkan data CPL
                    $data[] = [
                        $kode_cpl,
                        $cpl['deskripsi'] ?? '',
                        $kode_cpmk,
                        $cpmk['deskripsi'] ?? '',
                        $mata_kuliah
                    ];
                    $first = false;
                } else {
                    // Baris berikutnya - kosongkan kolom CPL
                    $data[] = [
                        '', // Kosong untuk merge cell
                        '', // Kosong untuk merge cell
                        $kode_cpmk,
                        $cpmk['deskripsi'] ?? '',
                        $mata_kuliah
                    ];
                }
            }
        }

        return $data;
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'Kode CPL',
            'Deskripsi CPL',
            'Kode CPMK',
            'Deskripsi CPMK',
            'Mata Kuliah'
        ];
    }

    /**
     * @return array
     */
    public function columnWidths(): array
    {
        return [
            'A' => 15, // Kode CPL
            'B' => 40, // Deskripsi CPL
            'C' => 15, // Kode CPMK
            'D' => 40, // Deskripsi CPMK
            'E' => 30, // Mata Kuliah
        ];
    }

    /**
     * @param Worksheet $sheet
     * @return array
     */
    public function styles(Worksheet $sheet)
    {
        $lastRow = $sheet->getHighestRow();
        $lastColumn = $sheet->getHighestColumn();

        // Style untuk header
        $sheet->getStyle('A1:E1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '166534'], // Green-800
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ]);

        // Style untuk seluruh tabel
        $sheet->getStyle("A1:{$lastColumn}{$lastRow}")->applyFromArray([
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
        ]);

        // Style khusus untuk kolom mata kuliah (center alignment)
        $sheet->getStyle("E2:E{$lastRow}")->applyFromArray([
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_TOP,
                'wrapText' => true,
            ],
        ]);

        // Merge cells untuk CPL yang sama
        $this->mergeCells($sheet);

        return [];
    }

    /**
     * Merge cells untuk CPL yang memiliki multiple CPMK
     */
    private function mergeCells(Worksheet $sheet)
    {
        $currentRow = 2; // Mulai dari baris data pertama

        foreach ($this->matrix as $kode_cpl => $cpl) {
            $cpmkCount = count($cpl['cpmk']);

            if ($cpmkCount > 1) {
                $endRow = $currentRow + $cpmkCount - 1;

                // Merge kolom Kode CPL (A) dan Deskripsi CPL (B)
                $sheet->mergeCells("A{$currentRow}:A{$endRow}");
                $sheet->mergeCells("B{$currentRow}:B{$endRow}");

                // Set alignment untuk merged cells
                $sheet->getStyle("A{$currentRow}:B{$endRow}")->applyFromArray([
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                        'wrapText' => true,
                    ],
                ]);
            }

            $currentRow += $cpmkCount;
        }
    }
}
