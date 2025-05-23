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
        Schema::create('penilaian', function (Blueprint $table) {
            $table->id('id_penilaian');
            $table->unsignedBigInteger('id_cpl');
            $table->string('kode_mk');
            $table->unsignedBigInteger('id_cpmk');
            $table->integer('kuis');
            $table->integer('observasi');
            $table->integer('presentasi');
            $table->integer('uts');
            $table->integer('uas');
            $table->integer('project');

            $table->foreign('id_cpl')->references('id_cpl')->on('capaian_profil_lulusans')->onDelete('cascade');
            $table->foreign('kode_mk')->references('kode_mk')->on('mata_kuliahs')->onDelete('cascade');
            $table->foreign('id_cpmk')->references('id_cpmk')->on('capaian_pembelajaran_mata_kuliahs')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penilaian');
    }
};
