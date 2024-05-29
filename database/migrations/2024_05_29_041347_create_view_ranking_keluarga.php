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
        DB::statement("CREATE VIEW `ranking_keluarga`  AS SELECT `na`.`id_bansos` AS `id_bansos`, `na`.`id_keluarga` AS `id_keluarga`, `na`.`nilai_akhir` AS `nilai_akhir`, rank() over ( partition by `na`.`id_bansos` order by `na`.`nilai_akhir` desc) AS `rank` FROM `nilai_akhir_keluarga` AS `na` ;");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW ranking_keluarga");
    }
};
