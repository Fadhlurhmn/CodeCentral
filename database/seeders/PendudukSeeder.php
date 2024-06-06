<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PendudukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id_penduduk' => 1,
                'nama' => 'Fadhlu',
                'nik' => '3573051234567890',
                'alamat_ktp' => 'Jalan jalan',
                'alamat_domisili' => 'Jalan jalan',
                'no_telp' => 123456789,
                'tempat_lahir' => 'Tangerang',
                'tanggal_lahir' => date('Y-m-d H:i:s'),
                'agama' => 'islam',
                'pekerjaan' => 'mahasiswa',
                'gol_darah' => 'AB',
                'status_data' => 'aktif',
                'rt' => '4',
                'rw' => '5',
                'status_penduduk' => 'sementara',
                'foto_ktp' => 'belum ada',
                'jenis_kelamin' => 'pria',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_penduduk' => 2,
                'nama' => 'Rakha',
                'nik' => '3573051234567098',
                'alamat_ktp' => 'Jalan jalan',
                'alamat_domisili' => 'Jalan jalan',
                'no_telp' => 123456789,
                'tempat_lahir' => 'Malang',
                'tanggal_lahir' => date('Y-m-d H:i:s'),
                'agama' => 'islam',
                'pekerjaan' => 'mahasiswa',
                'gol_darah' => 'AB',
                'status_data' => 'aktif',
                'rt' => '4',
                'rw' => '5',
                'status_penduduk' => 'tetap',
                'foto_ktp' => 'belum ada',
                'jenis_kelamin' => 'pria',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_penduduk' => 3,
                'nama' => 'Wahyudi',
                'nik' => '3573051234567111',
                'alamat_ktp' => 'Jalan jalan',
                'alamat_domisili' => 'Jalan jalan',
                'no_telp' => 123456789,
                'tempat_lahir' => 'Pasuruan',
                'tanggal_lahir' => date('Y-m-d H:i:s'),
                'agama' => 'islam',
                'pekerjaan' => 'mahasiswa',
                'gol_darah' => 'AB',
                'status_data' => 'aktif',
                'rt' => '4',
                'rw' => '5',
                'status_penduduk' => 'tetap',
                'foto_ktp' => 'belum ada',
                'jenis_kelamin' => 'pria',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];
        DB::table('penduduk')->insert($data);
    }
}
