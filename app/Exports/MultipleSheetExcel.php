<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;


class MultipleSheetExcel implements WithMultipleSheets
{
    protected $kodeProdi;
    protected $idTahun;

    public function __construct($kodeProdi, $idTahun)
    {
        $this->kodeProdi = $kodeProdi;
        $this->idTahun = $idTahun;
    }

    public function sheets(): array
    {
        return [
            'Profil Lulusan' => new TimProfilLulusanExport($this->kodeProdi, $this->idTahun),
            'CPL' => new TimCapaianPembelajaranLulusanExport($this->kodeProdi, $this->idTahun),
            'Pemetaan CPL-PL' => new TimPemetaanCplPlExport($this->kodeProdi, $this->idTahun),
            'Bahan Kajian' => new BahanKajianExport($this->kodeProdi, $this->idTahun),
            'Pemetaan CPL-BK' => new PemetaanCplBkExport($this->kodeProdi, $this->idTahun),
            'Pemetaan BK-MK' => new PemetaanBkMkExport($this->kodeProdi, $this->idTahun),
            'Pemetaan CPL-MK' => new PemetaanCplMkExport($this->kodeProdi, $this->idTahun),
            'pemetaan CPL-MK-BK' => new PemetaanCplMkBkExport($this->kodeProdi, $this->idTahun),
            'Mata Kuliah' => new MataKuliahExport($this->kodeProdi, $this->idTahun),
            'Organisasi MK' => new OrganisasiMkExport($this->kodeProdi, $this->idTahun),
            'Pemenuhan CPL' => new PemenuhanCplExport($this->kodeProdi, $this->idTahun),
            'Pemetaan CPL - CPMK - MK' => new PemetaanCplCpmkMkExport($this->kodeProdi, $this->idTahun),
            'pemenuhan CPL - CPMK - MK' => new PemenuhanCplCpmkMkExport($this->kodeProdi, $this->idTahun),
            'pemetaan MK - CPL - CPMK' => new PemetaanMkCplCpmkExport($this->kodeProdi, $this->idTahun),
            'pemetaan MK - CPMK - Sub CPMK' => new PemetaanMkCpmkSubCpmkExport($this->kodeProdi, $this->idTahun),
        ];
    }
}
