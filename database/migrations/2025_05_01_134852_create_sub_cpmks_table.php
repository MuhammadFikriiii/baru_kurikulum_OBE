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
        Schema::create('sub_cpmks', function (Blueprint $table) {
            $table->id('id_sub_cpmk');
            $table->unsignedBigInteger('id_cpmk');
            $table->string('sub_cpmk', 50);
            $table->text('uraian_cpmk');
            $table->foreign('id_cpmk')->references('id_cpmk')->on('capaian_pembelajaran_mata_kuliahs')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_cpmks');
    }
};
