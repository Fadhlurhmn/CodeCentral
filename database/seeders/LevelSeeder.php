<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id_level' => 1,
                'kode_level' => 'ADM',
                'nama_level' => 'Admin',
            ],
            [
                'id_level' => 2,
                'kode_level' => 'RW',
                'nama_level' => 'RW',
            ],
            [
                'id_level' => 3,
                'kode_level' => 'RT',
                'nama_level' => 'RT',
            ],
        ];
        DB::table('level')->insert($data);
    }
}
