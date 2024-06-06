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
        DB::statement("CREATE VIEW `alternatif_per_rt`  AS SELECT DISTINCT `detail_bansos`.`id_bansos` AS `id_bansos`, `penduduk`.`rt` AS `rt`, `detail_bansos`.`id_keluarga` AS `id_keluarga`, `penduduk`.`id_penduduk` AS `id_penduduk` FROM ((`detail_bansos` join `detail_keluarga` on(`detail_keluarga`.`id_keluarga` = `detail_bansos`.`id_keluarga`)) join `penduduk` on(`penduduk`.`id_penduduk` = `detail_keluarga`.`id_penduduk`)) WHERE `detail_keluarga`.`peran_keluarga` = 'Kepala Keluarga' GROUP BY `detail_bansos`.`id_bansos`, `penduduk`.`rt`, `detail_bansos`.`id_keluarga`, `penduduk`.`id_penduduk` ;");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW alternatif_per_rt;");
    }
};
