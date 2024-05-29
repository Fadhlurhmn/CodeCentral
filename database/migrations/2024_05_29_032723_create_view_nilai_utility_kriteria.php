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
        DB::statement("CREATE VIEW `nilai_utility_kriteria`  AS SELECT `k`.`id_keluarga` AS `id_keluarga`, `k`.`id_kriteria` AS `id_kriteria`, `k`.`nilai_kriteria` AS `nilai_kriteria`, `m`.`max_nilai` AS `max_nilai`, `m`.`min_nilai` AS `min_nilai`, `j`.`jenis` AS `jenis`, `k`.`id_bansos` AS `id_bansos`, coalesce(case when `j`.`jenis` = 'benefit' then cast(`k`.`nilai_kriteria` - `m`.`min_nilai` as double) / cast(`m`.`max_nilai` - `m`.`min_nilai` as double) when `j`.`jenis` = 'cost' then cast(`m`.`max_nilai` - `k`.`nilai_kriteria` as double) / cast(`m`.`max_nilai` - `m`.`min_nilai` as double) end,0) AS `utility` FROM ((`detail_bansos` `k` join `max_min_kriteria_perbansos` `m` on(`k`.`id_kriteria` = `m`.`id_kriteria` and `k`.`id_bansos` = `m`.`id_bansos`)) join `kriteria_bansos` `j` on(`k`.`id_kriteria` = `j`.`id_kriteria`)) GROUP BY `k`.`id_bansos`, `k`.`id_keluarga`, `k`.`id_kriteria`, `k`.`nilai_kriteria`, `m`.`max_nilai`, `m`.`min_nilai`, `j`.`jenis` ;");          
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW nilai_utility_kriteria");
    }
};
