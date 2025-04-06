<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CplMkBk extends Model
{
    public $timestamps = false; // karena tabel ini nggak pakai timestamps
    protected $table = 'cpl_mk_bk';

    protected $fillable = [
        'kode_cpl',
        'kode_mk',
        'kode_bk'
    ];

    public function capaianProfilLulusans()
    {
        return $this->belongsTo(CapaianProfilLulusan::class, 'kode_cpl', 'kode_cpl');
    }

    public function mataKuliahs()
    {
        return $this->belongsTo(MataKuliah::class, 'kode_mk', 'kode_mk');
    }

    public function bahanKajians()
    {
        return $this->belongsTo(BahanKajian::class, 'kode_bk', 'kode_bk');
    }
}
