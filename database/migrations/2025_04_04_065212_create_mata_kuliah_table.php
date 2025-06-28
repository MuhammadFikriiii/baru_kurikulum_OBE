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
        Schema::create("mata_kuliahs", function (Blueprint $table) {
            $table->string("kode_mk", 20)->primary();
            $table->string("nama_mk",100);
            $table->string("jenis_mk",100);
            $table->integer("sks_mk");
            $table->enum("semester_mk",['1','2','3','4','5','6','7','8']);
            $table->enum("kompetensi_mk", ['pendukung','utama']);
            $table->timestamps();
            
        }); 
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("mata_kuliahs");
    }
};
