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
            $table->unsignedBigInteger('id_jurusan');
            $table->string('nama_prodi', 50);
            $table->string('pt_prodi', 100);
            $table->date('tgl_berdiri_prodi');
            $table->date('penyelenggaraan_prodi');
            $table->string('nomor_sk');
            $table->date('tanggal_sk');
            $table->string('peringkat_akreditasi');
            $table->string('nomor_sk_banpt');
            $table->string('jenjang_pendidikan');
            $table->string('gelar_lulusan');
            $table->string('telepon_prodi')->nullable();
            $table->string('faksimili_prodi')->nullable();
            $table->string('website_prodi')->nullable();
            $table->string('email_prodi')->nullable();
            $table->foreign('id_jurusan')->references('id_jurusan')->on('jurusans')->onUpdate('cascade')->onDelete('cascade');
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
