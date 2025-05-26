<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
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

class PemetaanMkCpmkSubCpmkExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithColumnWidths, WithTitle, ShouldAutoSize
{
    protected $data;
    protected $kodeProdi;

    public function __construct($kodeProdi = null)
    {
        $this->kodeProdi = $kodeProdi;
        $this->data = $this->getData();
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->data;
    }

    /**
     * Get data from database
     */
    private function getData()
    {
        $kodeProdi = $this->kodeProdi ?? Auth::user()->kode_prodi;

        return DB::table('capaian_profil_lulusans as cpl')
            ->join('cpl_pl', 'cpl.id_cpl', '=', 'cpl_pl.id_cpl')
            ->join('profil_lulusans as pl', 'cpl_pl.id_pl', '=', 'pl.id_pl')
            ->join('prodis', 'pl.kode_prodi', '=', 'prodis.kode_prodi')
            ->join('cpl_mk', 'cpl.id_cpl', '=', 'cpl_mk.id_cpl')
            ->join('mata_kuliahs as mk', 'cpl_mk.kode_mk', '=', 'mk.kode_mk')
            ->leftJoin('cpmk_mk', 'mk.kode_mk', '=', 'cpmk_mk.kode_mk')
            ->leftJoin('capaian_pembelajaran_mata_kuliahs as cpmk', 'cpmk_mk.id_cpmk', '=', 'cpmk.id_cpmk')
            ->leftJoin('sub_cpmks as sub', 'sub.id_cpmk', '=', 'cpmk.id_cpmk')
            ->where('prodis.kode_prodi', $kodeProdi)
            ->select(
                'mk.kode_mk',
                'mk.nama_mk',
                'cpmk.kode_cpmk',
                'cpmk.deskripsi_cpmk',
                'sub.id_sub_cpmk',
                'sub.sub_cpmk',
                'sub.uraian_cpmk',
            )
            ->orderBy('mk.kode_mk')
            ->orderBy('cpmk.kode_cpmk')
            ->distinct()
            ->get();
    }


    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'No',
            'Kode MK',
            'Nama MK',
            'Kode CPMK',
            'Deskripsi CPMK',
            'Kode Sub CPMK',
            'Uraian Sub CPMK'
        ];
    }

    /**
     * @param mixed $row
     * @return array
     */
    public function map($row): array
    {
        static $counter = 0;
        $counter++;

        return [
            $counter,
            strtoupper($row->kode_mk),
            strtoupper($row->nama_mk),
            strtoupper($row->kode_cpmk),
            strtoupper($row->deskripsi_cpmk),
            strtoupper($row->sub_cpmk),
            strtoupper($row->uraian_cpmk)
        ];
    }

    /**
     * @return array
     */
    public function columnWidths(): array
    {
        return [
            'A' => 5,   // No
            'B' => 12,  // Kode MK
            'C' => 30,  // Nama MK
            'D' => 15,  // Kode CPMK
            'E' => 40,  // Deskripsi CPMK
            'F' => 15,  // Kode Sub CPMK
            'G' => 50,  // Uraian Sub CPMK
        ];
    }

    /**
     * @param Worksheet $sheet
     * @return array
     */
    public function styles(Worksheet $sheet)
    {
        $lastRow = $this->data->count() + 1;

        return [
            // Header styling
            1 => [
                'font' => [
                    'bold' => true,
                    'color' => ['argb' => 'FFFFFF'],
                    'size' => 12
                ],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['argb' => '166534'] // Green-800
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => ['argb' => '000000'],
                    ],
                ],
            ],

            // Data rows styling
            'A2:G' . $lastRow => [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => ['argb' => '000000'],
                    ],
                ],
                'alignment' => [
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
            ],

            // No column center alignment
            'A2:A' . $lastRow => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                ],
            ],

            // Code columns center alignment
            'B2:B' . $lastRow => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                ],
            ],

            'D2:D' . $lastRow => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                ],
            ],

            'F2:F' . $lastRow => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                ],
            ],

            // Text columns justify alignment
            'C2:C' . $lastRow => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_JUSTIFY,
                    'wrapText' => true,
                ],
            ],

            'E2:E' . $lastRow => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_JUSTIFY,
                    'wrapText' => true,
                ],
            ],

            'G2:G' . $lastRow => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_JUSTIFY,
                    'wrapText' => true,
                ],
            ],
        ];
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Pemetaan MK-CPMK-SubCPMK';
    }
}
