<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCpmk extends Model
{
    protected $table = 'sub_cpmks';
    protected $primaryKey = 'id_sub_cpmk';
    public $incrementing = true;
    public $timestamps = true;
    protected $fillable = ['sub_cpmk', 'id_cpmk', 'uraian_cpmk'];

    public function CapaianPembelajaranMataKuliah()
    {
        return $this->belongsTo(CapaianPembelajaranMataKuliah::class, 'id_cpmk', 'id_cpmk');
    }
}
