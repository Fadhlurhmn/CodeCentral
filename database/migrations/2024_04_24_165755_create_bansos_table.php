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
        Schema::create('bansos', function (Blueprint $table) {
            $table->id('id_bansos');
            $table->unsignedBigInteger('id_kategori_bansos')->index();
            $table->date('tanggal_pemberian');
            $table->integer('jumlah_penerima');
            $table->string('nama');
            $table->enum('status', ['open', 'closed']);
            $table->timestamps();

            $table->foreign('id_kategori_bansos')->references('id_kategori_bansos')->on('kategori_bansos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bansos');
    }
};
