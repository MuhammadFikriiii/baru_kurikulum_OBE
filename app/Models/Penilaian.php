<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    protected $table = 'penilaian';
    protected $primaryKey = 'id_penilaian';
    protected $fillable = [
        'id_cpl',
        'kode_mk',
        'id_cpmk',
        'kuis',
        'observasi',
        'presentasi',
        'uts',
        'uas',
        'project'
    ];

    public function cpl()
    {
        return $this->belongsTo(CapaianProfilLulusan::class, 'id_cpl', 'id_cpl');
    }

    public function mk()
    {
        return $this->belongsTo(MataKuliah::class, 'kode_mk', 'kode_mk');
    }

    public function cpmk()
    {
        return $this->belongsTo(CapaianPembelajaranMataKuliah::class, 'id_cpmk', 'id_cpmk');
    }
}
