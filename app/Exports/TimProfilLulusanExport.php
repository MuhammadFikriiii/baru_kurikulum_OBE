<?php

namespace App\Exports;

use App\Models\ProfilLulusan;
use App\Models\Tahun;
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
    protected $idTahun;

    public function __construct($kodeProdi, $idTahun)
    {
        $this->kodeProdi = $kodeProdi;
        $this->idTahun = $idTahun;
    }

    public function collection()
    {
        $data = ProfilLulusan::where('kode_prodi', $this->kodeProdi)
            ->where('id_tahun', $this->idTahun)
            ->with('prodi')
            ->get();

        $counter = 1;
        $data->each(function ($item) use (&$counter) {
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

    public function columnWidths(): array
    {
        return [
            'A' => 12,
            'B' => 20,
            'C' => 40,
            'D' => 35,
            'E' => 12,
            'F' => 25,
            'G' => 15,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $lastRow = $sheet->getHighestRow();

        // Style for headers
        $sheet->getStyle('A2:G2')->applyFromArray([
            'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
                'wrapText' => true,
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '1E6F41'],
            ],
            'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]],
        ]);

        // Style for data
        $sheet->getStyle("A3:G{$lastRow}")->applyFromArray([
            'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]],
            'alignment' => ['vertical' => Alignment::VERTICAL_TOP, 'wrapText' => true],
        ]);

        // Set row height for header
        $sheet->getRowDimension(2)->setRowHeight(30);

        // Dynamic height
        for ($i = 3; $i <= $lastRow; $i++) {
            $desc = strlen($sheet->getCell("C{$i}")->getValue());
            $prof = strlen($sheet->getCell("D{$i}")->getValue());
            $max = max($desc, $prof);

            if ($max > 300) {
                $sheet->getRowDimension($i)->setRowHeight(120);
            } elseif ($max > 200) {
                $sheet->getRowDimension($i)->setRowHeight(100);
            } elseif ($max > 100) {
                $sheet->getRowDimension($i)->setRowHeight(80);
            } else {
                $sheet->getRowDimension($i)->setRowHeight(60);
            }
        }

        // Alternating row color
        for ($i = 3; $i <= $lastRow; $i++) {
            if ($i % 2 == 0) {
                $sheet->getStyle("A{$i}:G{$i}")->getFill()->setFillType(Fill::FILL_SOLID)
                    ->getStartColor()->setRGB('F0F0F0');
            }
        }

        // Alignment khusus untuk kolom tertentu
        $sheet->getStyle("A3:A{$lastRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("E3:E{$lastRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        return [];
    }

    public function title(): string
    {
        return 'Profil Lulusan';
    }

    public function registerEvents(): array
    {
        return [
            BeforeSheet::class => function (BeforeSheet $event) {
                $tahun = Tahun::find($this->idTahun);
                $namaTahun = $tahun->tahun ?? 'Tahun Tidak Dikenal';
                $kurikulum = $tahun->nama_kurikulum ?? '-';

                $sheet = $event->sheet;
                $sheet->setCellValue('A1', "1. Profil Lulusan - Tahun: {$namaTahun} - Kurikulum: {$kurikulum}");
                $sheet->mergeCells('A1:G1');
                $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(12);
                $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
            },
        ];
    }
}
