<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('capaian_pembelajaran_mata_kuliah', function (Blueprint $table) {
            $table->id('id_cpmk');
            $table->string('kode_cpmk', 10);
            $table->text('deskripsi_cpmk');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('capaian_pembelajaran_mata_kuliahs');
    }
};
