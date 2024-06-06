<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DetailKeluargaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $all_data = [];

        // data rt 1
        $indeks_kepala_keluarga = 4;
        $indeks_istri = 79;
        $indeks_anak = 154;
        for ($i = 1; $i <= 15; $i++) {
            $data_rt1 = [
                [
                    'id_keluarga' => $i,
                    'id_penduduk' => $indeks_kepala_keluarga,
                    'peran_keluarga' => 'Kepala Keluarga',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id_keluarga' => $i,
                    'id_penduduk' => $indeks_istri,
                    'peran_keluarga' => 'Istri',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id_keluarga' => $i,
                    'id_penduduk' => $indeks_anak,
                    'peran_keluarga' => 'Anak',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            ];
            $all_data = array_merge($all_data, $data_rt1);
            $indeks_kepala_keluarga++;
            $indeks_istri++;
            $indeks_anak++;
        }

        // data rt 2
        $indeks_kepala_keluarga = 19;
        $indeks_istri = 94;
        $indeks_anak = 169;
        for ($i = 16; $i <= 30; $i++) {
            $data_rt2 = [
                [
                    'id_keluarga' => $i,
                    'id_penduduk' => $indeks_kepala_keluarga,
                    'peran_keluarga' => 'Kepala Keluarga',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id_keluarga' => $i,
                    'id_penduduk' => $indeks_istri,
                    'peran_keluarga' => 'Istri',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id_keluarga' => $i,
                    'id_penduduk' => $indeks_anak,
                    'peran_keluarga' => 'Anak',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            ];
            $all_data = array_merge($all_data, $data_rt2);
            $indeks_kepala_keluarga++;
            $indeks_istri++;
            $indeks_anak++;
        }

        // data rt 3
        $indeks_kepala_keluarga = 34;
        $indeks_istri = 109;
        $indeks_anak = 184;
        for ($i = 31; $i <= 45; $i++) {
            $data_rt3 = [
                [
                    'id_keluarga' => $i,
                    'id_penduduk' => $indeks_kepala_keluarga,
                    'peran_keluarga' => 'Kepala Keluarga',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id_keluarga' => $i,
                    'id_penduduk' => $indeks_istri,
                    'peran_keluarga' => 'Istri',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id_keluarga' => $i,
                    'id_penduduk' => $indeks_anak,
                    'peran_keluarga' => 'Anak',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            ];
            $all_data = array_merge($all_data, $data_rt3);
            $indeks_kepala_keluarga++;
            $indeks_istri++;
            $indeks_anak++;
        }

        // data rt 4
        $indeks_kepala_keluarga = 49;
        $indeks_istri = 124;
        $indeks_anak = 199;
        for ($i = 46; $i <= 60; $i++) {
            $data_rt4 = [
                [
                    'id_keluarga' => $i,
                    'id_penduduk' => $indeks_kepala_keluarga,
                    'peran_keluarga' => 'Kepala Keluarga',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id_keluarga' => $i,
                    'id_penduduk' => $indeks_istri,
                    'peran_keluarga' => 'Istri',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id_keluarga' => $i,
                    'id_penduduk' => $indeks_anak,
                    'peran_keluarga' => 'Anak',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            ];
            $all_data = array_merge($all_data, $data_rt4);
            $indeks_kepala_keluarga++;
            $indeks_istri++;
            $indeks_anak++;
        }

        // data rt 5
        $indeks_kepala_keluarga = 64;
        $indeks_istri = 139;
        $indeks_anak = 214;
        for ($i = 61; $i <= 75; $i++) {
            $data_rt5 = [
                [
                    'id_keluarga' => $i,
                    'id_penduduk' => $indeks_kepala_keluarga,
                    'peran_keluarga' => 'Kepala Keluarga',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id_keluarga' => $i,
                    'id_penduduk' => $indeks_istri,
                    'peran_keluarga' => 'Istri',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id_keluarga' => $i,
                    'id_penduduk' => $indeks_anak,
                    'peran_keluarga' => 'Anak',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            ];
            $all_data = array_merge($all_data, $data_rt5);
            $indeks_kepala_keluarga++;
            $indeks_istri++;
            $indeks_anak++;
        }

        // Menyisipkan semua data yang dihasilkan ke dalam tabel detail_keluarga
        DB::table('detail_keluarga')->insert($all_data);
    }
}
