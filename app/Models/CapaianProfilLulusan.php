<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CapaianProfilLulusan extends Model
{
    use HasFactory;
    protected $table = 'capaian_profil_lulusans';
    protected $primaryKey = 'id_cpl';
    protected $keyType = 'int';
    public $incrementing = true;
    protected $fillable = [
        'kode_cpl',
        'deskripsi_cpl',
        'status_cpl'
    ];
    public function profilLulusans()
    {
        return $this->belongsToMany(ProfilLulusan::class, 'cpl_pl', 'id_cpl', 'id_pl');
    }

    public function bahankajians()
    {
        return $this->belongsToMany(BahanKajian::class,'cpl_bk','id_cpl','id_bk');
    }

    public function MataKuliahs()
    {
        return $this->belongsToMany(MataKuliah::class,'cpl_mk','id_cpl','kode_mk');
    }

    public function CapaianPembelajaranMataKuliahs()
    {
        return $this->belongsToMany(CapaianPembelajaranMataKuliah::class, 'cpl_cpmk', 'kode_cpl', 'kode_cpmk');
    }
}
