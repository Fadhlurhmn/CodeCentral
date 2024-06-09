<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BansosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data_bansos = [
            [
                'id_bansos' => 1,
                'id_kategori_bansos' => 1,
                'tanggal_pemberian' => now(),
                'jumlah_penerima' => 2,
                'nama' => 'BLT1',
                'status' => 'open'
            ],
            [
                'id_bansos' => 2,
                'id_kategori_bansos' => 1,
                'tanggal_pemberian' => now(),
                'jumlah_penerima' => 2,
                'nama' => 'BLT2',
                'status' => 'open'
            ],
            [
                'id_bansos' => 3,
                'id_kategori_bansos' => 2,
                'tanggal_pemberian' => now(),
                'jumlah_penerima' => 2,
                'nama' => 'PKH1',
                'status' => 'open'
            ],
            [
                'id_bansos' => 4,
                'id_kategori_bansos' => 2,
                'tanggal_pemberian' => now(),
                'jumlah_penerima' => 2,
                'nama' => 'PKH2',
                'status' => 'open'
            ],
        ];
        DB::table('bansos')->insert($data_bansos);
    }
}
