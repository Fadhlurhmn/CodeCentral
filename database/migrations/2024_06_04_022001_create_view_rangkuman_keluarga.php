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
        DB::statement("CREATE VIEW `rangkuman_keluarga`  AS SELECT `kp`.`id_keluarga` AS `id_keluarga`, `kp`.`nomor_keluarga` AS `nomor_keluarga`, `p`.`id_penduduk` AS `id_penduduk`, `p`.`nama` AS `nama_kepala_keluarga`, `p`.`alamat_domisili` AS `alamat`, `p`.`rt` AS `rt`, `kp`.`jumlah_tanggungan`+ `kp`.`jumlah_orang_kerja` AS `jumlah_anggota_dalam_KK`, `kp`.`jumlah_kendaraan` AS `jumlah_kendaraan` FROM ((`keluarga_penduduk` `kp` join `detail_keluarga` `dk` on(`dk`.`id_keluarga` = `kp`.`id_keluarga`)) join `penduduk` `p` on(`p`.`id_penduduk` = `dk`.`id_penduduk`)) WHERE `dk`.`peran_keluarga` = 'Kepala Keluarga' ORDER BY `p`.`rt` ASC ;");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW rangkuman_keluarga");
    }
};
