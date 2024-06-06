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
        DB::statement("CREATE VIEW `rangkuman_jadwal_keamanan`  AS SELECT `detail_jadwal_keamanan`.`id_jadwal_keamanan` AS `id_jadwal_keamanan`, `detail_jadwal_keamanan`.`id_satpam` AS `id_satpam`, `jadwal_keamanan`.`hari` AS `hari`, `detail_jadwal_keamanan`.`waktu` AS `waktu`, `satpam`.`nama` AS `nama`, `satpam`.`nomor_telepon` AS `nomor_telepon` FROM ((`detail_jadwal_keamanan` join `jadwal_keamanan` on(`jadwal_keamanan`.`id_jadwal_keamanan` = `detail_jadwal_keamanan`.`id_jadwal_keamanan`)) join `satpam` on(`satpam`.`id_satpam` = `detail_jadwal_keamanan`.`id_satpam`)) ;");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW `rangkuman_jadwal_keamanan`");
    }
};
