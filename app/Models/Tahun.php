<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tahun extends Model
{
    use HasFactory;

    protected $table = 'tahun';

    protected $primaryKey = 'id_tahun';

    public $timestamps = true;

    protected $fillable = [
        'nama_kurikulum',
        'tahun',
    ];

    public function profilLulusans()
    {
        return $this->hasMany(ProfilLulusan::class, 'id_tahun');
    }
}