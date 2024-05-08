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
        Schema::create('umkm', function (Blueprint $table) {
            $table->id('id_umkm');
            $table->unsignedBigInteger('id_keluarga')->index();
            $table->string('nama_usaha', 100);
            $table->string('gambar', 100);
            $table->text('deskripsi');
            $table->string('status_pengajuan', 100);
            $table->text('alamat');
            $table->dateTime('countdown');
            $table->timestamps();

            $table->foreign('id_keluarga')->references('id_keluarga')->on('keluarga_penduduk');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('umkm');
    }
};
