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
        DB::statement("CREATE VIEW `detail_pertimbangan_bansos` AS 
SELECT 
    `detail_bansos`.`id_bansos` AS `id_bansos`, 
    `keluarga`.`id_keluarga` AS `id_keluarga`, 
    `keluarga`.`nomor_keluarga` AS `nomor_keluarga`, 
    `penduduk`.`nama` AS `nama_kepala_keluarga`, 
    `kriteria_bansos`.`id_kriteria` AS `id_kriteria`, 
    `kriteria_bansos`.`nama_kriteria` AS `nama_kriteria`, 
    `detail_bansos`.`nilai_kriteria` AS `nilai_kriteria`
FROM 
    `keluarga_penduduk` `keluarga`
    JOIN `detail_bansos` ON `detail_bansos`.`id_keluarga` = `keluarga`.`id_keluarga`
    JOIN `detail_keluarga` ON `keluarga`.`id_keluarga` = `detail_keluarga`.`id_keluarga`
    JOIN `penduduk` ON `detail_keluarga`.`id_penduduk` = `penduduk`.`id_penduduk` AND `detail_keluarga`.`peran_keluarga` = 'Kepala Keluarga'
    JOIN `kriteria_bansos` ON `detail_bansos`.`id_kriteria` = `kriteria_bansos`.`id_kriteria`;
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW detail_pertimbangan_bansos");
    }
};
