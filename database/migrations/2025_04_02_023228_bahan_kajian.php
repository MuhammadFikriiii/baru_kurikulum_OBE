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
        Schema::create("bahan_kajians", function (Blueprint $table) {
            $table->string("kode_bk", 10)->primary();
            $table->string("nama_bk",50);
            $table->text("deskripsi_bk")->nullable();
            $table->string("referensi_bk",50)->nullable();
            $table->enum("status_bk", ['core','elective']);
            $table->text("knowledge_area")->nullable();
            $table->integer("max_bk")->nullable();
            $table->integer("min_bk")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("bahan_kajians");
    }
};
