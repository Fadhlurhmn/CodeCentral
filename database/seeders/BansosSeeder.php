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
                'tanggal_pemberian' => now(),
                'pengirim' => 'pemerintah',
                'bentuk_pemberian' => 'tunai',
                'jumlah_penerima' => 10,
                'nama' => 'BLT',
                'status' => 'open'
            ]
        ];
        DB::table('bansos')->insert($data_bansos);
    }
}
