<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MataKuliah extends Model
{
    use HasFactory;
    protected $table = 'mata_kuliahs';
    protected $primaryKey = 'kode_mk';
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = [
        'kode_mk',
        'nama_mk',
        'jenis_mk',
        'sks_mk',
        'semester_mk',
        'kompetensi_mk'
    ];

    public function bahankajians()
    {
        return $this->belongsToMany(BahanKajian::class,'cpl_mk','kode_cpl','kode_mk');
    }

    public function capaianprofilLulusans()
    {
        return $this->belongsToMany(CapaianProfilLulusan::class, 'cpl_mk', 'kode_mk', 'kode_cpl');
    }
}
