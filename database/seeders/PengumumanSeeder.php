<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PengumumanSeeder extends Seeder
{
    public function run()
    {
        DB::table('pengumuman')->insert([
            [
                'id_user' => 1,
                'judul_pengumuman' => 'Pengumuman Pertama',
                'deskripsi' => 'Ini adalah deskripsi untuk pengumuman pertama.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => 2,
                'judul_pengumuman' => 'Pengumuman Kedua',
                'deskripsi' => 'Ini adalah deskripsi untuk pengumuman kedua.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Tambahkan lebih banyak data jika diperlukan
        ]);
    }
}
