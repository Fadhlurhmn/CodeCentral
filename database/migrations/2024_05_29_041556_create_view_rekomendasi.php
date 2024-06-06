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
        DB::statement("
        CREATE VIEW `rekomendasi` AS
        SELECT
            `r`.`id_bansos` AS `id_bansos`,
            `k`.`nomor_keluarga` AS `nomor_keluarga`,
            `r`.`id_keluarga` AS `id_keluarga`,
            `p`.`nama` AS `nama_kepala_keluarga`,
            `p`.`alamat_domisili` AS `alamat`,
            `p`.`rt` AS `rt`,
            `r`.`rank` AS `rank`
        FROM
            `ranking_keluarga` `r`
            JOIN `keluarga_penduduk` `k` ON `r`.`id_keluarga` = `k`.`id_keluarga`
            JOIN `detail_keluarga` `d` ON `r`.`id_keluarga` = `d`.`id_keluarga`
            JOIN `penduduk` `p` ON `d`.`id_penduduk` = `p`.`id_penduduk` AND `d`.`peran_keluarga` = 'Kepala Keluarga'
        ORDER BY
            `r`.`id_bansos` ASC,
            `r`.`rank` ASC;
    ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW rekomendasi");
    }
};
