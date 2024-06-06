<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KriteriaBansos extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data_kriteria = [
            [
                'id_kriteria' => '1',
                'nama_kriteria' => 'JUMLAH KK DALAM 1 RUMAH',
                'bobot' => 40,
                'jenis' => 'benefit',
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'id_kriteria' => '2',
                'nama_kriteria' => 'JUMLAH ANGGOTA KELUARGA DALAM 1 RUMAH',
                'bobot' => 70,
                'jenis' => 'benefit',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_kriteria' => '3',
                'nama_kriteria' => 'PENDIDIKAN KEPALA KELUARGA',
                'bobot' => 55,
                'jenis' => 'cost',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_kriteria' => '4',
                'nama_kriteria' => 'JUMLAH ANGGOTA KELUARGA MASIH SEKOLAH',
                'bobot' => 80,
                'jenis' => 'benefit',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_kriteria' => '5',
                'nama_kriteria' => 'TOTAL PENGELUARAN KELUARGA PERBULAN',
                'bobot' => 65,
                'jenis' => 'benefit',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_kriteria' => '6',
                'nama_kriteria' => 'TOTAL PENGHASILAN KELUARGA PERBULAN',
                'bobot' => 80,
                'jenis' => 'cost',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_kriteria' => '7',
                'nama_kriteria' => 'STATUS KEPEMILIKAN RUMAH',
                'bobot' => 60,
                'jenis' => 'cost',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_kriteria' => '8',
                'nama_kriteria' => 'SUMBER AIR BERSIH',
                'bobot' => 75,
                'jenis' => 'cost',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_kriteria' => '9',
                'nama_kriteria' => 'PENERANGAN RUMAH',
                'bobot' => 70,
                'jenis' => 'cost',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_kriteria' => '10',
                'nama_kriteria' => 'TRANSPORTASI',
                'bobot' => 80,
                'jenis' => 'cost',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];
        DB::table('kriteria_bansos')->insert($data_kriteria);
    }
}
