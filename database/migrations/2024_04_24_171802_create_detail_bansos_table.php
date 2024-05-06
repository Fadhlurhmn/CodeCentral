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
        Schema::table('detail_bansos', function (Blueprint $table) {
            $table->unsignedBigInteger('id_bansos')->index();
            $table->unsignedBigInteger('id_keluarga')->index();
            $table->timestamps();

            $table->foreign('id_bansos')->references('id_bansos')->on('bansos');
            $table->foreign('id_keluarga')->references('id_keluarga')->on('keluarga_penduduk');
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
