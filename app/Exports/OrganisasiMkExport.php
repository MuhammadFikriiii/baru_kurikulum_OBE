<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class OrganisasiMkExport implements FromArray, WithTitle, ShouldAutoSize, WithEvents
{
    protected $kodeProdi;

    public function __construct($kodeProdi)
    {
        $this->kodeProdi = $kodeProdi;
    }

    public function array(): array
    {
        $query = DB::table('mata_kuliahs as mk')
            ->select(
                'mk.kode_mk', 'mk.nama_mk', 'mk.jenis_mk', 'mk.sks_mk',
                'mk.semester_mk', 'mk.kompetensi_mk', 'prodis.nama_prodi', 'prodis.kode_prodi'
            )
            ->leftJoin('cpl_mk', 'mk.kode_mk', '=', 'cpl_mk.kode_mk')
            ->leftJoin('capaian_profil_lulusans as cpl', 'cpl_mk.id_cpl', '=', 'cpl.id_cpl')
            ->leftJoin('cpl_pl', 'cpl.id_cpl', '=', 'cpl_pl.id_cpl')
            ->leftJoin('profil_lulusans as pl', 'cpl_pl.id_pl', '=', 'pl.id_pl')
            ->leftJoin('prodis', 'pl.kode_prodi', '=', 'prodis.kode_prodi')
            ->where('prodis.kode_prodi', '=', $this->kodeProdi)
            ->groupBy(
                'mk.kode_mk', 'mk.nama_mk', 'mk.jenis_mk', 'mk.sks_mk',
                'mk.semester_mk', 'mk.kompetensi_mk', 'prodis.nama_prodi', 'prodis.kode_prodi'
            );

        $matakuliah = $query->get();

        $organisasiMK = $matakuliah->groupBy('semester_mk')->map(function ($items, $semester_mk) {
            return [
                'semester_mk' => $semester_mk,
                'sks_mk' => $items->sum('sks_mk'),
                'jumlah_mk' => $items->count(),
                'nama_mk' => $items->pluck('nama_mk')->toArray(),
            ];
        });

        $rows = [];

        // Tambah judul di atas heading
        $rows[] = ['10. Organisasi Matakuliah']; // A1, merged nanti
        $rows[] = ['Semester', 'Total SKS', 'Jumlah MK', 'Daftar MK']; // Heading di A2:D2

        $totalSks = 0;
        $totalMk = 0;

        for ($i = 1; $i <= 8; $i++) {
            $data = $organisasiMK->get($i, [
                'semester_mk' => $i,
                'sks_mk' => 0,
                'jumlah_mk' => 0,
                'nama_mk' => [],
            ]);

            $totalSks += $data['sks_mk'];
            $totalMk += $data['jumlah_mk'];

            $rows[] = [
                'Semester ' . $data['semester_mk'],
                $data['sks_mk'],
                $data['jumlah_mk'],
                implode(', ', $data['nama_mk']),
            ];
        }

        // Baris total
        $rows[] = ['Total', $totalSks, $totalMk, ''];

        return $rows;
    }

    public function title(): string
    {
        return 'Organisasi MK';
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // Merge untuk judul
                $sheet->getStyle('A1')->applyFromArray([
                    'font' => ['bold' => true, 'size' => 14],
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
                ]);

                // Style header (baris ke-2)
                $sheet->getStyle('A2:D2')->applyFromArray([
                    'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                    'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '166534']],
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
                ]);

                // Style seluruh tabel (mulai dari A2)
                $lastRow = $sheet->getHighestRow();
                $sheet->getStyle("A2:D{$lastRow}")->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['argb' => '000000'],
                        ],
                    ],
                    'alignment' => [
                        'vertical' => Alignment::VERTICAL_CENTER,
                        'wrapText' => true,
                    ],
                ]);

                // Baris total di akhir
                $sheet->getStyle("A{$lastRow}:D{$lastRow}")->applyFromArray([
                    'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                    'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '000000']],
                ]);
            },
        ];
    }
}