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
            $table->string('nomor_keluarga', 100)->unique();
            // $table->text('alamat');
            // $table->string('rt', 3);
            // $table->string('rw', 3);
            // $table->string('kelurahan', 100);
            // $table->string('kecamatan', 100);
            // $table->string('kota', 100);
            $table->integer('jumlah_kendaraan');
            $table->integer('jumlah_tanggungan');
            $table->integer('jumlah_orang_kerja');
            // $table->double('luas_tanah');
            $table->string('foto_kk', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keluarga_penduduk');
    }
};
