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
        Schema::create('penduduk', function (Blueprint $table) {
            $table->id('id_penduduk');
            $table->unsignedBigInteger('id_keluarga');
            $table->string('nama');
            $table->string('nik');
            $table->string('alamat');
            $table->string('no_telp');
            $table->string('tempat_lahir');
            $table->string('tanggal_lahir');
            $table->string('agama');
            $table->string('pekerjaan');
            $table->string('gol_darah');
            $table->string('rt');
            $table->string('rw');
            $table->string('status_penduduk');
            $table->string('status_data');
            $table->timestamps();

            $table->foreign('id_keluarga')->references('id_keluarga')->on('keluarga_penduduk');
            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penduduk');
    }
};
