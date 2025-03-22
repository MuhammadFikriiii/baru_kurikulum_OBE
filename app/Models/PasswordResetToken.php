<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasswordResetToken extends Model
{
    use HasFactory;

    protected $table = 'password_reset_tokens';

    protected $primaryKey = 'token'; // Set primary key ke 'token'
    public $incrementing = false; // Nonaktifkan auto-increment (karena token bukan angka)
    protected $keyType = 'string'; // Pastikan primary key berupa string

    protected $fillable = ['email', 'token', 'created_at'];

    public $timestamps = false; // Hindari error karena tidak ada 'updated_at'
}