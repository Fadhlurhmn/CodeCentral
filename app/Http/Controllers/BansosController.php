<?php

namespace App\Http\Controllers;

use App\Models\ajuan_bansos_pending_per_rt;
use App\Models\alternatif_per_rt;
use App\Models\BansosModel;
use App\Models\detail_pertimbangan_acc_bansos;
use App\Models\detail_pertimbangan_bansos_per_rt;
use App\Models\DetailBansosModel;
use App\Models\histori_penerimaan_bansos;
use App\Models\KriteriaBansosModel;
use App\Models\list_rekomendasi_bansos;
use App\Models\PendudukModel;
use App\Models\rekomendasi_per_rt;
use App\Models\pengajuan_bansos_acc_rt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class BansosController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $role = '';
        if ($user->id_level == 1) {
            $role = 'admin';
        } else if ($user->id_level == 2) {
            $role = 'rw';
        }
        $breadcrumb = (object) [
            'title' => 'Daftar Penerima Bantuan Sosial',
            'list' => [
                ['name' => 'Home', 'url' => url('/' . $role)],
                ['name' => 'Bantuan Sosial', 'url' => url($role . '/bansos')],
            ]
        ];

        $page = (object)[
            'title' => 'Daftar Penerima Bantuan Sosial'
        ];

        $activeMenu = 'bansos';

        $bansos = BansosModel::all();

        $totalBansos = $bansos->count('id_bansos');
        $keluarga_yang_mengajukan = DetailBansosModel::where('status', 'pending')
            ->distinct()
            ->count('id_keluarga');

        $kriteriaExists = KriteriaBansosModel::count() > 0;

        return view($role . '.bansos.bansos', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
            'bansos' => $bansos,
            'totalBansos' => $totalBansos,
            'keluarga_yang_mengajukan' => $keluarga_yang_mengajukan,
        ])->with('kriteriaExists', $kriteriaExists);
    }

    public function list(Request $request)
    {
        $user = Auth::user();
        $role = '';
        if ($user->id_level == 1) {
            $role = 'admin';
        } else if ($user->id_level == 2) {
            $role = 'rw';
        }

        $bansos = BansosModel::all();

        return DataTables::of($bansos)
            ->addIndexColumn()
            ->addColumn('aksi', function ($bansos) use ($role) {
                return '<a href="' . url($role . '/bansos/' . $bansos->id_bansos . '/show') . '">Detail</a>';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }


    public function show($id)
    {
        $user = Auth::user();
        $role = '';
        if ($user->id_level == 1) {
            $role = 'admin';
        } else if ($user->id_level == 2) {
            $role = 'rw';
        }
        $bansos = BansosModel::find($id);

        $bansos_acc = histori_penerimaan_bansos::where('id_bansos', $id)->get();

        $detail_bansos = DetailBansosModel::where('id_bansos', $id)->get();
        if (!$bansos) {
            return redirect('/' . $role . '/bansos')->with('error', 'Data Bantuan Sosial tidak ditemukan');
        }

        $breadcrumb = (object) [
            'title' => 'Detail Bantuan Sosial',
            'list' => [
                ['name' => 'Home', 'url' => url($role . '/')],
                ['name' => 'Bantuan Sosial', 'url' => url($role . '/bansos')],
                ['name' => 'Detail', 'url' => url($role . '/bansos/detail')],
            ]
        ];

        $page = (object) [
            'title' => 'Detail Bantuan Sosial'
        ];

        $activeMenu = 'bansos';

        return view($role . '.bansos.detail', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'detail_bansos' => $detail_bansos,
            'bansos' => $bansos,
            'bansos_acc' => $bansos_acc,
            'activeMenu' => $activeMenu
        ]);
    }

    // Implementasi fungsi-fungsi lainnya

    // Perlu dipastikan bahwa variabel $role sudah didefinisikan di setiap fungsi dengan benar.

    // Lanjutan BansosController

    public function daftar($id)
    {
        $user = Auth::user();
        $role = '';
        if ($user->id_level == 1) {
            $role = 'admin';
        } else if ($user->id_level == 2) {
            $role = 'rw';
        }
        $bansos = list_rekomendasi_bansos::where('id_bansos', $id)->get();

        if ($bansos->isEmpty()) {
            return redirect('/' . $role . '/bansos')->with('error', 'Data Bantuan Sosial tidak ditemukan');
        }

        $breadcrumb = (object) [
            'title' => 'Daftar Bantuan Sosial',
            'list' => [
                ['name' => 'Home', 'url' => url($role . '/')],
                ['name' => 'Bantuan Sosial', 'url' => url($role . '/bansos')],
                ['name' => 'Daftar Bantuan Sosial', 'url' => url($role . '/bansos/daftar')],
            ]
        ];

        $page = (object) [
            'title' => 'Detail Bantuan Sosial'
        ];

        $activeMenu = 'bansos';

        return view($role . '.bansos.daftar', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'bansos' => $bansos,
            'activeMenu' => $activeMenu
        ]);
    }

    public function update_acc_bansos(Request $request, $id)
    {
        $user = Auth::user();
        $role = '';
        if ($user->id_level == 1) {
            $role = 'admin';
        } else if ($user->id_level == 2) {
            $role = 'rw';
        }

        $request->validate([
            'status.*' => 'required|in:acc,tolak'
        ]);

        foreach ($request->status as $id_keluarga => $status) {
            DetailBansosModel::where('id_bansos', $id)
                ->where('id_keluarga', $id_keluarga)
                ->update(['status' => $status]);
        }

        return redirect('/' . $role . '/bansos/' . $id . '/show')->with('success', 'Data Penerima Bantuan Sosial Berhasil diperbarui');
    }

    public function create_bansos()
    {
        $user = Auth::user();
        $role = '';
        if ($user->id_level == 1) {
            $role = 'admin';
        } else if ($user->id_level == 2) {
            $role = 'rw';
        }
        $breadcrumb = (object) [
            'title' => 'Tambah Bantuan Sosial',
            'list' => [
                ['name' => 'Home', 'url' => url($role . '/')],
                ['name' => 'Bantuan Sosial', 'url' => url($role . '/bansos')],
                ['name' => 'Tambah Bantuan Sosial', 'url' => url($role . '/bansos/create')],
            ]
        ];

        $page = (object)[
            'title' => 'Tambah Bantuan Sosial'
        ];

        $activeMenu = 'bansos';
        return view($role . '.bansos.create', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu
        ]);
    }

    // Implementasi fungsi-fungsi lainnya

    // Lanjutan BansosController

    public function store_bansos(Request $request)
    {
        $user = Auth::user();
        $role = '';
        if ($user->id_level == 1) {
            $role = 'admin';
        } else if ($user->id_level == 2) {
            $role = 'rw';
        }
        $request->validate([
            'nama_bansos' => 'required|string',
            'tanggal_bansos' => 'required|date',
            'pengirim' => 'required|string',
            'bentuk_pemberian' => 'required|string',
            'jumlah_penerima' => 'required|integer'
        ]);

        $bansos = new BansosModel();
        $bansos->nama = $request->nama_bansos;
        $bansos->tanggal_pemberian = $request->tanggal_bansos;
        $bansos->pengirim = $request->pengirim;
        $bansos->bentuk_pemberian = $request->bentuk_pemberian;
        $bansos->jumlah_penerima = $request->jumlah_penerima;
        $bansos->save();

        return redirect('/' . $role . '/bansos/')
            ->with('success', 'Data Bansos Berhasil Ditambahkan');
    }

    public function edit_bansos($id)
    {
        $user = Auth::user();
        $role = '';
        if ($user->id_level == 1) {
            $role = 'admin';
        } else if ($user->id_level == 2) {
            $role = 'rw';
        }
        $bansos = BansosModel::find($id);

        if (!$bansos) {
            return redirect('/' . $role . '/bansos')->with('error', 'Data Bantuan Sosial tidak ditemukan');
        }

        $breadcrumb = (object) [
            'title' => 'Edit Bantuan Sosial',
            'list' => [
                ['name' => 'Home', 'url' => url($role . '/')],
                ['name' => 'Bantuan Sosial', 'url' => url($role . '/bansos')],
                ['name' => 'Edit Bantuan Sosial', 'url' => url($role . '/bansos/edit')],
            ]
        ];

        $page = (object)[
            'title' => 'Bantuan Sosial'
        ];

        $activeMenu = 'bansos';
        return view($role . '.bansos.edit', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'bansos' => $bansos,
            'activeMenu' => $activeMenu
        ]);
    }

    public function update_bansos(Request $request, string $id)
    {
        $user = Auth::user();
        $role = '';
        if ($user->id_level == 1) {
            $role = 'admin';
        } else if ($user->id_level == 2) {
            $role = 'rw';
        }
        $request->validate([
            'nama_bansos' => 'required|string',
            'tanggal_bansos' => 'required|date',
            'pengirim' => 'required|string',
            'bentuk_pemberian' => 'required|string',
            'jumlah_penerima' => 'required|integer'
        ]);

        $bansos = BansosModel::find($id);

        if ($bansos) {
            $bansos->nama = $request->nama_bansos;
            $bansos->tanggal_pemberian = $request->tanggal_bansos;
            $bansos->pengirim = $request->pengirim;
            $bansos->bentuk_pemberian = $request->bentuk_pemberian;
            $bansos->jumlah_penerima = $request->jumlah_penerima;
            $bansos->save();

            return redirect('/' . $role . '/bansos')->with('success', 'Data Bansos Berhasil diperbarui');
        } else {
            return redirect('/' . $role . '/bansos')->with('error', 'Data Bansos tidak ditemukan');
        }
    }

    public function delete_bansos($id)
    {
        $user = Auth::user();
        $role = '';
        if ($user->id_level == 1) {
            $role = 'admin';
        } else if ($user->id_level == 2) {
            $role = 'rw';
        }
        $bansos = BansosModel::find($id);

        if ($bansos) {
            $bansos->delete();

            return redirect('/' . $role . '/bansos')->with('success', 'Data Bansos Berhasil dihapus');
        } else {
            return redirect('/' . $role . '/bansos')->with('error', 'Data Bansos tidak ditemukan');
        }
    }

    // Implementasi fungsi-fungsi lainnya
    // Lanjutan BansosController

    public function show_kriteria($id_bansos, $id_keluarga)
    {
        $user = Auth::user();
        $role = '';
        if ($user->id_level == 1) {
            $role = 'admin';
        } else if ($user->id_level == 2) {
            $role = 'rw';
        }
        $detail = detail_pertimbangan_acc_bansos::where('id_keluarga', $id_keluarga)
            ->where('id_bansos', $id_bansos)
            ->get(); // Menggunakan get() untuk mengambil semua data yang cocok

        $breadcrumb = (object) [
            'title' => 'Detail Keluarga Penerima Bantuan Sosial',
            'list' => [
                ['name' => 'Home', 'url' => url('/' . $role . '/')],
                ['name' => 'Bantuan Sosial', 'url' => url('/' . $role . '/bansos')],
                ['name' => 'Detail Bantuan Sosial', 'url' => url('/' . $role . '/bansos/detail_kriteria')],
            ]
        ];

        $page = (object) [
            'title' => 'Detail Keluarga Penerimaan Bantuan Sosial'
        ];

        $activeMenu = 'bansos';

        return view($role . '.bansos.detail_kriteria', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'detail' => $detail,
            'activeMenu' => $activeMenu
        ]);
    }

    public function getHistoriData(Request $request)
    {
        $user = Auth::user();
        $role = '';
        if ($user->id_level == 1) {
            $role = 'admin';
        } else if ($user->id_level == 2) {
            $role = 'rw';
        }
        $bansos = BansosModel::select('id_bansos', 'nama');
        $query = histori_penerimaan_bansos::query();

        // Filter berdasarkan ID_Bansos jika ada
        if ($request->has('search') && !empty($request->search)) {
            $query->where('nomor_keluarga', 'like', '%' . $request->search . '%');
        }

        if ($request->has('id_bansos')) {
            $histori_bansos = histori_penerimaan_bansos::where('id_bansos', $request->id_bansos)->get();
        } else {
            $histori_bansos = histori_penerimaan_bansos::all();
        }

        return DataTables::of($histori_bansos)
            ->addIndexColumn()
            ->make(true);
    }

    public function cek_histori(Request $request)
    {
        $user = Auth::user();
        $role = '';
        if ($user->id_level == 1) {
            $role = 'admin';
        } else if ($user->id_level == 2) {
            $role = 'rw';
        }
        if ($request->has('id_bansos')) {
            $histori_bansos = histori_penerimaan_bansos::where('id_bansos', $request->id_bansos)->get();
        } else {
            $histori_bansos = histori_penerimaan_bansos::all();
        }
        $bansos = BansosModel::all();
        $breadcrumb = (object) [
            'title' => 'Histori Penerimaan Bantuan Sosial',
            'list' => [
                ['name' => 'Home', 'url' => url('/' . $role . '/')],
                ['name' => 'Bantuan Sosial', 'url' => url('/' . $role . '/bansos')],
                ['name' => 'Histori', 'url' => url('/' . $role . '/bansos/histori')],
            ]
        ];

        $page = (object) [
            'title' => 'Histori Penerimaan Bantuan Sosial'
        ];

        $activeMenu = 'bansos';

        return view($role . '.bansos.histori', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'histori_bansos' => $histori_bansos,
            'bansos' => $bansos,
            'activeMenu' => $activeMenu
        ]);
    }

    // Implementasi fitur lainnya



}
