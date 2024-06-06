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
        DB::table('keluarga_penduduk')->insert([
            ['id_keluarga' => 1, 'nomor_keluarga' => '2241333456780001', 'jumlah_kendaraan' => 2, 'jumlah_tanggungan' => 1, 'jumlah_orang_kerja' => 2, 'foto_kk' => 'data_kk/3rYKHXdYehJT4ZrSWDV4LLY1r3DtG8LkEOYKRDTl.png', 'created_at' => '2024-06-06 03:51:13', 'updated_at' => '2024-06-06 03:51:13'],
            ['id_keluarga' => 2, 'nomor_keluarga' => '2241333456780011', 'jumlah_kendaraan' => 2, 'jumlah_tanggungan' => 2, 'jumlah_orang_kerja' => 2, 'foto_kk' => 'data_kk/3HeWadesgqIXwSnkwtXcK4jfafQEH8XszfPB5CP6.png', 'created_at' => '2024-06-06 03:56:33', 'updated_at' => '2024-06-06 03:56:33'],
            ['id_keluarga' => 3, 'nomor_keluarga' => '2241333456780013', 'jumlah_kendaraan' => 2, 'jumlah_tanggungan' => 0, 'jumlah_orang_kerja' => 2, 'foto_kk' => 'data_kk/xxrqpi0ujKXzKwsvUrpbXXSp88EDb9Z4HQ1bvRlu.png', 'created_at' => '2024-06-06 04:22:03', 'updated_at' => '2024-06-06 04:22:03'],
            ['id_keluarga' => 4, 'nomor_keluarga' => '2241333456780014', 'jumlah_kendaraan' => 3, 'jumlah_tanggungan' => 1, 'jumlah_orang_kerja' => 1, 'foto_kk' => 'data_kk/MxZqGRi27juKwgMWNNAYIx15W41BrKi2mdlPUVlB.png', 'created_at' => '2024-06-06 04:24:42', 'updated_at' => '2024-06-06 04:24:42'],
            ['id_keluarga' => 5, 'nomor_keluarga' => '2241333456780015', 'jumlah_kendaraan' => 2, 'jumlah_tanggungan' => 0, 'jumlah_orang_kerja' => 1, 'foto_kk' => 'data_kk/4D4p7hALKXo1gxBMRTnt2b3CHq4PH1q3GC3Dp1nB.png', 'created_at' => '2024-06-06 04:26:15', 'updated_at' => '2024-06-06 04:26:15'],
            ['id_keluarga' => 6, 'nomor_keluarga' => '2241333456780016', 'jumlah_kendaraan' => 4, 'jumlah_tanggungan' => 2, 'jumlah_orang_kerja' => 2, 'foto_kk' => 'data_kk/RdxvFpBp4o5gkF1omSmr7xGj3Hw4ohMWy3lrhJgQ.png', 'created_at' => '2024-06-06 04:31:26', 'updated_at' => '2024-06-06 04:31:26'],
            ['id_keluarga' => 7, 'nomor_keluarga' => '2241333456780017', 'jumlah_kendaraan' => 5, 'jumlah_tanggungan' => 3, 'jumlah_orang_kerja' => 3, 'foto_kk' => 'data_kk/eoKHBYz4SnsICm4TPIaciRx3RuctyhFEgDBQbBMI.png', 'created_at' => '2024-06-06 04:33:54', 'updated_at' => '2024-06-06 04:33:54'],
            ['id_keluarga' => 8, 'nomor_keluarga' => '2241333456780021', 'jumlah_kendaraan' => 6, 'jumlah_tanggungan' => 0, 'jumlah_orang_kerja' => 4, 'foto_kk' => 'data_kk/afuDdB8abVa4kJaFpdZgZ2G36FuvjbsnHBSOIVgY.png', 'created_at' => '2024-06-06 04:47:46', 'updated_at' => '2024-06-06 04:47:46'],
            ['id_keluarga' => 9, 'nomor_keluarga' => '2241333456780022', 'jumlah_kendaraan' => 7, 'jumlah_tanggungan' => 0, 'jumlah_orang_kerja' => 4, 'foto_kk' => 'data_kk/3oS7cerR30aWstNOpPhSNEr3tlhx6x5ZhnHNjaMt.png', 'created_at' => '2024-06-06 04:49:12', 'updated_at' => '2024-06-06 04:49:12'],
            ['id_keluarga' => 10, 'nomor_keluarga' => '2241333456780023', 'jumlah_kendaraan' => 3, 'jumlah_tanggungan' => 1, 'jumlah_orang_kerja' => 1, 'foto_kk' => 'data_kk/dL8AGb8inXYSXfVlnF5fEn7vAeKLxQiMMzzweB8U.png', 'created_at' => '2024-06-06 04:50:15', 'updated_at' => '2024-06-06 04:50:15'],
            ['id_keluarga' => 11, 'nomor_keluarga' => '2241333456780031', 'jumlah_kendaraan' => 3, 'jumlah_tanggungan' => 0, 'jumlah_orang_kerja' => 1, 'foto_kk' => 'data_kk/sMXE5OZsLSx6ilzENFTnAZVkwQWhdw7vncJBa4TG.png', 'created_at' => '2024-06-06 04:52:54', 'updated_at' => '2024-06-06 04:52:54'],
            ['id_keluarga' => 12, 'nomor_keluarga' => '2241333456780032', 'jumlah_kendaraan' => 3, 'jumlah_tanggungan' => 2, 'jumlah_orang_kerja' => 1, 'foto_kk' => 'data_kk/DOR6MI7H1MyfjPhV1yD7BsAI8HWg8dxUMT8Wb5Q9.png', 'created_at' => '2024-06-06 04:53:44', 'updated_at' => '2024-06-06 04:53:44'],
            ['id_keluarga' => 13, 'nomor_keluarga' => '2241333456780033', 'jumlah_kendaraan' => 2, 'jumlah_tanggungan' => 1, 'jumlah_orang_kerja' => 1, 'foto_kk' => 'data_kk/qvACat7NVlVa0obQpjrWF8cEnKUxR5UV3ScEtEms.png', 'created_at' => '2024-06-06 04:56:06', 'updated_at' => '2024-06-06 04:56:06'],
            ['id_keluarga' => 14, 'nomor_keluarga' => '2241333456780036', 'jumlah_kendaraan' => 2, 'jumlah_tanggungan' => 0, 'jumlah_orang_kerja' => 1, 'foto_kk' => 'data_kk/iK2uqoeT25pjjfdSGUg7rAjxwDj9PpCnOJpjwXy3.png', 'created_at' => '2024-06-06 04:57:12', 'updated_at' => '2024-06-06 04:57:12'],
            ['id_keluarga' => 15, 'nomor_keluarga' => '2241333456780037', 'jumlah_kendaraan' => 1, 'jumlah_tanggungan' => 0, 'jumlah_orang_kerja' => 1, 'foto_kk' => 'data_kk/f0P0Y9QET7FSCNIM9YhTHUhFMoMe5Z06ponD8C2I.png', 'created_at' => '2024-06-06 04:57:38', 'updated_at' => '2024-06-06 04:57:38'],
            ['id_keluarga' => 16, 'nomor_keluarga' => '2241333456780018', 'jumlah_kendaraan' => 0, 'jumlah_tanggungan' => 0, 'jumlah_orang_kerja' => 1, 'foto_kk' => 'data_kk/bPleerzU92n5PkJaXaK9IFBgaYPeXawJUIN9Dl20.png', 'created_at' => '2024-06-06 05:55:45', 'updated_at' => '2024-06-06 05:55:45'],
            ['id_keluarga' => 17, 'nomor_keluarga' => '1241333456780011', 'jumlah_kendaraan' => 2, 'jumlah_tanggungan' => 0, 'jumlah_orang_kerja' => 1, 'foto_kk' => 'data_kk/VLxgCeRTzFFzb60JQNv2vD5MeObglslc5SWIsU3U.png', 'created_at' => '2024-06-06 05:56:35', 'updated_at' => '2024-06-06 05:56:35'],
            ['id_keluarga' => 18, 'nomor_keluarga' => '2241333456780029', 'jumlah_kendaraan' => 0, 'jumlah_tanggungan' => 1, 'jumlah_orang_kerja' => 1, 'foto_kk' => 'data_kk/VrwFM3A42Infyy94JYc9AonCpczO4gq2xs1rYBwq.png', 'created_at' => '2024-06-06 05:57:20', 'updated_at' => '2024-06-06 05:57:20'],
            ['id_keluarga' => 19, 'nomor_keluarga' => '2241333456780211', 'jumlah_kendaraan' => 0, 'jumlah_tanggungan' => 2, 'jumlah_orang_kerja' => 1, 'foto_kk' => 'data_kk/LWYUggyAR1ceq30e4Qs5wjqAWzP5Y5nklhVKc6gP.png', 'created_at' => '2024-06-06 05:59:00', 'updated_at' => '2024-06-06 05:59:00'],
            ['id_keluarga' => 20, 'nomor_keluarga' => '2241333456780212', 'jumlah_kendaraan' => 1, 'jumlah_tanggungan' => 1, 'jumlah_orang_kerja' => 1, 'foto_kk' => 'data_kk/Jn84KY8wD0pGQrSoBqQNUOoYugu2OrR6BTNzmJDw.png', 'created_at' => '2024-06-06 06:00:08', 'updated_at' => '2024-06-06 06:00:08'],
            ['id_keluarga' => 21, 'nomor_keluarga' => '2241333456780213', 'jumlah_kendaraan' => 0, 'jumlah_tanggungan' => 0, 'jumlah_orang_kerja' => 1, 'foto_kk' => 'data_kk/pZmv4mHol6MXuBNIaJjhBbd6ecjxcksFNibE9C4P.png', 'created_at' => '2024-06-06 06:01:01', 'updated_at' => '2024-06-06 06:01:01'],
            ['id_keluarga' => 22, 'nomor_keluarga' => '2241333456780214', 'jumlah_kendaraan' => 1, 'jumlah_tanggungan' => 0, 'jumlah_orang_kerja' => 1, 'foto_kk' => 'data_kk/4w07mS1cnQIdEcQOvAs2pHItIvR8s1DtqwSr53ge.png', 'created_at' => '2024-06-06 06:01:44', 'updated_at' => '2024-06-06 06:01:44'],
            ['id_keluarga' => 23, 'nomor_keluarga' => '2241333456780216', 'jumlah_kendaraan' => 2, 'jumlah_tanggungan' => 0, 'jumlah_orang_kerja' => 1, 'foto_kk' => 'data_kk/sjwoN7oEkowbDYCB8OABaAZ9t0G8gSXUmkezOGVE.png', 'created_at' => '2024-06-06 06:02:20', 'updated_at' => '2024-06-06 06:02:20'],
            ['id_keluarga' => 24, 'nomor_keluarga' => '2241333456782001', 'jumlah_kendaraan' => 2, 'jumlah_tanggungan' => 0, 'jumlah_orang_kerja' => 1, 'foto_kk' => 'data_kk/Vd5M2xLJm6OqCITGhrFIHJ5ETqedw6L7Mk7bSpMQ.png', 'created_at' => '2024-06-06 06:03:00', 'updated_at' => '2024-06-06 06:03:00'],
            ['id_keluarga' => 25, 'nomor_keluarga' => '2241333456782110', 'jumlah_kendaraan' => 1, 'jumlah_tanggungan' => 1, 'jumlah_orang_kerja' => 1, 'foto_kk' => 'data_kk/Q8QwvW9EiQ0Bu9Rtsxnb7VCvBfCh4sWs8in98E2A.png', 'created_at' => '2024-06-06 06:03:35', 'updated_at' => '2024-06-06 06:03:35'],
            ['id_keluarga' => 26, 'nomor_keluarga' => '2241333456782019', 'jumlah_kendaraan' => 0, 'jumlah_tanggungan' => 1, 'jumlah_orang_kerja' => 1, 'foto_kk' => 'data_kk/ikYy9b6SMA0GiebkNeiJUQ1jEjXZqeTd7RRfu3r0.png', 'created_at' => '2024-06-06 06:04:57', 'updated_at' => '2024-06-06 06:04:57'],
            ['id_keluarga' => 27, 'nomor_keluarga' => '2241333456770001', 'jumlah_kendaraan' => 2, 'jumlah_tanggungan' => 0, 'jumlah_orang_kerja' => 1, 'foto_kk' => 'data_kk/2JkM4zVCJ0GD3HmkmLAALZmlBrFrMJhLrWfkAE8H.png', 'created_at' => '2024-06-06 06:05:37', 'updated_at' => '2024-06-06 06:05:37'],
            ['id_keluarga' => 28, 'nomor_keluarga' => '2241333456770912', 'jumlah_kendaraan' => 1, 'jumlah_tanggungan' => 1, 'jumlah_orang_kerja' => 1, 'foto_kk' => 'data_kk/YXakKt45AH0O9ui2xOG18Kr34mazJptKX0k64Kwo.png', 'created_at' => '2024-06-06 06:06:23', 'updated_at' => '2024-06-06 06:06:23'],
            ['id_keluarga' => 29, 'nomor_keluarga' => '2241333456710012', 'jumlah_kendaraan' => 1, 'jumlah_tanggungan' => 0, 'jumlah_orang_kerja' => 1, 'foto_kk' => 'data_kk/PhLwHB1bOzIsetSnh4EE11RGBXCp4qlzXjxN87Qe.png', 'created_at' => '2024-06-06 06:07:23', 'updated_at' => '2024-06-06 06:07:23'],
            ['id_keluarga' => 30, 'nomor_keluarga' => '2241333456730017', 'jumlah_kendaraan' => 1, 'jumlah_tanggungan' => 1, 'jumlah_orang_kerja' => 1, 'foto_kk' => 'data_kk/FJdisNPM0feOI1FhYSjKyqFuB2DUM4HfIOjIUYmI.png', 'created_at' => '2024-06-06 06:07:55', 'updated_at' => '2024-06-06 06:07:55'],
            ['id_keluarga' => 31, 'nomor_keluarga' => '2241333456780041', 'jumlah_kendaraan' => 1, 'jumlah_tanggungan' => 1, 'jumlah_orang_kerja' => 1, 'foto_kk' => 'data_kk/vt86KjO0iGUtUYxcioGNSKgSNp1Qw8vrUjXaWY8j.png', 'created_at' => '2024-06-06 06:08:30', 'updated_at' => '2024-06-06 06:08:30'],
            ['id_keluarga' => 32, 'nomor_keluarga' => '2241333456760010', 'jumlah_kendaraan' => 2, 'jumlah_tanggungan' => 1, 'jumlah_orang_kerja' => 1, 'foto_kk' => 'data_kk/KM4icoMjMcTzIYhkzGWMrpPL61Ig2bdJHkegRaHN.png', 'created_at' => '2024-06-06 06:09:02', 'updated_at' => '2024-06-06 06:09:02'],
            ['id_keluarga' => 33, 'nomor_keluarga' => '2241333456780048', 'jumlah_kendaraan' => 2, 'jumlah_tanggungan' => 1, 'jumlah_orang_kerja' => 1, 'foto_kk' => 'data_kk/sXtzn0zQZiyOcc7kYZcuC3b3QqBVzSWmi4Iw4fsX.png', 'created_at' => '2024-06-06 06:09:56', 'updated_at' => '2024-06-06 06:09:56'],
            ['id_keluarga' => 34, 'nomor_keluarga' => '2241333456780097', 'jumlah_kendaraan' => 3, 'jumlah_tanggungan' => 2, 'jumlah_orang_kerja' => 1, 'foto_kk' => 'data_kk/G8ot4G5WwUMFgFSMC1Ktpj5Cur7GTGE1x9s050FU.png', 'created_at' => '2024-06-06 06:10:34', 'updated_at' => '2024-06-06 06:10:34'],
        ]);
    }
}
