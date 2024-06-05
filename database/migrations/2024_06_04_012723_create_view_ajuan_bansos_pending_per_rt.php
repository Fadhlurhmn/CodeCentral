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
        DB::statement("CREATE VIEW `ajuan_bansos_pending_per_rt`  AS SELECT DISTINCT `detail_bansos`.`id_bansos` AS `id_bansos`, `detail_bansos`.`id_keluarga` AS `id_keluarga`, `detail_bansos`.`status` AS `status`, `penduduk`.`rt` AS `rt` FROM ((`detail_bansos` join `detail_keluarga` on(`detail_keluarga`.`id_keluarga` = `detail_bansos`.`id_keluarga`)) join `penduduk` on(`detail_keluarga`.`id_penduduk` = `penduduk`.`id_penduduk`)) WHERE `detail_bansos`.`status` = 'pending' ;");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW ajuan_bansos_pending_per_rt");
    }
};
