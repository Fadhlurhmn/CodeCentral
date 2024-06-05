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
                'created_at' => now(),
                'updated_at' => now(),

            ],
            [
                'id_level' => 2,
                'kode_level' => 'RW',
                'nama_level' => 'RW',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_level' => 3,
                'kode_level' => 'RT1',
                'nama_level' => 'RT 1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_level' => 4,
                'kode_level' => 'RT2',
                'nama_level' => 'RT 2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_level' => 5,
                'kode_level' => 'RT3',
                'nama_level' => 'RT 3',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_level' => 6,
                'kode_level' => 'RT4',
                'nama_level' => 'RT 4',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_level' => 7,
                'kode_level' => 'RT5',
                'nama_level' => 'RT 5',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        DB::table('level')->insert($data);
    }
}
