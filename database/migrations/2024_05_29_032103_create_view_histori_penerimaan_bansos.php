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
        DB::statement("CREATE VIEW `histori_penerimaan_bansos`  AS SELECT DISTINCT `keluarga`.`nomor_keluarga` AS `nomor_keluarga`, `penduduk`.`nama` AS `nama_kepala_keluarga`, `penduduk`.`rt` AS `rt`, `penduduk`.`alamat_domisili` AS `alamat`, `bansos`.`tanggal_pemberian` AS `tanggal_pemberian`, `keluarga`.`id_keluarga` AS `id_keluarga`, `bansos`.`id_bansos` AS `id_bansos`, `bansos`.`nama` AS `nama_bansos` FROM ((((`detail_bansos` join `keluarga_penduduk` `keluarga` on(`detail_bansos`.`id_keluarga` = `keluarga`.`id_keluarga`)) join `detail_keluarga` on(`keluarga`.`id_keluarga` = `detail_keluarga`.`id_keluarga`)) join `penduduk` on(`detail_keluarga`.`id_penduduk` = `penduduk`.`id_penduduk` and `detail_keluarga`.`peran_keluarga` = 'Kepala Keluarga')) join `bansos` on(`detail_bansos`.`id_bansos` = `bansos`.`id_bansos`)) WHERE `detail_bansos`.`status` = 'acc' ;");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW histori_penerimaan_bansos");
    }
};
