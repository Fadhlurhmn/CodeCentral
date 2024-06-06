<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id_user' => 1,
                'id_level' => 1,
                'id_penduduk' => 1,
                'username' => 'admin',
                'password' => Hash::make('12345'),
                'status_akun' => 'Aktif',
            ],
            [
                'id_user' => 2,
                'id_level' => 2,
                'id_penduduk' => 2,
                'username' => 'rw',
                'password' => Hash::make('12345'),
                'status_akun' => 'Aktif',
            ],
            [
                'id_user' => 3,
                'id_level' => 6,
                'id_penduduk' => 3,
                'username' => 'rt',
                'password' => Hash::make('12345'),
                'status_akun' => 'Aktif',
            ],
        ];
        DB::table('user')->insert($data);
    }
}
