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
            'Pemetaan CPL-MK' => new PemetaanCplMkExport($this->kodeProdi),
            'pemetaan CPL-MK-BK' => new PemetaanCplMkBkExport($this->kodeProdi),
            'Mata Kuliah' => new MataKuliahExport($this->kodeProdi),
            'Organisasi MK' => new OrganisasiMkExport($this->kodeProdi),
            'Pemenuhan CPL' => new PemenuhanCplExport($this->kodeProdi),
            'Pemetaan CPL - CPMK - MK' => new PemetaanCplCpmkMkExport($this->kodeProdi),
            'pemenuhan CPL - CPMK - MK' => new PemenuhanCplCpmkMkExport($this->kodeProdi),
            'pemetaan MK - CPL - CPMK' => new PemetaanMkCplCpmkExport($this->kodeProdi),
        ];
    }
}