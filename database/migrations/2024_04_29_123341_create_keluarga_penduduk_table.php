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
        Schema::create('keluarga_penduduk', function (Blueprint $table) {
            $table->id('id_keluarga');
            $table->string('nomor_keluarga');
            $table->string('jumlah_kendaraan');
            $table->string('jumlah_tanggungan');
            $table->string('jumlah_orang_kerja');
            $table->string('luas_tanah');
            $table->timestamps();
            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('keluarga_penduduk', function (Blueprint $table) {
            Schema::dropIfExists('keluarga_penduduk');
        });
    }
};
