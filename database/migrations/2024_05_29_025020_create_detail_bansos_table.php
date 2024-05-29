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
        Schema::create('detail_bansos', function (Blueprint $table) {
            $table->unsignedBigInteger('id_bansos')->index();
            $table->unsignedBigInteger('id_keluarga')->index();
            $table->enum('status', ['acc', 'pending', 'tolak']);
            $table->unsignedBigInteger('id_kriteria')->index();
            $table->integer('nilai_kriteria');

            $table->timestamps();

            $table->foreign('id_bansos')->references('id_bansos')->on('bansos');
            $table->foreign('id_keluarga')->references('id_keluarga')->on('keluarga_penduduk');
            $table->foreign('id_kriteria')->references('id_kriteria')->on('kriteria_bansos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_bansos');
    }
};
