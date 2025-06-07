<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WadirNote extends Model
{
    use HasFactory;

    protected $fillable = ['prodi_id', 'note', 'created_by'];

    public function prodi()
    {
        return $this->belongsTo(Prodi::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}