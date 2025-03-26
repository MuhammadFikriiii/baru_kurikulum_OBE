<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProfilLulusan extends Model
{
    use HasFactory;
    protected $primaryKey = "kode_pl";
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'deskripsi_pl',
        'profesi_pl',
        'unsur_pl',
        'keterangan_pl',
        'sumber_pl',
    ];

    public function prodi() {
        return $this->belongsTo(Prodi::class, 'kode_prodi', 'kode_prodi');
    }

    public function profillulusans() {
        return $this->hasMany(ProfilLulusan::class, 'kode_pl', 'kode_pl');
    }
}
