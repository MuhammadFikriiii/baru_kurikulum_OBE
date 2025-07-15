<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Misi extends Model
{
    protected $fillable = [
        'misi',
        'visi_id',
    ];

    public function visi()
    {
        return $this->belongsTo(Visi::class, 'visi_id');
    }
}
