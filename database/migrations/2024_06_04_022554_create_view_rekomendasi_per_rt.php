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
        DB::statement("CREATE VIEW `rekomendasi_per_rt`  AS SELECT `ranking_keluarga_per_rt`.`id_bansos` AS `id_bansos`, `ranking_keluarga_per_rt`.`rt` AS `rt`, `ranking_keluarga_per_rt`.`id_keluarga` AS `id_keluarga`, `ranking_keluarga_per_rt`.`rank` AS `rank`, `penduduk`.`nama` AS `nama_kepala_keluarga`, `keluarga_penduduk`.`nomor_keluarga` AS `nomor_keluarga`, `penduduk`.`alamat_domisili` AS `alamat` FROM (((`ranking_keluarga_per_rt` join `keluarga_penduduk` on(`ranking_keluarga_per_rt`.`id_keluarga` = `keluarga_penduduk`.`id_keluarga`)) join `detail_keluarga` on(`keluarga_penduduk`.`id_keluarga` = `detail_keluarga`.`id_keluarga`)) join `penduduk` on(`penduduk`.`id_penduduk` = `detail_keluarga`.`id_penduduk`)) WHERE `detail_keluarga`.`peran_keluarga` = 'Kepala Keluarga' ;");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW rekomendasi_per_rt");
    }
};
