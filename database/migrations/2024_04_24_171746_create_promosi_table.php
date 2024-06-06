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
        Schema::create('promosi', function (Blueprint $table) {
            $table->id('id_promosi');
            $table->unsignedBigInteger('id_penduduk')->index();
            $table->string('nama_usaha', 100);
            $table->string('gambar', 255);
            $table->text('deskripsi');
            $table->string('kategori', 20);
            $table->string('status_pengajuan', 20);
            $table->text('alamat');
            $table->dateTime('countdown');
            $table->timestamps();

            $table->foreign('id_penduduk')->references('id_penduduk')->on('penduduk');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promosi');
    }
};
