<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JadwalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // data jadwal kebersihan
        $data_kebersihan = [
            [
                'id_jadwal_kebersihan' => 1,
                'hari' => 'Senin',
                'waktu' => 'Tidak ada',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_jadwal_kebersihan' => 2,
                'hari' => 'Selasa',
                'waktu' => '08:00 - 12:00',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_jadwal_kebersihan' => 3,
                'hari' => 'Rabu',
                'waktu' => '12:00 - 16:00',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_jadwal_kebersihan' => 4,
                'hari' => 'Kamis',
                'waktu' => 'Tidak ada',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_jadwal_kebersihan' => 5,
                'hari' => 'Jumat',
                'waktu' => 'Tidak ada',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_jadwal_kebersihan' => 6,
                'hari' => 'Sabtu',
                'waktu' => 'Tidak ada',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_jadwal_kebersihan' => 7,
                'hari' => 'Minggu',
                'waktu' => 'Tidak ada',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];
        DB::table('jadwal_kebersihan')->insert($data_kebersihan);

        // data satpam
        $data_satpam = [
            [
                'id_satpam' => 1,
                'nama' => 'Fadhlu',
                'nomor_telepon' => '123456789012',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_satpam' => 2,
                'nama' => 'Rakha',
                'nomor_telepon' => '123456789012',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_satpam' => 3,
                'nama' => 'Kemal',
                'nomor_telepon' => '123456789012',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_satpam' => 4,
                'nama' => 'Wahyudi',
                'nomor_telepon' => '123456789012',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_satpam' => 5,
                'nama' => 'Alichia',
                'nomor_telepon' => '123456789012',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        DB::table('satpam')->insert($data_satpam);

        // data jadwal keamanan
        $data_keamanan = [
            [
                'id_jadwal_keamanan' => 1,
                'hari' => 'Senin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_jadwal_keamanan' => 2,
                'hari' => 'Selasa',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_jadwal_keamanan' => 3,
                'hari' => 'Rabu',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_jadwal_keamanan' => 4,
                'hari' => 'Kamis',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_jadwal_keamanan' => 5,
                'hari' => 'Jumat',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_jadwal_keamanan' => 6,
                'hari' => 'Sabtu',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_jadwal_keamanan' => 7,
                'hari' => 'Minggu',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        DB::table('jadwal_keamanan')->insert($data_keamanan);

        // data detail jadwal keamanan
        $data_detail_jadwal_keamanan = [
            // senin
            [
                'id_detail_jadwal_keamanan' => 1,
                'id_jadwal_keamanan' => 1,
                'id_satpam' => 4,
                'waktu' => 'Pagi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_detail_jadwal_keamanan' => 2,
                'id_jadwal_keamanan' => 1,
                'id_satpam' => 3,
                'waktu' => 'Siang - Sore',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_detail_jadwal_keamanan' => 3,
                'id_jadwal_keamanan' => 1,
                'id_satpam' => 1,
                'waktu' => 'Malam',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // selasa
            [
                'id_detail_jadwal_keamanan' => 1,
                'id_jadwal_keamanan' => 2,
                'id_satpam' => 4,
                'waktu' => 'Pagi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_detail_jadwal_keamanan' => 2,
                'id_jadwal_keamanan' => 2,
                'id_satpam' => 3,
                'waktu' => 'Siang - Sore',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_detail_jadwal_keamanan' => 3,
                'id_jadwal_keamanan' => 2,
                'id_satpam' => 1,
                'waktu' => 'Malam',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // rabu
            [
                'id_detail_jadwal_keamanan' => 1,
                'id_jadwal_keamanan' => 3,
                'id_satpam' => 4,
                'waktu' => 'Pagi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_detail_jadwal_keamanan' => 2,
                'id_jadwal_keamanan' => 3,
                'id_satpam' => 3,
                'waktu' => 'Siang - Sore',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_detail_jadwal_keamanan' => 3,
                'id_jadwal_keamanan' => 3,
                'id_satpam' => 1,
                'waktu' => 'Malam',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // kamis
            [
                'id_detail_jadwal_keamanan' => 1,
                'id_jadwal_keamanan' => 4,
                'id_satpam' => 4,
                'waktu' => 'Pagi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_detail_jadwal_keamanan' => 2,
                'id_jadwal_keamanan' => 4,
                'id_satpam' => 3,
                'waktu' => 'Siang - Sore',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_detail_jadwal_keamanan' => 3,
                'id_jadwal_keamanan' => 4,
                'id_satpam' => 1,
                'waktu' => 'Malam',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // jumat
            [
                'id_detail_jadwal_keamanan' => 1,
                'id_jadwal_keamanan' => 5,
                'id_satpam' => 4,
                'waktu' => 'Pagi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_detail_jadwal_keamanan' => 2,
                'id_jadwal_keamanan' => 5,
                'id_satpam' => 3,
                'waktu' => 'Siang - Sore',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_detail_jadwal_keamanan' => 3,
                'id_jadwal_keamanan' => 5,
                'id_satpam' => 1,
                'waktu' => 'Malam',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // sabtu
            [
                'id_detail_jadwal_keamanan' => 1,
                'id_jadwal_keamanan' => 6,
                'id_satpam' => 4,
                'waktu' => 'Pagi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_detail_jadwal_keamanan' => 2,
                'id_jadwal_keamanan' => 6,
                'id_satpam' => 3,
                'waktu' => 'Siang - Sore',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_detail_jadwal_keamanan' => 3,
                'id_jadwal_keamanan' => 6,
                'id_satpam' => 1,
                'waktu' => 'Malam',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // minggu
            [
                'id_detail_jadwal_keamanan' => 1,
                'id_jadwal_keamanan' => 7,
                'id_satpam' => 4,
                'waktu' => 'Pagi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_detail_jadwal_keamanan' => 2,
                'id_jadwal_keamanan' => 7,
                'id_satpam' => 3,
                'waktu' => 'Siang - Sore',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_detail_jadwal_keamanan' => 3,
                'id_jadwal_keamanan' => 7,
                'id_satpam' => 1,
                'waktu' => 'Malam',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        DB::table('detail_jadwal_keamanan')->insert($data_detail_jadwal_keamanan);
    }
}
