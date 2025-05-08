<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prodi extends Model {
    use HasFactory;
    protected $primaryKey = 'kode_prodi';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['kode_prodi', 'kode_jurusan', 'nama_prodi','fakultas_prodi',
    'pt_prodi',
    'tgl_berdiri_prodi',
    'penyelenggaraan_prodi',
    'nomor_sk',
    'tanggal_sk',
    'peringkat_akreditasi',
    'nomor_sk_banpt',
    'jenjang_pendidikan',
    'gelar_lulusan',
    'alamat_prodi',
    'telepon_prodi',
    'faksimili_prodi',
    'website_prodi',
    'email_prodi',];

    public function jurusan() {
        return $this->belongsTo(Jurusan::class, 'kode_jurusan', 'kode_jurusan');
    }

    public function profillulusans() {
        return $this->hasMany(ProfilLulusan::class, 'kode_prodi', 'kode_prodi');
    }

    public function user() {
        return $this->HasMany(User::class, 'kode_prodi', 'kode_prodi');
    }
    
}

