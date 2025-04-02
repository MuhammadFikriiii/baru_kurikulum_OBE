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
    protected $fillable = [
        'kode_bk',
        'nama_bk',
        'deskripsi_bk',
        'referensi_bk',
        'status_bk',
        'knowlede_area',
        'max_bk',
        'min_bk'
    ];
}
