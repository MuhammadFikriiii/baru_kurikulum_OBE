<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CapaianProfilLulusan extends Model
{
    use HasFactory;
    protected $table = 'capaian_profil_lulusans';
    protected $primaryKey = 'kode_cpl';
    public $incrementing = false;
    protected $fillable = [
        'kode_cpl',
        'deskripsi_cpl',
        'status_cpl'
    ];
    public function profilLulusans()
    {
        return $this->belongsToMany(ProfilLulusan::class, 'profil_lulusan_capaian_profil_lulusan', 'kode_cpl', 'kode_pl');
    }
}
