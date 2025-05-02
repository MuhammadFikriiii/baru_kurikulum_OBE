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
        Schema::create('prodis', function (Blueprint $table) {
            $table->string('kode_prodi', 10)->primary();
            $table->string('kode_jurusan', 10)->nullable();
            $table->string('nama_prodi', 50);
            $table->string('fakultas_prodi', 100);
            $table->string('pt_prodi', 100);
            $table->date('tgl_berdiri_prodi');
            $table->date('penyelenggaraan_prodi');
            $table->string('nomor_sk');
            $table->date('tanggal_sk');
            $table->string('peringkat_akreditasi');
            $table->string('nomor_sk_banpt');
            $table->string('jenjang_pendidikan');
            $table->string('gelar_lulusan');
            $table->string('alamat_prodi');
            $table->string('telepon_prodi');
            $table->string('faksimili_prodi');
            $table->string('website_prodi');
            $table->string('email_prodi');
            $table->foreign('kode_jurusan')->references('kode_jurusan')->on('jurusans')->onUpdate('cascade')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prodis');
    }
};
