<?php

namespace App\Http\Controllers;

use App\Models\KeluargaModel;
use App\Models\PendudukModel;
use App\Models\rangkuman_keluarga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Dashboard',
            'list' => [
                ['name' => 'Home', 'url' => url('/admin')],
            ]
        ];
        $activeMenu = 'dashboard';

        return view('admin.index', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu]);
    }


    public function index_rt()
    {
        $breadcrumb = (object) [
            'title' => 'Dashboard',
            'list' => [
                ['name' => 'Home', 'url' => url('/rt')],
            ]
        ];

        $activeMenu = 'dashboard';

        return view('rt.index', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu]);
    }

    public function index_rw()
    {
        // data-data untuk dashboard
        $jumlah_warga = PendudukModel::count();
        $jumlah_keluarga = KeluargaModel::count();

        $statistik_warga_per_rt = PendudukModel::select(DB::raw('rt, COUNT(*) as count'))
            ->groupBy('rt')
            ->pluck('count', 'rt')->toArray();

        $statistik_gol_darah_seluruh_warga = PendudukModel::select(DB::raw('gol_darah, COUNT(*) as count'))
            ->groupBy('gol_darah')
            ->pluck('count', 'gol_darah')->toArray();

        $statistik_keluarga_per_rt = rangkuman_keluarga::select(DB::raw('rt, COUNT(*) as count'))
            ->groupBy('rt')
            ->pluck('count', 'rt')->toArray();

        $statistik_warga_tetap_dan_sementara = PendudukModel::select(DB::raw('status_penduduk, COUNT(*) as count'))
            ->groupBy('status_penduduk')
            ->pluck('count', 'status_penduduk')->toArray();

        $statistik_warga_aktif_dan_tidak_aktif = PendudukModel::select(DB::raw('status_data, COUNT(*) as count'))
            ->groupBy('status_data')
            ->pluck('count', 'status_data')->toArray();

        $statistik_jenis_kelamin = PendudukModel::select(DB::raw('jenis_kelamin, COUNT(*) as count'))
            ->groupBy('jenis_kelamin')
            ->pluck('count', 'jenis_kelamin')->toArray();

        $breadcrumb = (object) [
            'title' => 'Dashboard',
            'list' => [
                ['name' => 'Home', 'url' => url('/rw')],
            ]
        ];

        $activeMenu = 'dashboard';

        return view('rw.index', [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu,
            'jumlah_warga' => $jumlah_warga,
            'jumlah_keluarga' => $jumlah_keluarga,
            'statistik_warga_per_rt' => $statistik_warga_per_rt,
            'statistik_gol_darah_seluruh_warga' => $statistik_gol_darah_seluruh_warga,
            'statistik_keluarga_per_rt' => $statistik_keluarga_per_rt,
            'statistik_warga_tetap_dan_sementara' => $statistik_warga_tetap_dan_sementara,
            'statistik_warga_aktif_dan_tidak_aktif' => $statistik_warga_aktif_dan_tidak_aktif,
            'statistik_jenis_kelamin' => $statistik_jenis_kelamin
        ]);
    }
}
