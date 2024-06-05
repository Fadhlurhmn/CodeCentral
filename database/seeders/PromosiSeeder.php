<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PromosiSeeder extends Seeder
{
    public function run()
    {
        DB::table('promosi')->insert([
            [
                'id_penduduk' => 1,
                'nama_usaha' => 'Usaha 1',
                'gambar' => 'gambar1.jpg',
                'deskripsi' => 'Deskripsi usaha 1',
                'kategori' => 'Kuliner',
                'status_pengajuan' => 'Terima',
                'alamat' => 'Alamat usaha 1',
                'countdown' => now()->addDays(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_penduduk' => 2,
                'nama_usaha' => 'Usaha 2',
                'gambar' => 'gambar2.jpg',
                'deskripsi' => 'Deskripsi usaha 2',
                'kategori' => 'Fashion',
                'status_pengajuan' => 'Menunggu',
                'alamat' => 'Alamat usaha 2',
                'countdown' => now()->addDays(15),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_penduduk' => 3,
                'nama_usaha' => 'Usaha 3',
                'gambar' => 'gambar3.jpg',
                'deskripsi' => 'Deskripsi usaha 3',
                'kategori' => 'Retail',
                'status_pengajuan' => 'Tolak',
                'alamat' => 'Alamat usaha 3',
                'countdown' => now()->addDays(20),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_penduduk' => 3,
                'nama_usaha' => 'Usaha 4',
                'gambar' => 'gambar4.jpg',
                'deskripsi' => 'Deskripsi usaha 4',
                'kategori' => 'Jasa',
                'status_pengajuan' => 'Terima',
                'alamat' => 'Alamat usaha 4',
                'countdown' => now()->addDays(25),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_penduduk' => 3,
                'nama_usaha' => 'Usaha 5',
                'gambar' => 'gambar5.jpg',
                'deskripsi' => 'Deskripsi usaha 5',
                'kategori' => 'Lainnya',
                'status_pengajuan' => 'Menunggu',
                'alamat' => 'Alamat usaha 5',
                'countdown' => now()->addDays(30),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
