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
                'id_level' => 3,
                'id_penduduk' => 4,
                'username' => 'rt1',
                'password' => Hash::make('12345'),
                'status_akun' => 'Aktif',
            ],
            [
                'id_user' => 4,
                'id_level' => 3,
                'id_penduduk' => 14,
                'username' => 'rt2',
                'password' => Hash::make('12345'),
                'status_akun' => 'Aktif',
            ],
            [
                'id_user' => 5,
                'id_level' => 3,
                'id_penduduk' => 43,
                'username' => 'rt3',
                'password' => Hash::make('12345'),
                'status_akun' => 'Aktif',
            ],
            [
                'id_user' => 6,
                'id_level' => 3,
                'id_penduduk' => 3,
                'username' => 'rt4',
                'password' => Hash::make('12345'),
                'status_akun' => 'Aktif',
            ],
        ];
        DB::table('user')->insert($data);
    }
}
