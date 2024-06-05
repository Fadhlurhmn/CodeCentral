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
        DB::statement("CREATE VIEW `nilai_akhir_keluarga_per_rt`  AS SELECT `nu`.`id_bansos` AS `id_bansos`, `a`.`rt` AS `rt`, `nu`.`id_keluarga` AS `id_keluarga`, sum(`nu`.`utility` * `nbk`.`bobot_tenormalisasi`) AS `nilai_akhir` FROM ((`nilai_utility_kriteria_per_rt` `nu` join `normalisasi_bobot_kriteria` `nbk` on(`nu`.`id_kriteria` = `nbk`.`id_kriteria`)) join `alternatif_per_rt` `a` on(`nu`.`id_bansos` = `a`.`id_bansos` and `nu`.`id_keluarga` = `a`.`id_keluarga` and `nu`.`rt` = `a`.`rt`)) GROUP BY `nu`.`id_bansos`, `a`.`rt`, `nu`.`id_keluarga` ;");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW nilai_akhir_keluarga_per_rt");
    }
};
