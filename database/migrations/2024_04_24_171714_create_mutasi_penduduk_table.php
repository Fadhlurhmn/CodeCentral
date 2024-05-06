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
        Schema::table('mutasi_penduduk', function (Blueprint $table) {
            $table->id('id_mutasi');
            $table->unsignedBigInteger('id_penduduk')->index();
            $table->date('tanggal_mutasi');
            $table->int('status');
            $table->timestamps();

            $table->foreign('id_penduduk')->references('id_penduduk')->on('penduduk');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mutasi_penduduk');
    }
};
