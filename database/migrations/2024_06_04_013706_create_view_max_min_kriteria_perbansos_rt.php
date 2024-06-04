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
        DB::statement("CREATE VIEW `max_min_kriteria_perbansos_rt`  AS SELECT `detail_bansos`.`id_bansos` AS `id_bansos`, `detail_bansos`.`id_kriteria` AS `id_kriteria`, `alternatif_per_rt`.`rt` AS `rt`, max(`detail_bansos`.`nilai_kriteria`) AS `max_nilai`, min(`detail_bansos`.`nilai_kriteria`) AS `min_nilai` FROM (`detail_bansos` join `alternatif_per_rt` on(`detail_bansos`.`id_keluarga` = `alternatif_per_rt`.`id_keluarga`)) GROUP BY `detail_bansos`.`id_bansos`, `alternatif_per_rt`.`rt`, `detail_bansos`.`id_kriteria` ;");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW max_min_kriteria_perbansos_rt");
    }
};
