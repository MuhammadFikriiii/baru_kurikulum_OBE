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
            $table->string('kode_pl', 10)->primary();
            $table->string('kode_prodi', 10);
            $table->text('deskripsi_pl');
            $table->text('profesi_pl');
            $table->enum('unsur_pl',['Pengetahuan','Keterampilan Khusus', 'Sikap dan Keterampilan Umum']);
            $table->enum('keterangan_pl',['Kompetensi Utama Bidang','Kompetensi Utama', 'Kompetensi_tambahan']);
            $table->text('sumber_pl');
            $table->foreign('kode_prodi')->references('kode_prodi')->on('prodis')->onDelete('cascade');
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
