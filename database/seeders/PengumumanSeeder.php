<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PengumumanSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('pengumuman')->insert([
            [
                'id_user' => 1,
                'judul_pengumuman' => 'Pengumuman Pertama',
                'deskripsi' => 'Deskripsi untuk pengumuman pertama.',
                'gambar' => 'path/to/gambar1.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => 2,
                'judul_pengumuman' => 'Pengumuman Kedua',
                'deskripsi' => 'Deskripsi untuk pengumuman kedua.',
                'gambar' => 'path/to/gambar2.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
