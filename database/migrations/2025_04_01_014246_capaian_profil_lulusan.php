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
        Schema::create("capaian_profil_lulusans", function (Blueprint $table) {
            $table->string("kode_cpl", 10)->primary();
            $table->text("deskripsi_cpl");
            $table->enum("status_cpl",['Kompetensi Utama Bidang', 'Kompetensi Tambahan']);
            $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('capaian_profil_lulusan');
    }
};
