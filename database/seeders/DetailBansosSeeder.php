<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DetailBansosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $data = [
            ['id_keluarga' => 1, 'nilai_kriteria' => [4, 3, 2, 1, 4, 3, 2, 1, 4, 3]],
            ['id_keluarga' => 2, 'nilai_kriteria' => [1, 2, 3, 4, 1, 2, 3, 4, 1, 2]],
            ['id_keluarga' => 3, 'nilai_kriteria' => [2, 3, 4, 1, 2, 3, 4, 1, 2, 3]],
            ['id_keluarga' => 4, 'nilai_kriteria' => [3, 4, 1, 2, 3, 4, 1, 2, 3, 4]],
            ['id_keluarga' => 5, 'nilai_kriteria' => [3, 3, 2, 1, 4, 3, 2, 1, 4, 3]],
            ['id_keluarga' => 6, 'nilai_kriteria' => [3, 1, 2, 4, 2, 4, 2, 1, 3, 4]],
            ['id_keluarga' => 7, 'nilai_kriteria' => [2, 1, 3, 3, 1, 3, 1, 2, 2, 1]],
            ['id_keluarga' => 8, 'nilai_kriteria' => [1, 1, 1, 2, 2, 1, 1, 4, 1, 3]],
            ['id_keluarga' => 9, 'nilai_kriteria' => [2, 2, 2, 1, 3, 2, 3, 3, 1, 2]],
            ['id_keluarga' => 10, 'nilai_kriteria' => [2, 2, 3, 2, 2, 3, 4, 2, 4, 4]],
            ['id_keluarga' => 11, 'nilai_kriteria' => [2, 3, 4, 2, 1, 4, 2, 1, 3, 2]],
            ['id_keluarga' => 12, 'nilai_kriteria' => [3, 1, 1, 2, 4, 3, 1, 3, 2, 1]],
            ['id_keluarga' => 13, 'nilai_kriteria' => [1, 2, 3, 3, 4, 1, 3, 2, 1, 2]],
            ['id_keluarga' => 14, 'nilai_kriteria' => [2, 3, 2, 4, 2, 2, 2, 4, 3, 4]],
            ['id_keluarga' => 15, 'nilai_kriteria' => [1, 3, 3, 4, 1, 4, 4, 1, 2, 3]],
            ['id_keluarga' => 16, 'nilai_kriteria' => [4, 4, 2, 3, 4, 2, 1, 3, 4, 2]],
            ['id_keluarga' => 17, 'nilai_kriteria' => [2, 1, 1, 3, 1, 1, 2, 4, 1, 2]],
            ['id_keluarga' => 18, 'nilai_kriteria' => [1, 2, 1, 1, 3, 2, 4, 2, 2, 1]],
            ['id_keluarga' => 19, 'nilai_kriteria' => [4, 4, 2, 2, 1, 3, 2, 1, 2, 2]],
            ['id_keluarga' => 20, 'nilai_kriteria' => [4, 2, 1, 1, 3, 4, 1, 1, 4, 3]],
            ['id_keluarga' => 21, 'nilai_kriteria' => [2, 2, 2, 2, 1, 4, 1, 2, 1, 2]],
            ['id_keluarga' => 22, 'nilai_kriteria' => [1, 1, 2, 2, 4, 1, 1, 1, 2, 2]],
            ['id_keluarga' => 23, 'nilai_kriteria' => [2, 2, 1, 3, 1, 2, 1, 3, 4, 3]],
            ['id_keluarga' => 24, 'nilai_kriteria' => [3, 3, 1, 4, 2, 1, 2, 3, 2, 3]],
            ['id_keluarga' => 25, 'nilai_kriteria' => [2, 4, 1, 1, 1, 4, 3, 2, 1, 2]],
            ['id_keluarga' => 26, 'nilai_kriteria' => [1, 4, 4, 2, 4, 2, 1, 1, 2, 3]],
            ['id_keluarga' => 27, 'nilai_kriteria' => [1, 1, 4, 3, 3, 3, 2, 4, 1, 1]],
            ['id_keluarga' => 28, 'nilai_kriteria' => [1, 2, 3, 2, 2, 3, 4, 4, 2, 3]],
            ['id_keluarga' => 29, 'nilai_kriteria' => [4, 3, 4, 1, 2, 1, 4, 3, 2, 4]],
            ['id_keluarga' => 30, 'nilai_kriteria' => [4, 2, 1, 1, 1, 2, 3, 1, 1, 1]],
        ];

        $idBansos = 2;
        $status = 'pending';

        $seederData = [];

        foreach ($data as $item) {
            $idKeluarga = $item['id_keluarga'];
            $nilaiKriteria = $item['nilai_kriteria'];

            foreach ($nilaiKriteria as $idKriteria => $nilai) {
                $seederData[] = [
                    'id_bansos' => $idBansos,
                    'id_keluarga' => $idKeluarga,
                    'status' => $status,
                    'id_kriteria' => $idKriteria + 1,
                    'nilai_kriteria' => $nilai,
                ];
            }
        }

        DB::table('detail_bansos')->insert($seederData);
    }
}
