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
        Schema::create("profil_lulusans", function (Blueprint $table) {
            $table->id('id_pl');
            $table->string('kode_pl', 10);
            $table->string('kode_prodi', 10);
            $table->unsignedBigInteger('id_tahun');
            $table->text('deskripsi_pl');
            $table->text('profesi_pl');
            $table->enum('unsur_pl',['Pengetahuan','Keterampilan Khusus', 'Sikap dan Keterampilan Umum']);
            $table->enum('keterangan_pl',['Kompetensi Utama Bidang', 'Kompetensi Tambahan']);
            $table->text('sumber_pl');
            $table->foreign('kode_prodi')->references('kode_prodi')->on('prodis')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_tahun')->references('id_tahun')->on('tahun')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profil_lulusans');
    }
};
