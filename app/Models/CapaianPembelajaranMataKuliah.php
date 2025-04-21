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
        return $this->belongsToMany(MataKuliah::class, 'id_mk', 'id_mk');
    }

    public function prodi()
    {
        return $this->belongsToMany(Prodi::class, 'id_prodi', 'kode_prodi');
    }
}
