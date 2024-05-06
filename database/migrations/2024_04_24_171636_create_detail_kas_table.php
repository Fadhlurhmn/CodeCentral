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
        Schema::table('detail_kas', function (Blueprint $table) {
            $table->id('id_kas');
            $table->dateTime('tanggal_transaksi');
            $table->string('tipe_transaksi', 255);
            $table->string('jenis_transaksi', 255);
            $table->string('keterangan', 255);
            $table->integer('nominal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_kas');
    }
};
