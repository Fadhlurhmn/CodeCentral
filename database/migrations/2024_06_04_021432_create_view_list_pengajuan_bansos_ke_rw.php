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
        DB::statement("CREATE VIEW `list_pengajuan_bansos_ke_rw`  AS SELECT DISTINCT `nilai_akhir_keluarga_per_rt`.`id_bansos` AS `id_bansos`, `nilai_akhir_keluarga_per_rt`.`id_keluarga` AS `id_keluarga`, `nilai_akhir_keluarga_per_rt`.`nilai_akhir` AS `nilai_akhir` FROM (`nilai_akhir_keluarga_per_rt` join `detail_bansos` on(`detail_bansos`.`id_bansos` = `nilai_akhir_keluarga_per_rt`.`id_bansos`)) WHERE `detail_bansos`.`status` = 'acc_rt' ;");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW list_pengajuan_bansos_ke_rw");
    }
};
