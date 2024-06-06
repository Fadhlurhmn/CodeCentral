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
        DB::statement("CREATE VIEW `max_min_kriteria_perbansos`  AS SELECT `detail_bansos`.`id_bansos` AS `id_bansos`, `detail_bansos`.`id_kriteria` AS `id_kriteria`, max(`detail_bansos`.`nilai_kriteria`) AS `max_nilai`, min(`detail_bansos`.`nilai_kriteria`) AS `min_nilai` FROM `detail_bansos` GROUP BY `detail_bansos`.`id_bansos`, `detail_bansos`.`id_kriteria` ;");

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW max_min_kriteria_perbansos");
    }
};
