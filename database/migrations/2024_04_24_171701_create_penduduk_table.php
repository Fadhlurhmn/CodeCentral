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
        Schema::table('penduduk', function (Blueprint $table) {
            $table->id('id_penduduk');
            $table->string('nama', 100);
            $table->string('nik', 100)->unique();
            $table->text('alamat_ktp');
            $table->text('alamat_domisili');
            $table->integer('no_telp');
            $table->string('tempat_lahir', 200);
            $table->date('tanggal_lahir');
            $table->string('agama', 200);
            $table->string('pekerjaan', 200);
            $table->string('gol_darah', 3);
            $table->string('status_data', 100);
            $table->string('rt', 3);
            $table->string('rw', 3);
            $table->string('status_penduduk', 100);
            $table->string('foto_ktp', 255);
            $table->timestamps();
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
