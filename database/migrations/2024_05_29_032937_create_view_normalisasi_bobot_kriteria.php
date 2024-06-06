<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("CREATE VIEW `normalisasi_bobot_kriteria`  AS SELECT `kriteria_bansos`.`id_kriteria` AS `id_kriteria`, `kriteria_bansos`.`nama_kriteria` AS `nama_kriteria`, `kriteria_bansos`.`bobot` AS `bobot`, `kriteria_bansos`.`jenis` AS `jenis`, `kriteria_bansos`.`bobot`/ (select sum(`kriteria_bansos`.`bobot`) from `kriteria_bansos`) AS `bobot_tenormalisasi` FROM `kriteria_bansos` ;");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW normalisasi_bobot_kriteria");
    }
};
