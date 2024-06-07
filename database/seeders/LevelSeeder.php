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
                'nama_level' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),

            ],
            [
                'id_level' => 2,
                'nama_level' => 'rw',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_level' => 3,
                'nama_level' => 'rt',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        DB::table('level')->insert($data);
    }
}
