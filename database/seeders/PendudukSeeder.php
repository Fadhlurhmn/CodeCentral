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

        // untuk peran kepala keluarga
        // Menggunakan loop for untuk menambahkan data penduduk sebanyak 15 untuk rt 1
        for ($i = 4; $i <= 18; $i++) {
            $data_kepalakeluarga_rt1[] = [
                'id_penduduk' => $i,
                'nama' => 'rt1kepalakeluarga_' . $i,
                'nik' => mt_rand(1000000000000000, 9999999999999999),
                'alamat_ktp' => 'Jalan jalan',
                'alamat_domisili' => 'Jalan jalan',
                'no_telp' => 123456789,
                'tempat_lahir' => 'Pasuruan',
                'tanggal_lahir' => date('Y-m-d H:i:s'),
                'agama' => 'islam',
                'pekerjaan' => 'mahasiswa',
                'gol_darah' => 'AB',
                'status_data' => 'aktif',
                'rt' => '1',
                'rw' => '5',
                'status_penduduk' => 'tetap',
                'foto_ktp' => 'belum ada',
                'jenis_kelamin' => 'pria',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Menggunakan loop for untuk menambahkan data penduduk sebanyak 15 untuk rt 2
        for ($i = 19; $i <= 33; $i++) { // Mulai dari 19 untuk id_penduduk rt 2
            $data_kepalakeluarga_rt2[] = [
                'id_penduduk' => $i,
                'nama' => 'rt2kepalakeluarga_' . $i,
                'nik' => mt_rand(1000000000000000, 9999999999999999),
                'alamat_ktp' => 'Jalan jalan',
                'alamat_domisili' => 'Jalan jalan',
                'no_telp' => 123456789,
                'tempat_lahir' => 'Pasuruan',
                'tanggal_lahir' => date('Y-m-d H:i:s'),
                'agama' => 'islam',
                'pekerjaan' => 'mahasiswa',
                'gol_darah' => 'AB',
                'status_data' => 'aktif',
                'rt' => '2',
                'rw' => '5',
                'status_penduduk' => 'tetap',
                'foto_ktp' => 'belum ada',
                'jenis_kelamin' => 'pria',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Menggunakan loop for untuk menambahkan data penduduk sebanyak 15 untuk rt 3
        for ($i = 34; $i <= 48; $i++) { // Mulai dari 34 untuk id_penduduk rt 3
            $data_kepalakeluarga_rt3[] = [
                'id_penduduk' => $i,
                'nama' => 'rt3kepalakeluarga_' . $i,
                'nik' => mt_rand(1000000000000000, 9999999999999999),
                'alamat_ktp' => 'Jalan jalan',
                'alamat_domisili' => 'Jalan jalan',
                'no_telp' => 123456789,
                'tempat_lahir' => 'Pasuruan',
                'tanggal_lahir' => date('Y-m-d H:i:s'),
                'agama' => 'islam',
                'pekerjaan' => 'mahasiswa',
                'gol_darah' => 'AB',
                'status_data' => 'aktif',
                'rt' => '3',
                'rw' => '5',
                'status_penduduk' => 'tetap',
                'foto_ktp' => 'belum ada',
                'jenis_kelamin' => 'pria',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Menggunakan loop for untuk menambahkan data penduduk sebanyak 15 untuk rt 4
        for ($i = 49; $i <= 63; $i++) { // Mulai dari 49 untuk id_penduduk rt 4
            $data_kepalakeluarga_rt4[] = [
                'id_penduduk' => $i,
                'nama' => 'rt4kepalakeluarga_' . $i,
                'nik' => mt_rand(1000000000000000, 9999999999999999),
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
            ];
        }

        // Menggunakan loop for untuk menambahkan data penduduk sebanyak 15 untuk rt 5
        for ($i = 64; $i <= 78; $i++) { // Mulai dari 64 untuk id_penduduk rt 5
            $data_kepalakeluarga_rt5[] = [
                'id_penduduk' => $i,
                'nama' => 'rt5kepalakeluarga_' . $i,
                'nik' => mt_rand(1000000000000000, 9999999999999999),
                'alamat_ktp' => 'Jalan jalan',
                'alamat_domisili' => 'Jalan jalan',
                'no_telp' => 123456789,
                'tempat_lahir' => 'Pasuruan',
                'tanggal_lahir' => date('Y-m-d H:i:s'),
                'agama' => 'islam',
                'pekerjaan' => 'mahasiswa',
                'gol_darah' => 'AB',
                'status_data' => 'aktif',
                'rt' => '5',
                'rw' => '5',
                'status_penduduk' => 'tetap',
                'foto_ktp' => 'belum ada',
                'jenis_kelamin' => 'pria',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // untuk peran istri
        // Menggunakan loop for untuk menambahkan data penduduk sebanyak 15 untuk rt 1
        for ($i = 79; $i <= 93; $i++) { // Mulai dari 79 untuk id_penduduk istri rt 1
            $data_istri_rt1[] = [
                'id_penduduk' => $i,
                'nama' => 'rt1istri' . $i,
                'nik' => mt_rand(1000000000000000, 9999999999999999),
                'alamat_ktp' => 'Jalan jalan',
                'alamat_domisili' => 'Jalan jalan',
                'no_telp' => 123456789,
                'tempat_lahir' => 'Pasuruan',
                'tanggal_lahir' => date('Y-m-d H:i:s'),
                'agama' => 'islam',
                'pekerjaan' => 'mahasiswa',
                'gol_darah' => 'AB',
                'status_data' => 'aktif',
                'rt' => '1',
                'rw' => '5',
                'status_penduduk' => 'tetap',
                'foto_ktp' => 'belum ada',
                'jenis_kelamin' => 'wanita',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Menggunakan loop for untuk menambahkan data penduduk sebanyak 15 untuk rt 2
        for ($i = 94; $i <= 108; $i++) { // Mulai dari 94 untuk id_penduduk istri rt 2
            $data_istri_rt2[] = [
                'id_penduduk' => $i,
                'nama' => 'rt2istri' . $i,
                'nik' => mt_rand(1000000000000000, 9999999999999999),
                'alamat_ktp' => 'Jalan jalan',
                'alamat_domisili' => 'Jalan jalan',
                'no_telp' => 123456789,
                'tempat_lahir' => 'Pasuruan',
                'tanggal_lahir' => date('Y-m-d H:i:s'),
                'agama' => 'islam',
                'pekerjaan' => 'mahasiswa',
                'gol_darah' => 'AB',
                'status_data' => 'aktif',
                'rt' => '2',
                'rw' => '5',
                'status_penduduk' => 'tetap',
                'foto_ktp' => 'belum ada',
                'jenis_kelamin' => 'wanita',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Menggunakan loop for untuk menambahkan data penduduk sebanyak 15 untuk rt 3
        for ($i = 109; $i <= 123; $i++) { // Mulai dari 109 untuk id_penduduk istri rt 3
            $data_istri_rt3[] = [
                'id_penduduk' => $i,
                'nama' => 'rt3istri' . $i,
                'nik' => mt_rand(1000000000000000, 9999999999999999),
                'alamat_ktp' => 'Jalan jalan',
                'alamat_domisili' => 'Jalan jalan',
                'no_telp' => 123456789,
                'tempat_lahir' => 'Pasuruan',
                'tanggal_lahir' => date('Y-m-d H:i:s'),
                'agama' => 'islam',
                'pekerjaan' => 'mahasiswa',
                'gol_darah' => 'AB',
                'status_data' => 'aktif',
                'rt' => '3',
                'rw' => '5',
                'status_penduduk' => 'tetap',
                'foto_ktp' => 'belum ada',
                'jenis_kelamin' => 'wanita',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Menggunakan loop for untuk menambahkan data penduduk sebanyak 15 untuk rt 4
        for ($i = 124; $i <= 138; $i++) { // Mulai dari 124 untuk id_penduduk istri rt 4
            $data_istri_rt4[] = [
                'id_penduduk' => $i,
                'nama' => 'rt4istri' . $i,
                'nik' => mt_rand(1000000000000000, 9999999999999999),
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
                'jenis_kelamin' => 'wanita',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Menggunakan loop for untuk menambahkan data penduduk sebanyak 15 untuk rt 5
        for ($i = 139; $i <= 153; $i++) { // Mulai dari 139 untuk id_penduduk istri rt 5
            $data_istri_rt5[] = [
                'id_penduduk' => $i,
                'nama' => 'rt5istri' . $i,
                'nik' => mt_rand(1000000000000000, 9999999999999999),
                'alamat_ktp' => 'Jalan jalan',
                'alamat_domisili' => 'Jalan jalan',
                'no_telp' => 123456789,
                'tempat_lahir' => 'Pasuruan',
                'tanggal_lahir' => date('Y-m-d H:i:s'),
                'agama' => 'islam',
                'pekerjaan' => 'mahasiswa',
                'gol_darah' => 'AB',
                'status_data' => 'aktif',
                'rt' => '5',
                'rw' => '5',
                'status_penduduk' => 'tetap',
                'foto_ktp' => 'belum ada',
                'jenis_kelamin' => 'wanita',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // untuk peran anak
        // Menggunakan loop for untuk menambahkan data penduduk sebanyak 15 untuk anak rt 1
        for ($i = 154; $i <= 168; $i++) { // Mulai dari 154 untuk id_penduduk anak rt 1
            $jenis_kelamin = mt_rand(0, 1) ? 'pria' : 'wanita';
            $data_anak_rt1[] = [
                'id_penduduk' => $i,
                'nama' => 'anak_rt1_' . $i,
                'nik' => mt_rand(1000000000000000, 9999999999999999),
                'alamat_ktp' => 'Jalan jalan',
                'alamat_domisili' => 'Jalan jalan',
                'no_telp' => 123456789,
                'tempat_lahir' => 'Pasuruan',
                'tanggal_lahir' => date('Y-m-d H:i:s'),
                'agama' => 'islam',
                'pekerjaan' => 'pelajar',
                'gol_darah' => 'AB',
                'status_data' => 'aktif',
                'rt' => '1',
                'rw' => '5',
                'status_penduduk' => 'tetap',
                'foto_ktp' => 'belum ada',
                'jenis_kelamin' => $jenis_kelamin,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Menggunakan loop for untuk menambahkan data penduduk sebanyak 15 untuk anak rt 2
        for ($i = 169; $i <= 183; $i++) { // Mulai dari 169 untuk id_penduduk anak rt 2
            $jenis_kelamin = mt_rand(0, 1) ? 'pria' : 'wanita';
            $data_anak_rt2[] = [
                'id_penduduk' => $i,
                'nama' => 'anak_rt2_' . $i,
                'nik' => mt_rand(1000000000000000, 9999999999999999),
                'alamat_ktp' => 'Jalan jalan',
                'alamat_domisili' => 'Jalan jalan',
                'no_telp' => 123456789,
                'tempat_lahir' => 'Pasuruan',
                'tanggal_lahir' => date('Y-m-d H:i:s'),
                'agama' => 'islam',
                'pekerjaan' => 'pelajar',
                'gol_darah' => 'AB',
                'status_data' => 'aktif',
                'rt' => '2',
                'rw' => '5',
                'status_penduduk' => 'tetap',
                'foto_ktp' => 'belum ada',
                'jenis_kelamin' => $jenis_kelamin,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Menggunakan loop for untuk menambahkan data penduduk sebanyak 15 untuk anak rt 3
        for ($i = 184; $i <= 198; $i++) { // Mulai dari 184 untuk id_penduduk anak rt 3
            $jenis_kelamin = mt_rand(0, 1) ? 'pria' : 'wanita';
            $data_anak_rt3[] = [
                'id_penduduk' => $i,
                'nama' => 'anak_rt3_' . $i,
                'nik' => mt_rand(1000000000000000, 9999999999999999),
                'alamat_ktp' => 'Jalan jalan',
                'alamat_domisili' => 'Jalan jalan',
                'no_telp' => 123456789,
                'tempat_lahir' => 'Pasuruan',
                'tanggal_lahir' => date('Y-m-d H:i:s'),
                'agama' => 'islam',
                'pekerjaan' => 'pelajar',
                'gol_darah' => 'AB',
                'status_data' => 'aktif',
                'rt' => '3',
                'rw' => '5',
                'status_penduduk' => 'tetap',
                'foto_ktp' => 'belum ada',
                'jenis_kelamin' => $jenis_kelamin,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Menggunakan loop for untuk menambahkan data penduduk sebanyak 15 untuk anak rt 4
        for ($i = 199; $i <= 213; $i++) { // Mulai dari 199 untuk id_penduduk anak rt 4
            $jenis_kelamin = mt_rand(0, 1) ? 'pria' : 'wanita';
            $data_anak_rt4[] = [
                'id_penduduk' => $i,
                'nama' => 'anak_rt4_' . $i,
                'nik' => mt_rand(1000000000000000, 9999999999999999),
                'alamat_ktp' => 'Jalan jalan',
                'alamat_domisili' => 'Jalan jalan',
                'no_telp' => 123456789,
                'tempat_lahir' => 'Pasuruan',
                'tanggal_lahir' => date('Y-m-d H:i:s'),
                'agama' => 'islam',
                'pekerjaan' => 'pelajar',
                'gol_darah' => 'AB',
                'status_data' => 'aktif',
                'rt' => '4',
                'rw' => '5',
                'status_penduduk' => 'tetap',
                'foto_ktp' => 'belum ada',
                'jenis_kelamin' => $jenis_kelamin,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Menggunakan loop for untuk menambahkan data penduduk sebanyak 15 untuk anak rt 5
        for ($i = 214; $i <= 228; $i++) { // Mulai dari 214 untuk id_penduduk anak rt 5
            $jenis_kelamin = mt_rand(0, 1) ? 'pria' : 'wanita';
            $data_anak_rt5[] = [
                'id_penduduk' => $i,
                'nama' => 'anak_rt5_' . $i,
                'nik' => mt_rand(1000000000000000, 9999999999999999),
                'alamat_ktp' => 'Jalan jalan',
                'alamat_domisili' => 'Jalan jalan',
                'no_telp' => 123456789,
                'tempat_lahir' => 'Pasuruan',
                'tanggal_lahir' => date('Y-m-d H:i:s'),
                'agama' => 'islam',
                'pekerjaan' => 'pelajar',
                'gol_darah' => 'AB',
                'status_data' => 'aktif',
                'rt' => '5',
                'rw' => '5',
                'status_penduduk' => 'tetap',
                'foto_ktp' => 'belum ada',
                'jenis_kelamin' => $jenis_kelamin,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }



        DB::table('penduduk')->insert($data);
        DB::table('penduduk')->insert($data_kepalakeluarga_rt1);
        DB::table('penduduk')->insert($data_kepalakeluarga_rt2);
        DB::table('penduduk')->insert($data_kepalakeluarga_rt3);
        DB::table('penduduk')->insert($data_kepalakeluarga_rt4);
        DB::table('penduduk')->insert($data_kepalakeluarga_rt5);
        DB::table('penduduk')->insert($data_istri_rt1);
        DB::table('penduduk')->insert($data_istri_rt2);
        DB::table('penduduk')->insert($data_istri_rt3);
        DB::table('penduduk')->insert($data_istri_rt4);
        DB::table('penduduk')->insert($data_istri_rt5);
        DB::table('penduduk')->insert($data_anak_rt1);
        DB::table('penduduk')->insert($data_anak_rt2);
        DB::table('penduduk')->insert($data_anak_rt3);
        DB::table('penduduk')->insert($data_anak_rt4);
        DB::table('penduduk')->insert($data_anak_rt5);
    }
}
