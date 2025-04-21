<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CapaianPembelajaranMataKuliah extends Model
{
    protected $table = 'capaian_pembelajaran_mata_kuliahs';

    protected $primaryKey = 'id_cpmk';

    protected $fillable = [
        'kode_cpmk',
        'deskripsi_cpmk',
    ];

    public function mataKuliah()
    {
        return $this->belongsToMany(MataKuliah::class, 'cpmk_mk', 'id_cpmk', 'id_cpmk');
    }

    public function prodi()
    {
        return $this->belongsToMany(Prodi::class, 'prodi');
    }

    public function capaianProfilLulusan()
    {
        return $this->belongsToMany(CapaianProfilLulusan::class, 'cpl_cpmk', 'id_cpmk', 'id_cpl');
    }
    

}
