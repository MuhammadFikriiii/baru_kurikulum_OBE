<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visi extends Model
{
    protected $fillable = [
        'visi',
    ];

    public function misi()
    {
        return $this->hasMany(Misi::class, 'visi_id');
    }
}
