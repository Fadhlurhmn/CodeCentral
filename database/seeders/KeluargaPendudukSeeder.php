<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KeluargaPendudukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // keluarga rt 1
        for ($i = 1; $i <= 15; $i++) {
            $data_rt1[] = [
                'id_keluarga' => $i,
                'nomor_keluarga' => '357305' . str_pad($i, 10, '0', STR_PAD_LEFT), // 6 digit tetap + 10 digit yang di-generate
                'jumlah_kendaraan' => rand(0, 5),
                'jumlah_tanggungan' => 1,
                'jumlah_orang_kerja' => 2,
                'foto_kk' => 'belum ada',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        // keluarga rt 2
        for ($i = 16; $i <= 30; $i++) {
            $data_rt2[] = [
                'id_keluarga' => $i,
                'nomor_keluarga' => '357305' . str_pad($i, 10, '0', STR_PAD_LEFT), // 6 digit tetap + 10 digit yang di-generate
                'jumlah_kendaraan' => rand(0, 5),
                'jumlah_tanggungan' => 1,
                'jumlah_orang_kerja' => 2,
                'foto_kk' => 'belum ada',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        // keluarga rt 3
        for ($i = 31; $i <= 45; $i++) {
            $data_rt3[] = [
                'id_keluarga' => $i,
                'nomor_keluarga' => '357305' . str_pad($i, 10, '0', STR_PAD_LEFT), // 6 digit tetap + 10 digit yang di-generate
                'jumlah_kendaraan' => rand(0, 5),
                'jumlah_tanggungan' => 1,
                'jumlah_orang_kerja' => 2,
                'foto_kk' => 'belum ada',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        // keluarga rt 4
        for ($i = 46; $i <= 60; $i++) {
            $data_rt4[] = [
                'id_keluarga' => $i,
                'nomor_keluarga' => '357305' . str_pad($i, 10, '0', STR_PAD_LEFT), // 6 digit tetap + 10 digit yang di-generate
                'jumlah_kendaraan' => rand(0, 5),
                'jumlah_tanggungan' => 1,
                'jumlah_orang_kerja' => 2,
                'foto_kk' => 'belum ada',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        // keluarga rt 5
        for ($i = 61; $i <= 75; $i++) {
            $data_rt5[] = [
                'id_keluarga' => $i,
                'nomor_keluarga' => '357305' . str_pad($i, 10, '0', STR_PAD_LEFT), // 6 digit tetap + 10 digit yang di-generate
                'jumlah_kendaraan' => rand(0, 5),
                'jumlah_tanggungan' => 1,
                'jumlah_orang_kerja' => 2,
                'foto_kk' => 'belum ada',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('keluarga_penduduk')->insert($data_rt1);
        DB::table('keluarga_penduduk')->insert($data_rt2);
        DB::table('keluarga_penduduk')->insert($data_rt3);
        DB::table('keluarga_penduduk')->insert($data_rt4);
        DB::table('keluarga_penduduk')->insert($data_rt5);
    }
}
