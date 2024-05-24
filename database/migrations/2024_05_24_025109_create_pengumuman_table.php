<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengumumanTable extends Migration
{
    public function up()
    {
        Schema::create('pengumuman', function (Blueprint $table) {
            $table->id('id_pengumuman');
            $table->unsignedBigInteger('id_user');
            $table->string('judul_pengumuman');
            $table->text('deskripsi');
            $table->timestamps();

            $table->foreign('id_user')->references('id_user')->on('user');
        });
    }

    public function down()
    {
        Schema::dropIfExists('pengumuman');
    }
}
