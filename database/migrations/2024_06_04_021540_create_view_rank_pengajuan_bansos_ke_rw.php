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
        DB::statement("CREATE VIEW `rank_pengajuan_bansos_ke_rw`  AS SELECT `list_pengajuan_bansos_ke_rw`.`id_bansos` AS `id_bansos`, `list_pengajuan_bansos_ke_rw`.`id_keluarga` AS `id_keluarga`, `list_pengajuan_bansos_ke_rw`.`nilai_akhir` AS `nilai_akhir`, rank() over ( order by `list_pengajuan_bansos_ke_rw`.`nilai_akhir` desc) AS `rank` FROM `list_pengajuan_bansos_ke_rw` ;");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW rank_pengajuan_bansos_ke_rw");
    }
};
