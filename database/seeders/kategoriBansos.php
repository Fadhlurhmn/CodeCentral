<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class kategoriBansos extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data_kategori_bansos = [
            [
                'id_kategori_bansos' => 1,
                'nama_kategori' => 'BLT',
                'bentuk_pemberian' => 'Tunai',
                'pengirim' => 'Pemerintah Daerah',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];
        DB::table('kategori_bansos')->insert($data_kategori_bansos);
    }
}
