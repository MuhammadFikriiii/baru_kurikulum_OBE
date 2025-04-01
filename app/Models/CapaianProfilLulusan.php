<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CapaianProfilLulusan extends Model
{
    use HasFactory;
    protected $table = 'profil_lulusans';
    protected $primaryKey = 'kode_pl';
    public $incrementing = false;
    protected $keyType = 'string';
}
