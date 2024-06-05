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
        Schema::create('detail_jadwal_keamanan', function (Blueprint $table) {
            $table->unsignedBigInteger('id_jadwal_keamanan')->index();
            $table->unsignedBigInteger('id_satpam')->index();
            $table->enum('waktu', ['Pagi', 'Siang - Sore', 'Malam']);
            $table->timestamps();

            $table->foreign('id_jadwal_keamanan')->references('id_jadwal_keamanan')->on('jadwal_keamanan');
            $table->foreign('id_satpam')->references('id_satpam')->on('satpam');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_jadwal_keamanan');
    }
};
