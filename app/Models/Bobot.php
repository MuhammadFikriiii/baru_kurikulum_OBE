<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bobot extends Model
{
    protected $table = 'bobots';
    protected $primaryKey = 'id_bobot';

    public $timestamps = false;
    protected $fillable = [
        'id_cpl',
        'kode_mk',
        'bobot',
    ];

    public function capaianProfilLulusan()
    {
        return $this->belongsTo(CapaianProfilLulusan::class, 'id_cpl', 'id_cpl');
    }

    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class, 'kode_mk', 'kode_mk');
    }
}
