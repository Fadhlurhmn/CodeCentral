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
        DB::statement("CREATE VIEW `alternatif`  AS SELECT DISTINCT `detail_bansos`.`id_keluarga` AS `id_keluarga`, `detail_bansos`.`id_bansos` AS `id_bansos` FROM `detail_bansos` ;");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW alternatif");
    }
};
