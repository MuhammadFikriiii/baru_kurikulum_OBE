<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class PemenuhanCplExport implements FromArray, WithHeadings, WithTitle, WithStyles
{
    protected $kodeProdi;

    public function __construct($kodeProdi)
    {
        $this->kodeProdi = $kodeProdi;
    }

    public function array(): array
    {
        // Ambil data CPL berdasarkan prodi
        $dataCPL = DB::table('capaian_profil_lulusans as cpl')
            ->join('cpl_pl', 'cpl.id_cpl', '=', 'cpl_pl.id_cpl')
            ->join('profil_lulusans as pl', 'cpl_pl.id_pl', '=', 'pl.id_pl')
            ->where('pl.kode_prodi', $this->kodeProdi)
            ->select('cpl.id_cpl', 'cpl.kode_cpl')
            ->get();

        // Ambil mapping MK terhadap CPL, per semester
        $mkCPL = DB::table('cpl_mk')
            ->join('mata_kuliahs as mk', 'cpl_mk.kode_mk', '=', 'mk.kode_mk')
            ->join('capaian_profil_lulusans as cpl', 'cpl_mk.id_cpl', '=', 'cpl.id_cpl')
            ->join('cpl_pl', 'cpl.id_cpl', '=', 'cpl_pl.id_cpl')
            ->join('profil_lulusans as pl', 'cpl_pl.id_pl', '=', 'pl.id_pl')
            ->where('pl.kode_prodi', $this->kodeProdi)
            ->select('cpl.id_cpl', 'mk.nama_mk', 'mk.semester_mk')
            ->get()
            ->groupBy('id_cpl');

        $rows = [];

        foreach ($dataCPL as $item) {
            $row = [];
            $row[] = $item->kode_cpl;

            for ($i = 1; $i <= 8; $i++) {
                // Ambil nama matakuliah per MK, jangan split per kata, langsung pakai array per mk
                $semesterMks = $mkCPL->get($item->id_cpl)?->filter(function ($mk) use ($i) {
                    return $mk->semester_mk == $i;
                })->pluck('nama_mk')->toArray() ?? [];

                // Gabungkan dengan line break per matakuliah (bukan per kata)
                $row[] = implode("\n", $semesterMks);
            }

            $rows[] = $row;
        }

        return $rows;
    }

    public function headings(): array
    {
        $headings = ['CPL'];
        for ($i = 1; $i <= 8; $i++) {
            $headings[] = 'Semester ' . $i;
        }
        return $headings;
    }

    public function title(): string
    {
        return 'Pemenuhan CPL';
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getColumnDimension('B')->setWidth(30);
        $sheet->getColumnDimension('C')->setWidth(30);
        $sheet->getColumnDimension('D')->setWidth(30);
        $sheet->getColumnDimension('E')->setWidth(30);
        $sheet->getColumnDimension('F')->setWidth(30);
        $sheet->getColumnDimension('G')->setWidth(30);
        $sheet->getColumnDimension('H')->setWidth(30);
        $sheet->getColumnDimension('I')->setWidth(30);
        // Judul di baris 1
        $sheet->insertNewRowBefore(1, 1);
        $sheet->setCellValue('A1', '11. Pemenuhan CPL');
        $sheet->mergeCells('A1:I1');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);

        // Style header baris 2 (warna background hijau tua, font putih, bold)
        $headerRange = 'A2:I2';
        $sheet->getStyle($headerRange)->getFont()->setBold(true)->getColor()->setRGB('FFFFFF');
        $sheet->getStyle($headerRange)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('226C32'); // hijau tua mirip tailwind bg-green-800
        $sheet->getStyle($headerRange)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle($headerRange)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);

        // Wrap text mulai baris 3 sampai terakhir agar line break terlihat
        $lastRow = $sheet->getHighestRow();
        $sheet->getStyle("A3:I$lastRow")->getAlignment()->setWrapText(true);
        $sheet->getStyle("A3:I$lastRow")->getAlignment()->setVertical(Alignment::VERTICAL_TOP); // top align agar teks mulai atas cell

        // Center align kolom CPL dan semester di baris 3 dst
        $sheet->getStyle("A3:A$lastRow")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        for ($col = 'B'; $col !== 'J'; $col++) {
            $sheet->getStyle("$col" . "3:$col$lastRow")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
        }

        // Optional: beri border (line) tabel agar mirip tampilan web
        $sheet->getStyle("A2:I$lastRow")->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

        return [];
    }
}