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
        Schema::create("cpl_mk", function (Blueprint $table) {
            $table->string('kode_cpl');
            $table->string('kode_mk');
            $table->foreign('kode_cpl')->references('kode_cpl')->on('capaian_profil_lulusans')->onDelete('cascade');
            $table->foreign('kode_mk')->references('kode_mk')->on('mata_kuliahs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cpl_mk');
    }
};
