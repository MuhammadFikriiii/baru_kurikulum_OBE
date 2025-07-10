<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model {
    use HasFactory;
    protected $primaryKey = 'id_jurusan';
    public $incrementing = true;
    protected $keyType = 'string';
    protected $fillable = ['nama_kajur','nama_jurusan'];

    public function prodis() {
        return $this->hasMany(Prodi::class, 'id_jurusan', 'id_jurusan');
    }
}
