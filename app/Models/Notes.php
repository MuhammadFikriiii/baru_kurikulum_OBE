<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notes extends Model
{
    use HasFactory;

    protected $table = 'notes';

    protected $primaryKey = 'id_note';

    public $timestamps = true;

    protected $fillable = [
        'note_content',
        'kode_prodi',
        'title',
        'category',
        'user_id', // ⬅️ WAJIB DIISI
    ];

    public function User()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'kode_prodi', 'kode_prodi');
    }
}
