<?php

namespace App\Exports;

use App\Models\CapaianProfilLulusan;
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

class TimCapaianPembelajaranLulusanExport implements
    FromCollection,
    WithHeadings,
    WithStyles,
    WithColumnWidths,
    WithTitle,
    WithMapping,
    WithEvents
{
    protected $kodeProdi;
    protected $idTahun;

    public function __construct($kodeProdi, $idTahun)
    {
        $this->kodeProdi = $kodeProdi;
        $this->idTahun = $idTahun;
    }

    public function collection()
    {
        // Modified query to prevent duplicates by using distinct on the specific columns needed
        return DB::table('capaian_profil_lulusans')
            ->join('cpl_pl', 'capaian_profil_lulusans.id_cpl', '=', 'cpl_pl.id_cpl')
            ->join('profil_lulusans', 'cpl_pl.id_pl', '=', 'profil_lulusans.id_pl')
            ->join('prodis', 'profil_lulusans.kode_prodi', '=', 'prodis.kode_prodi')
            ->where('profil_lulusans.kode_prodi', $this->kodeProdi)
            ->when($this->idTahun, function ($query) {
                $query->where('profil_lulusans.id_tahun', $this->idTahun);
            })
            ->select(
                'prodis.nama_prodi as prodi',
                'capaian_profil_lulusans.kode_cpl',
                'capaian_profil_lulusans.deskripsi_cpl',
                'capaian_profil_lulusans.status_cpl'
            )
            ->distinct('capaian_profil_lulusans.kode_cpl') // Ensure each kode_cpl only appears once
            ->orderBy('capaian_profil_lulusans.kode_cpl')
            ->get()
            ->map(function ($item, $key) {
                $item->no = $key + 1; // Add row number after distinct filtering
                return $item;
            });
    }

    public function map($row): array
    {
        return [
            $row->no,
            $row->prodi,
            $row->kode_cpl,
            $row->deskripsi_cpl,
            $row->status_cpl,
        ];
    }

    public function headings(): array
    {
        return [
            'NO.',
            'PRODI',
            'KODE CPL',
            'DESKRIPSI CPL',
            'STATUS CPL'
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 8,
            'B' => 20,
            'C' => 12,
            'D' => 60,
            'E' => 20,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $lastRow = $sheet->getHighestRow();

        $headerStyle = [
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '1E6F41'],
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                ],
            ],
        ];

        $dataStyle = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                ],
            ],
            'alignment' => [
                'vertical' => Alignment::VERTICAL_CENTER,
                'wrapText' => true,
            ],
        ];

        // Apply styles to header in row 2
        $sheet->getStyle('A2:E2')->applyFromArray($headerStyle); // Header on row 2
        $sheet->getStyle('A3:E' . $lastRow)->applyFromArray($dataStyle); // Data starts from row 3

        // Row height & wrap text
        $sheet->getDefaultRowDimension()->setRowHeight(40);
        for ($i = 3; $i <= $lastRow; $i++) {
            $textLength = strlen($sheet->getCell('D' . $i)->getValue());
            if ($textLength > 200) {
                $sheet->getRowDimension($i)->setRowHeight(80);
            } elseif ($textLength > 100) {
                $sheet->getRowDimension($i)->setRowHeight(60);
            }
        }

        // Alternating row color
        for ($i = 3; $i <= $lastRow; $i++) {
            if ($i % 2 == 0) {
                $sheet->getStyle('A' . $i . ':E' . $i)->getFill()
                    ->setFillType(Fill::FILL_SOLID)
                    ->getStartColor()->setRGB('F0F0F0');
            }
        }

        // Center alignment for certain columns
        $sheet->getStyle('A3:A' . $lastRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('C3:C' . $lastRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('E3:E' . $lastRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        return [];
    }

    public function title(): string
    {
        return 'Capaian Pembelajaran Lulusan';
    }

    /**
     * Register events
     */
    public function registerEvents(): array
    {
        return [
            BeforeSheet::class => function (BeforeSheet $event) {
                $sheet = $event->sheet;

                // Title in the first row
                $sheet->setCellValue('A1', '2. CPL Kompetensi Utama Program Studi Vokasi Teknik Informatika');
                $sheet->mergeCells('A1:E1');
                $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(12);
                $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
            },
        ];
    }
}
