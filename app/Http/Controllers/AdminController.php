<?php

namespace App\Http\Controllers;

use App\Models\BansosModel;
use App\Models\histori_penerimaan_bansos;
use App\Models\KeluargaModel;
use App\Models\PendudukModel;
use App\Models\PengaduanModel;
use App\Models\PengumumanModel;
use App\Models\PromosiModel;
use App\Models\rangkuman_keluarga;
use App\Models\SuratModel;
use App\Models\UserModel;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $statistik_menerima_bansos = BansosModel::where('status', 'closed')
            ->join('kategori_bansos', 'kategori_bansos.id_kategori_bansos', '=', 'bansos.id_kategori_bansos')
            ->select(
                'bansos.id_kategori_bansos',
                'bansos.id_bansos',
                'bansos.jumlah_penerima',
                'bansos.nama',
                'kategori_bansos.nama_kategori'
            )
            ->get();

        // Fetching data for the new pie chart
        $pengajuan_promosi = PromosiModel::select('kategori', 'status_pengajuan', DB::raw('count(*) as jumlah'))
            ->groupBy('kategori', 'status_pengajuan')
            ->get();

        $data = [
            'jumlah_warga' => PendudukModel::count(),
            'jumlah_keluarga' => KeluargaModel::count(),
            'warga' => PendudukModel::all(),
            'keluarga' => rangkuman_keluarga::all(),
            'histori_bansos' => histori_penerimaan_bansos::all(),
            'bansos_acc' => histori_penerimaan_bansos::count(),
            'statistik_menerima_bansos' => $statistik_menerima_bansos,
            'kategori_bansos' => $statistik_menerima_bansos->unique('nama_kategori')->pluck('nama_kategori'),
            'jumlah_akun_aktif' => UserModel::where('status_akun', 'Aktif')->count('id_user'),
            'jumlah_akun_tidak_aktif' => UserModel::where('status_akun', 'Nonaktif')->count('id_user'),
            'jumlah_pengumuman_publikasi' => PengumumanModel::where('status_pengumuman', 'Publikasi')->count('id_pengumuman'),
            'jumlah_pengumuman_draf' => PengumumanModel::where('status_pengumuman', 'Draf')->count('id_pengumuman'),
            'jumlah_surat' => SuratModel::count(),
            'jumlah_promosi' => PromosiModel::count(),
            'promosi' => PromosiModel::all(),
            'pengajuan_promosi' => $pengajuan_promosi,
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

        $pengaduan = PengaduanModel::select('penduduk.nama AS nama', 'pengaduan.tanggal_pengaduan AS tanggal_pengaduan')
            ->selectRaw("REPLACE(pengaduan.deskripsi, '($id_penduduk_rt sebagai penerima aduan)', '') AS deskripsi")
            ->join('penduduk', 'penduduk.id_penduduk', '=', 'pengaduan.id_penduduk')
            ->where('pengaduan.deskripsi', 'LIKE', "%($id_penduduk_rt sebagai penerima aduan)%")
            ->get();

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
            'statistik_jenis_kelamin' => $statistik_jenis_kelamin,
            'pengaduan' => $pengaduan,
        ]);
    }



    public function index_rw()
    {
        // Fetch all necessary data
        $statistik_menerima_bansos = BansosModel::where('status', 'closed')
            ->join('kategori_bansos', 'kategori_bansos.id_kategori_bansos', '=', 'bansos.id_kategori_bansos')
            ->select(
                'bansos.id_kategori_bansos',
                'bansos.id_bansos',
                'bansos.jumlah_penerima',
                'bansos.nama',
                'kategori_bansos.nama_kategori'
            )
            ->get();
        $user = Auth::user();
        $id_penduduk = $user->id_penduduk;

        $pengaduan = PengaduanModel::select('penduduk.nama AS nama', 'pengaduan.tanggal_pengaduan AS tanggal_pengaduan')
            ->selectRaw("REPLACE(pengaduan.deskripsi, '($id_penduduk sebagai penerima aduan)', '') AS deskripsi")
            ->join('penduduk', 'penduduk.id_penduduk', '=', 'pengaduan.id_penduduk')
            ->where('pengaduan.deskripsi', 'LIKE', "%($id_penduduk sebagai penerima aduan)%")
            ->get();
        $data = [
            'jumlah_warga' => PendudukModel::count(),
            'jumlah_keluarga' => KeluargaModel::count(),
            'warga' => PendudukModel::all(),
            'keluarga' => rangkuman_keluarga::all(),
            'histori_bansos' => histori_penerimaan_bansos::all(),
            'bansos_acc' => histori_penerimaan_bansos::count(),
            'statistik_menerima_bansos' => $statistik_menerima_bansos,
            'kategori_bansos' => $statistik_menerima_bansos->unique('nama_kategori')->pluck('nama_kategori'),
            'pengaduan' => $pengaduan,
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
