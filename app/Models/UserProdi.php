<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;  // Import User sebagai Authenticatable
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProdi extends Authenticatable
{
    use HasFactory;

    protected $table = 'userprodis';

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'kode_prodi',
    ];

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'kode_prodi', 'kode_prodi');
    }
}
