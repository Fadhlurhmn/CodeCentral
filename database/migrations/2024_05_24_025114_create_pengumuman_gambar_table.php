<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengumumanGambarTable extends Migration
{
    public function up()
    {
        Schema::create('pengumuman_gambar', function (Blueprint $table) {
            $table->id('id_pengumuman_gambar');
            $table->unsignedBigInteger('id_pengumuman');
            $table->string('pengumuman_gambar');
            $table->timestamps();

            $table->foreign('id_pengumuman')->references('id_pengumuman')->on('pengumuman');
        });
    }

    public function down()
    {
        Schema::dropIfExists('pengumuman_gambar');
    }
}
