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
        DB::statement("CREATE VIEW `pengajuan_bansos_acc_rt`  AS SELECT `rank_pengajuan_bansos_ke_rw`.`id_bansos` AS `id_bansos`, `rank_pengajuan_bansos_ke_rw`.`id_keluarga` AS `id_keluarga`, `rank_pengajuan_bansos_ke_rw`.`rank` AS `rank`, `penduduk`.`nama` AS `nama_kepala_keluarga`, `penduduk`.`alamat_domisili` AS `alamat`, `penduduk`.`rt` AS `rt`, `keluarga_penduduk`.`nomor_keluarga` AS `nomor_keluarga` FROM (((`rank_pengajuan_bansos_ke_rw` join `keluarga_penduduk` on(`keluarga_penduduk`.`id_keluarga` = `rank_pengajuan_bansos_ke_rw`.`id_keluarga`)) join `detail_keluarga` on(`rank_pengajuan_bansos_ke_rw`.`id_keluarga` = `detail_keluarga`.`id_keluarga`)) join `penduduk` on(`detail_keluarga`.`id_penduduk` = `penduduk`.`id_penduduk`)) WHERE `detail_keluarga`.`peran_keluarga` = 'Kepala Keluarga' ORDER BY `rank_pengajuan_bansos_ke_rw`.`rank` ASC ;");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW pengajuan_bansos_acc_rt");
    }
};
