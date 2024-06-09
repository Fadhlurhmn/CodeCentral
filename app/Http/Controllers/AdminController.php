<?php

namespace App\Http\Controllers;

use App\Models\histori_penerimaan_bansos;
use App\Models\KeluargaModel;
use App\Models\PendudukModel;
use App\Models\rangkuman_keluarga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        // Fetch all necessary data
        $data = [
            'jumlah_warga' => PendudukModel::count(),
            'jumlah_keluarga' => KeluargaModel::count(),
            'warga' => PendudukModel::all(),
            'keluarga' => rangkuman_keluarga::all()
        ];

        // Prepare breadcrumb and active menu
        $breadcrumb = (object) [
            'title' => 'Dashboard',
            'list' => [
                ['name' => 'Home', 'url' => url('/admin')],
            ]
        ];

        $activeMenu = 'dashboard';

        return view('admin.index', [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu,
            'data' => $data
        ]);
    }


    public function index_rt()
    {
        $user = Auth::user();
        // Ambil id_penduduk dari user yang login
        $id_penduduk_rt = $user->id_penduduk;

        // Cari RT dari penduduk yang login
        $rt_penduduk = PendudukModel::select('rt')
            ->where('id_penduduk', $id_penduduk_rt)
            ->first();

        // Ambil nilai rt
        $rt = $rt_penduduk->rt;

        // data-data untuk dashboard
        $jumlah_warga = PendudukModel::where('rt', $rt)->count();
        $jumlah_keluarga = rangkuman_keluarga::where('rt', $rt)->count();

        $statistik_gol_darah_seluruh_warga = PendudukModel::select(DB::raw('gol_darah, COUNT(*) as count'))
            ->where('rt', $rt)
            ->groupBy('gol_darah') // Added GROUP BY
            ->pluck('count', 'gol_darah')->toArray();

        $statistik_warga_tetap_dan_sementara = PendudukModel::select(DB::raw('status_penduduk, COUNT(*) as count'))
            ->where('rt', $rt)
            ->groupBy('status_penduduk') // Added GROUP BY
            ->pluck('count', 'status_penduduk')->toArray();

        $statistik_warga_aktif_dan_tidak_aktif = PendudukModel::select(DB::raw('status_data, COUNT(*) as count'))
            ->where('rt', $rt)
            ->groupBy('status_data') // Added GROUP BY
            ->pluck('count', 'status_data')->toArray();

        $statistik_jenis_kelamin = PendudukModel::select(DB::raw('jenis_kelamin, COUNT(*) as count'))
            ->where('rt', $rt)
            ->groupBy('jenis_kelamin') // Added GROUP BY
            ->pluck('count', 'jenis_kelamin')->toArray();

        $breadcrumb = (object) [
            'title' => 'Dashboard',
            'list' => [
                ['name' => 'Home', 'url' => url('/rt')],
            ]
        ];

        $activeMenu = 'dashboard';

        return view('rt.index', [
            'breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu,
            'jumlah_warga' => $jumlah_warga,
            'jumlah_keluarga' => $jumlah_keluarga,
            'statistik_gol_darah_seluruh_warga' => $statistik_gol_darah_seluruh_warga,
            'statistik_warga_tetap_dan_sementara' => $statistik_warga_tetap_dan_sementara,
            'statistik_warga_aktif_dan_tidak_aktif' => $statistik_warga_aktif_dan_tidak_aktif,
            'statistik_jenis_kelamin' => $statistik_jenis_kelamin
        ]);
    }



    public function index_rw()
    {
        // Fetch all necessary data
        $data = [
            'jumlah_warga' => PendudukModel::count(),
            'jumlah_keluarga' => KeluargaModel::count(),
            'warga' => PendudukModel::all(),
            'keluarga' => rangkuman_keluarga::all(),
            'histori_bansos' => histori_penerimaan_bansos::all(),
            'bansos_acc' => histori_penerimaan_bansos::count(),
        ];

        // Prepare breadcrumb and active menu
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
            'data' => $data
        ]);
    }
}
