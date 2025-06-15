<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WadirNote extends Model
{
    use HasFactory;

    protected $table = 'wadir_notes';

    protected $primaryKey = 'id_note';

    public $timestamps = true;

    protected $fillable = [
        'note_content', 
        'title',       
        'category'     
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}