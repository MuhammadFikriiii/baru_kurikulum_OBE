<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prodi extends Model {
    use HasFactory;
    protected $primaryKey = 'kode_prodi';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['kode_prodi', 'kode_jurusan', 'nama_prodi'];

    public function jurusan() {
        return $this->belongsTo(Jurusan::class, 'kode_jurusan', 'kode_jurusan');
    }

    public function profillulusans() {
        return $this->hasMany(ProfilLulusan::class, 'kode_pl', 'kode_pl');
    }

    public function userprodis() {
        return $this->HasMany(UserProdi::class, 'kode_prodi', 'kode_prodi');
    }
    
}

