<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PengumumanGambarSeeder extends Seeder
{
    public function run()
    {
        DB::table('pengumuman_gambar')->insert([
            [
                'id_pengumuman' => 1,
                'pengumuman_gambar' => 'gambar1.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_pengumuman' => 1,
                'pengumuman_gambar' => 'gambar2.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Tambahkan lebih banyak data jika diperlukan
        ]);
    }
}
