<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BahanKajian extends Model
{
    use HasFactory;
    protected $table = 'bahan_kajians';
    protected $primaryKey = 'kode_bk';
    public $incrementing = false;
    public $timestamps = true;
    protected $fillable = [
        'kode_bk',
        'nama_bk',
        'deskripsi_bk',
        'referensi_bk',
        'status_bk',
        'knowledge_area',
        'max_bk',
        'min_bk'
    ];
    public function capaianprofilLulusans()
    {
        return $this->belongsToMany(CapaianProfilLulusan::class, 'cpl_bk', 'kode_bk', 'kode_cpl');
    }

    public function matakuliahs()
    {
        return $this->belongsToMany(MataKuliah::class, 'mk_bk', 'kode_bk', 'kode_mk');
    }

    public function cplMkBks()
    {
        return $this->hasMany(CplMkBk::class, 'kode_bk', 'kode_bk');
    }

}
