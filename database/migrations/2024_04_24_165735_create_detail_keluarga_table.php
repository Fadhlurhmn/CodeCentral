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
        Schema::create('detail_keluarga', function (Blueprint $table) {
            $table->unsignedBigInteger('id_keluarga')->index();
            $table->unsignedBigInteger('id_penduduk')->index();
            $table->string('peran_keluarga', 100);
            $table->timestamps();

            $table->foreign('id_keluarga')->references('id_keluarga')->on('keluarga_penduduk');
            $table->foreign('id_penduduk')->references('id_penduduk')->on('penduduk');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_keluarga');
    }
};
