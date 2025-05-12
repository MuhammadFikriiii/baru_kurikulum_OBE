<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Exports\ProfilLulusanExport;
use App\Exports\CapaianPembelajaranLulusanExport;

class MultipleSheetExcel implements WithMultipleSheets
{
    protected $kodeProdi;

    public function __construct($kodeProdi)
    {
        $this->kodeProdi = $kodeProdi;
    }

    public function sheets(): array
    {
        return [
            'Profil Lulusan' => new TimProfilLulusanExport($this->kodeProdi),
            'CPL' => new TimCapaianPembelajaranLulusanExport($this->kodeProdi),
            'Pemetaan CPL-PL' => new TimPemetaanCplPlExport($this->kodeProdi),
            'Bahan Kajian' => new BahanKajianExport($this->kodeProdi),
            'Pemetaan CPL-BK' => new PemetaanCplBkExport($this->kodeProdi),
            'Pemetaan BK-MK' => new PemetaanBkMkExport($this->kodeProdi),
        ];
    }
}