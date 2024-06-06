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
        DB::statement("CREATE VIEW `ranking_keluarga_per_rt`  AS SELECT `na`.`id_bansos` AS `id_bansos`, `a`.`rt` AS `rt`, `na`.`id_keluarga` AS `id_keluarga`, `na`.`nilai_akhir` AS `nilai_akhir`, rank() over ( partition by `na`.`id_bansos`,`a`.`rt` order by `na`.`nilai_akhir` desc) AS `rank` FROM (`nilai_akhir_keluarga_per_rt` `na` join `alternatif_per_rt` `a` on(`na`.`id_bansos` = `a`.`id_bansos` and `na`.`id_keluarga` = `a`.`id_keluarga`)) ;");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW ranking_keluarga_per_rt");
    }
};
