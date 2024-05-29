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
        DB::statement("CREATE VIEW `rekomendasi`  AS SELECT `r`.`id_bansos` AS `id_bansos`, `k`.`nomor_keluarga` AS `nomor_keluarga`, `r`.`id_keluarga` AS `id_keluarga`, `p`.`nama` AS `nama_kepala_keluarga`, `k`.`alamat` AS `alamat`, `r`.`rank` AS `rank` FROM (((`ranking_keluarga` `r` join `keluarga_penduduk` `k` on(`r`.`id_keluarga` = `k`.`id_keluarga`)) join `detail_keluarga` `d` on(`r`.`id_keluarga` = `d`.`id_keluarga`)) join `penduduk` `p` on(`d`.`id_penduduk` = `p`.`id_penduduk` and `d`.`peran_keluarga` = 'Kepala Keluarga')) GROUP BY `r`.`id_bansos`, `r`.`rank` ORDER BY `r`.`id_bansos` ASC, `r`.`rank` ASC ;");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW rekomendasi");
    }
};
