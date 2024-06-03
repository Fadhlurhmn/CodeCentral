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
        $breadcrumb = (object)[
            'title' => 'Daftar Penerima Bantuan Sosial',
            'list' => ['Home', 'Penerima Bantuan Sosial']
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

        // Lakukan pengecekan apakah kriteria sudah ada atau belum
        $kriteriaExists = KriteriaBansosModel::count() > 0;

        return view('admin.bansos.bansos', [
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
        $bansos = BansosModel::all();

        return DataTables::of($bansos)
            ->addIndexColumn()
            ->addColumn('aksi', function ($bansos) {
                return '<a href="' . url('admin/bansos/' . $bansos->id_bansos . '/show') . '">Detail</a>';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function show($id)
    {
        // Mengambil data Bansos
        $bansos = BansosModel::find($id);

        // Fetching histori_penerimaan_bansos records
        $bansos_acc = histori_penerimaan_bansos::where('id_bansos', $id)->get();
        // dd($bansos_acc);

        // ambil data detail bansos
        $detail_bansos = DetailBansosModel::where('id_bansos', $id)->get();
        if (!$bansos) {
            return redirect('admin/bansos')->with('error', 'Data Bantuan Sosial tidak ditemukan');
        }

        $breadcrumb = (object) [
            'title' => 'Detail Bantuan Sosial',
            'list' => ['Home', 'Bantuan Sosial', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail Bantuan Sosial'
        ];

        $activeMenu = 'bansos';

        return view('admin.bansos.detail', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'detail_bansos' => $detail_bansos,
            'bansos' => $bansos,
            'bansos_acc' => $bansos_acc,
            'activeMenu' => $activeMenu
        ]);
    }

    public function daftar($id)
    {
        $bansos = list_rekomendasi_bansos::where('id_bansos', $id)->get();

        if ($bansos->isEmpty()) {
            return redirect('admin/bansos')->with('error', 'Data Bantuan Sosial tidak ditemukan');
        }

        $breadcrumb = (object) [
            'title' => 'Detail Bantuan Sosial',
            'list' => ['Home', 'Bantuan Sosial', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail Bantuan Sosial'
        ];

        $activeMenu = 'bansos';

        return view('admin.bansos.daftar', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'bansos' => $bansos,
            'activeMenu' => $activeMenu
        ]);
    }

    public function update_acc_bansos(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'status.*' => 'required|in:acc,tolak'
        ]);

        // Perbarui status untuk setiap keluarga yang ada di request
        foreach ($request->status as $id_keluarga => $status) {
            // Temukan data yang sesuai dengan id_bansos dan id_keluarga
            DetailBansosModel::where('id_bansos', $id)
                ->where('id_keluarga', $id_keluarga)
                ->update(['status' => $status]);
        }

        // Redirect kembali ke halaman daftar dengan pesan sukses
        return redirect('admin/bansos/' . $id . '/show')->with('success', 'Data Penerima Bantuan Sosial Berhasil diperbarui');
    }
    public function create_bansos()
    {
        $breadcrumb = (object)[
            'title' => 'Tambah Bantuan Sosial',
            'list' => ['Home', 'Bantuan Sosial', 'Tambah']
        ];

        $page = (object)[
            'title' => 'Tambah Bantuan Sosial'
        ];

        $activeMenu = 'bansos';
        return view('admin.bansos.create', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu
        ]);
    }

    public function store_bansos(Request $request)
    {
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

        return redirect('admin/bansos/')
            ->with('success', 'Data Bansos Berhasil Ditambahkan');
    }

    public function edit_bansos($id)
    {
        $bansos = BansosModel::find($id);

        if (!$bansos) {
            return redirect('admin/bansos')->with('error', 'Data Bantuan Sosial tidak ditemukan');
        }

        $breadcrumb = (object)[
            'title' => 'Edit Bantuan Sosial',
            'list' => ['Home', 'Bantuan Sosial', 'Edit']
        ];

        $page = (object)[
            'title' => 'Bantuan Sosial'
        ];

        $activeMenu = 'bansos';
        return view('admin.bansos.edit', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'bansos' => $bansos,
            'activeMenu' => $activeMenu
        ]);
    }

    public function update_bansos(Request $request, string $id)
    {
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

            return redirect('admin/bansos')->with('success', 'Data Bansos Berhasil diperbarui');
        } else {
            return redirect('admin/bansos')->with('error', 'Data Bansos tidak ditemukan');
        }
    }

    public function delete_bansos($id)
    {
        $bansos = BansosModel::find($id);

        if ($bansos) {
            $bansos->delete();

            return redirect('admin/bansos')->with('success', 'Data Bansos Berhasil dihapus');
        } else {
            return redirect('admin/bansos')->with('error', 'Data Bansos tidak ditemukan');
        }
    }

    // show detail isi jawaban form kriteria
    public function show_kriteria($id_bansos, $id_keluarga)
    {
        $detail = detail_pertimbangan_acc_bansos::where('id_keluarga', $id_keluarga)
            ->where('id_bansos', $id_bansos)
            ->get(); // Menggunakan get() untuk mengambil semua data yang cocok

        $breadcrumb = (object) [
            'title' => 'Detail Keluarga Penerimaan Bantuan Sosial',
            'list' => ['Home', 'Bantuan Sosial', 'Detail Keluarga Penerimaan']
        ];

        $page = (object) [
            'title' => 'Detail Keluarga Penerimaan Bantuan Sosial'
        ];

        $activeMenu = 'bansos';

        return view('admin.bansos.detail_kriteria', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'detail' => $detail,
            'activeMenu' => $activeMenu
        ]);
    }

    public function getHistoriData(Request $request)
    {
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
        // $histori_bansos = histori_penerimaan_bansos::all();
        if ($request->has('id_bansos')) {
            $histori_bansos = histori_penerimaan_bansos::where('id_bansos', $request->id_bansos)->get();
        } else {
            $histori_bansos = histori_penerimaan_bansos::all();
        }
        $bansos = BansosModel::all();
        $breadcrumb = (object) [
            'title' => 'Histori Penerimaan Bantuan Sosial',
            'list' => ['Home', 'Bantuan Sosial', 'Histori Penerimaan']
        ];

        $page = (object) [
            'title' => 'Histori Penerimaan Bantuan Sosial'
        ];

        $activeMenu = 'bansos';

        return view('admin.bansos.histori', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'histori_bansos' => $histori_bansos,
            'bansos' => $bansos,
            'activeMenu' => $activeMenu
        ]);
    }


    // CONTROLLER UNTUK RT
    public function index_rt()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Penerima Bantuan Sosial',
            'list' => [
                ['name' => 'Home', 'url' => url('/rt')],
                ['name' => 'Bantuan Sosial', 'url' => url('rt/bansos')],
            ]
        ];

        $page = (object)[
            'title' => 'Daftar Penerima Bantuan Sosial'
        ];

        $activeMenu = 'bansos';

        $bansos = BansosModel::all();

        $totalBansos = $bansos->count('id_bansos');

        // Ambil data user yang login
        $user = Auth::user();

        // Ambil id_penduduk dari user yang login
        $id_penduduk_rt = $user->id_penduduk;

        // Cari RT dari penduduk yang login
        $rt_penduduk = PendudukModel::select('rt')
            ->where('id_penduduk', $id_penduduk_rt)
            ->first();

        $keluarga_yang_mengajukan = alternatif_per_rt::where('rt', $rt_penduduk->rt)
            ->distinct()
            ->count('id_keluarga');

        // Lakukan pengecekan apakah kriteria sudah ada atau belum
        $kriteriaExists = KriteriaBansosModel::count() > 0;

        return view('rt.bansos.bansos', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
            'bansos' => $bansos,
            'totalBansos' => $totalBansos,
            'keluarga_yang_mengajukan' => $keluarga_yang_mengajukan,
        ])->with('kriteriaExists', $kriteriaExists);
    }

    public function list_rt(Request $request)
    {
        $bansos = BansosModel::all();

        return DataTables::of($bansos)
            ->addIndexColumn()
            ->addColumn('aksi', function ($bansos) {
                return '<a href="' . url('rt/bansos/' . $bansos->id_bansos . '/show') . '">Detail</a>';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function show_rt($id)
    {
        // Ambil data user yang login
        $user = Auth::user();

        // Ambil id_penduduk dari user yang login
        $id_penduduk_rt = $user->id_penduduk;

        // Cari RT dari penduduk yang login
        $rt_penduduk = PendudukModel::select('rt')
            ->where('id_penduduk', $id_penduduk_rt)
            ->first();

        // Mengambil data Bansos
        $bansos = BansosModel::find($id);

        // Fetching histori_penerimaan_bansos records
        $bansos_acc = histori_penerimaan_bansos::where('id_bansos', $id)
            ->where('rt', $rt_penduduk->rt)
            ->get();
        // dd($bansos_acc);

        // ambil data detail bansos
        $detail_bansos = ajuan_bansos_pending_per_rt::where('id_bansos', $id)
            ->where('rt', $rt_penduduk->rt)
            ->get();
        // dd($detail_bansos);
        if (!$bansos) {
            return redirect('rt/bansos')->with('error', 'Data Bantuan Sosial tidak ditemukan');
        }

        $breadcrumb = (object) [
            'title' => 'Detail Bantuan Sosial',
            'list' => [
                ['name' => 'Home', 'url' => url('/rt')],
                ['name' => 'Bantuan Sosial', 'url' => url('rt/bansos')],
                ['name' => 'Detail', 'url' => url('rt/bansos/detail')],
            ]
        ];

        $page = (object) [
            'title' => 'Detail Bantuan Sosial'
        ];

        $activeMenu = 'bansos';

        return view('rt.bansos.detail', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'detail_bansos' => $detail_bansos,
            'bansos' => $bansos,
            'bansos_acc' => $bansos_acc,
            'activeMenu' => $activeMenu
        ]);
    }

    public function daftar_rt($id)
    {
        // Ambil data user yang login
        $user = Auth::user();

        // Ambil id_penduduk dari user yang login
        $id_penduduk_rt = $user->id_penduduk;

        // Cari RT dari penduduk yang login
        $rt_penduduk = PendudukModel::select('rt')
            ->where('id_penduduk', $id_penduduk_rt)
            ->first();

        $bansos = rekomendasi_per_rt::where('id_bansos', $id)
            ->where('rt', $rt_penduduk->rt)
            ->get();

        if ($bansos->isEmpty()) {
            return redirect('rt/bansos')->with('error', 'Data Bantuan Sosial tidak ditemukan');
        }

        $breadcrumb = (object) [
            'title' => 'Daftar Bantuan Sosial',
            'list' => [
                ['name' => 'Home', 'url' => url('/rt')],
                ['name' => 'Bantuan Sosial', 'url' => url('rt/bansos')],
                ['name' => 'Daftar Bantuan Sosial', 'url' => url('rt/bansos/daftar')],
            ]
        ];

        $page = (object) [
            'title' => 'Detail Bantuan Sosial'
        ];

        $activeMenu = 'bansos';

        return view('rt.bansos.daftar', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'bansos' => $bansos,
            'activeMenu' => $activeMenu
        ]);
    }

    public function update_acc_bansos_rt(Request $request, $id)
    {
        // Debugging: Tampilkan semua data yang diterima dalam request
        // dd($request->all());

        // Validasi input
        $request->validate([
            'status.*' => 'required|in:acc,tolak'
        ]);

        // Perbarui status untuk setiap keluarga yang ada di request
        foreach ($request->status as $id_keluarga => $status) {
            // Temukan data yang sesuai dengan id_bansos dan id_keluarga
            DetailBansosModel::where('id_bansos', $id)
                ->where('id_keluarga', $id_keluarga)
                ->update(['status' => $status]);
        }

        // Redirect kembali ke halaman daftar dengan pesan sukses
        return redirect('rt/bansos/' . $id . '/show')->with('success', 'Data Penerima Bantuan Sosial Berhasil diperbarui');
    }


    // show detail isi jawaban form kriteria
    public function show_kriteria_rt($id_bansos, $id_keluarga)
    {
        $detail = detail_pertimbangan_bansos_per_rt::where('id_keluarga', $id_keluarga)
            ->where('id_bansos', $id_bansos)
            ->get(); // Menggunakan get() untuk mengambil semua data yang cocok

        $breadcrumb = (object) [
            'title' => 'Detail Kriteria Keluarga Penerima',
            'list' => [
                ['name' => 'Home', 'url' => url('/rt')],
                ['name' => 'Bantuan Sosial', 'url' => url('rt/bansos')],
                ['name' => 'Detail Kriteria', 'url' => url('rt/bansos/detail_kriteria')],
            ]
        ];

        $page = (object) [
            'title' => 'Detail Keluarga Penerimaan Bantuan Sosial'
        ];

        $activeMenu = 'bansos';

        return view('rt.bansos.detail_kriteria', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'detail' => $detail,
            'activeMenu' => $activeMenu
        ]);
    }

    public function getHistoriData_rt(Request $request)
    {
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


    public function cek_histori_rt(Request $request)
    {
        // Ambil data user yang login
        $user = Auth::user();

        // Ambil id_penduduk dari user yang login
        $id_penduduk_rt = $user->id_penduduk;

        // Cari RT dari penduduk yang login
        $rt_penduduk = PendudukModel::select('rt')
            ->where('id_penduduk', $id_penduduk_rt)
            ->first();

        // $histori_bansos = histori_penerimaan_bansos::all();
        if ($request->has('id_bansos')) {
            $histori_bansos = histori_penerimaan_bansos::where('id_bansos', $request->id_bansos)
                ->where('rt', $rt_penduduk)
                ->get();
        } else {
            $histori_bansos = histori_penerimaan_bansos::all();
        }
        $bansos = BansosModel::all();

        $breadcrumb = (object) [
            'title' => 'Histori Penerimaan Bantuan Sosial',
            'list' => [
                ['name' => 'Home', 'url' => url('/rt')],
                ['name' => 'Bantuan Sosial', 'url' => url('rt/bansos')],
                ['name' => 'Histori', 'url' => url('rt/bansos/histori')],
            ]
        ];

        $page = (object) [
            'title' => 'Histori Penerimaan Bantuan Sosial'
        ];

        $activeMenu = 'bansos';

        return view('rt.bansos.histori', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'histori_bansos' => $histori_bansos,
            'bansos' => $bansos,
            'activeMenu' => $activeMenu
        ]);
    }
  
//   CONTROLLER UNTUK RW
  // controller untuk rw
    public function index_rw()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Penerima Bantuan Sosial',
            'list' => [
                ['name' => 'Home', 'url' => url('/rw')],
                ['name' => 'Bantuan Sosial', 'url' => url('rw/bansos')],
            ]
        ];

        $page = (object)[
            'title' => 'Daftar Penerima Bantuan Sosial'
        ];

        $activeMenu = 'bansos';

        $bansos = BansosModel::all();

        $totalBansos = $bansos->count('id_bansos');
        $keluarga_yang_mengajukan = DetailBansosModel::where('status', 'acc_rt')
            ->distinct()
            ->count('id_keluarga');

        // Lakukan pengecekan apakah kriteria sudah ada atau belum
        $kriteriaExists = KriteriaBansosModel::count() > 0;

        return view('rw.bansos.bansos', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
            'bansos' => $bansos,
            'totalBansos' => $totalBansos,
            'keluarga_yang_mengajukan' => $keluarga_yang_mengajukan,
        ])->with('kriteriaExists', $kriteriaExists);
    }

    public function list_rw(Request $request)
    {
        $bansos = BansosModel::all();

        return DataTables::of($bansos)
            ->addIndexColumn()
            ->addColumn('aksi', function ($bansos) {
                return '<a href="' . url('rw/bansos/' . $bansos->id_bansos . '/show') . '">Detail</a>';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function show_rw($id)
    {
        // Mengambil data Bansos
        $bansos = BansosModel::find($id);

        // Fetching histori_penerimaan_bansos records
        $bansos_acc = histori_penerimaan_bansos::where('id_bansos', $id)->get();
        // dd($bansos_acc);

        // ambil data detail bansos
        $detail_bansos = pengajuan_bansos_acc_rt::where('id_bansos', $id)->get();
        // dd($detail_bansos);
        if (!$bansos) {
            return redirect('rw/bansos')->with('error', 'Data Bantuan Sosial tidak ditemukan');
        }

       $breadcrumb = (object) [
            'title' => 'Detail Bantuan Sosial',
            'list' => [
                ['name' => 'Home', 'url' => url('/rw')],
                ['name' => 'Bantuan Sosial', 'url' => url('rw/bansos')],
                ['name' => 'Detail', 'url' => url('rw/bansos/detail')],
            ]
        ];

        $page = (object) [
            'title' => 'Detail Bantuan Sosial'
        ];

        $activeMenu = 'bansos';

        return view('rw.bansos.detail', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'detail_bansos' => $detail_bansos,
            'bansos' => $bansos,
            'bansos_acc' => $bansos_acc,
            'activeMenu' => $activeMenu
        ]);
    }

    public function daftar_rw($id)
    {
        $bansos = pengajuan_bansos_acc_rt::where('id_bansos', $id)->get();

        if ($bansos->isEmpty()) {
            return redirect('rw/bansos')->with('error', 'Data Bantuan Sosial tidak ditemukan');
        }

        $breadcrumb = (object) [
            'title' => 'Daftar Bantuan Sosial',
            'list' => [
                ['name' => 'Home', 'url' => url('/rw')],
                ['name' => 'Bantuan Sosial', 'url' => url('rw/bansos')],
                ['name' => 'Daftar Bantuan Sosial', 'url' => url('rw/bansos/daftar')],
            ]
        ];

        $page = (object) [
            'title' => 'Detail Bantuan Sosial'
        ];

        $activeMenu = 'bansos';

        return view('rw.bansos.daftar', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'bansos' => $bansos,
            'activeMenu' => $activeMenu
        ]);
    }

    public function update_acc_bansos_rw(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'status.*' => 'required|in:acc,tolak'
        ]);

        // Perbarui status untuk setiap keluarga yang ada di request
        foreach ($request->status as $id_keluarga => $status) {
            // Temukan data yang sesuai dengan id_bansos dan id_keluarga
            DetailBansosModel::where('id_bansos', $id)
                ->where('id_keluarga', $id_keluarga)
                ->update(['status' => $status]);
        }

        // Redirect kembali ke halaman daftar dengan pesan sukses
        return redirect('rw/bansos/' . $id . '/show')->with('success', 'Data Penerima Bantuan Sosial Berhasil diperbarui');
    }
    public function create_bansos_rw()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Bantuan Sosial',
            'list' => [
                ['name' => 'Home', 'url' => url('/rw')],
                ['name' => 'Bantuan Sosial', 'url' => url('rw/bansos')],
                ['name' => 'Tambah Bantuan Sosial', 'url' => url('rw/bansos/create')],
            ]
        ];

        $page = (object)[
            'title' => 'Tambah Bantuan Sosial'
        ];

        $activeMenu = 'bansos';
        return view('rw.bansos.create', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu
        ]);
    }

    public function store_bansos_rw(Request $request)
    {
        $request->validate([
            'kode' => 'required|string',
            'nama_bansos' => 'required|string',
            'tanggal_bansos' => 'required|date',
            'pengirim' => 'required|string',
            'bentuk_pemberian' => 'required|string',
            'jumlah_penerima' => 'required|integer'
        ]);

        $bansos = new BansosModel();
        $bansos->kode = $request->kode;
        $bansos->nama = $request->nama_bansos;
        $bansos->tanggal_pemberian = $request->tanggal_bansos;
        $bansos->pengirim = $request->pengirim;
        $bansos->bentuk_pemberian = $request->bentuk_pemberian;
        $bansos->jumlah_penerima = $request->jumlah_penerima;
        $bansos->save();

        return redirect('rw/bansos/')
            ->with('success', 'Data Bansos Berhasil Ditambahkan');
    }

    public function edit_bansos_rw($id)
    {
        $bansos = BansosModel::find($id);

        if (!$bansos) {
            return redirect('rw/bansos')->with('error', 'Data Bantuan Sosial tidak ditemukan');
        }

        $breadcrumb = (object) [
            'title' => 'Edit Bantuan Sosial',
            'list' => [
                ['name' => 'Home', 'url' => url('/rw')],
                ['name' => 'Bantuan Sosial', 'url' => url('rw/bansos')],
                ['name' => 'Edit Bantuan Sosial', 'url' => url('rw/bansos/edit')],
            ]
        ];

        $page = (object)[
            'title' => 'Bantuan Sosial'
        ];

        $activeMenu = 'bansos';
        return view('rw.bansos.edit', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'bansos' => $bansos,
            'activeMenu' => $activeMenu
        ]);
    }

    public function update_bansos_rw(Request $request, string $id)
    {
        $request->validate([
            'kode' => 'required|string',
            'nama_bansos' => 'required|string',
            'tanggal_bansos' => 'required|date',
            'pengirim' => 'required|string',
            'bentuk_pemberian' => 'required|string',
            'jumlah_penerima' => 'required|integer'
        ]);

        $bansos = BansosModel::find($id);

        if ($bansos) {
            $bansos->kode = $request->kode;
            $bansos->nama = $request->nama_bansos;
            $bansos->tanggal_pemberian = $request->tanggal_bansos;
            $bansos->pengirim = $request->pengirim;
            $bansos->bentuk_pemberian = $request->bentuk_pemberian;
            $bansos->jumlah_penerima = $request->jumlah_penerima;
            $bansos->save();

            return redirect('rw/bansos')->with('success', 'Data Bansos Berhasil diperbarui');
        } else {
            return redirect('rw/bansos')->with('error', 'Data Bansos tidak ditemukan');
        }
    }

    public function delete_bansos_rw($id)
    {
        $bansos = BansosModel::find($id);

        if ($bansos) {
            $bansos->delete();

            return redirect('rw/bansos')->with('success', 'Data Bansos Berhasil dihapus');
        } else {
            return redirect('rw/bansos')->with('error', 'Data Bansos tidak ditemukan');
        }
    }

    // show detail isi jawaban form kriteria
    public function show_kriteria_rw($id_bansos, $id_keluarga)
    {
        $detail = detail_pertimbangan_acc_bansos::where('id_keluarga', $id_keluarga)
            ->where('id_bansos', $id_bansos)
            ->get(); // Menggunakan get() untuk mengambil semua data yang cocok

        $breadcrumb = (object) [
            'title' => 'Detail Keluarga Penerima Bantuan Sosial',
            'list' => [
                ['name' => 'Home', 'url' => url('/rw')],
                ['name' => 'Bantuan Sosial', 'url' => url('rw/bansos')],
                ['name' => 'Detail Bantuan Sosial', 'url' => url('rw/bansos/detail_kriteria')],
            ]
        ];

        $page = (object) [
            'title' => 'Detail Keluarga Penerimaan Bantuan Sosial'
        ];

        $activeMenu = 'bansos';

        return view('rw.bansos.detail_kriteria', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'detail' => $detail,
            'activeMenu' => $activeMenu
        ]);
    }

    public function getHistoriData_rw(Request $request)
    {
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


    public function cek_histori_rw(Request $request)
    {
        // $histori_bansos = histori_penerimaan_bansos::all();
        if ($request->has('id_bansos')) {
            $histori_bansos = histori_penerimaan_bansos::where('id_bansos', $request->id_bansos)->get();
        } else {
            $histori_bansos = histori_penerimaan_bansos::all();
        }
        $bansos = BansosModel::all();
      
        $breadcrumb = (object) [
            'title' => 'Histori Penerimaan Bantuan Sosial',
            'list' => [
                ['name' => 'Home', 'url' => url('/rw')],
                ['name' => 'Bantuan Sosial', 'url' => url('rw/bansos')],
                ['name' => 'Histori Penerimaan', 'url' => url('rw/bansos/histori')],
            ]
        ];

        $page = (object) [
            'title' => 'Histori Penerimaan Bantuan Sosial'
        ];

        $activeMenu = 'bansos';

        return view('rw.bansos.histori', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'histori_bansos' => $histori_bansos,
            'bansos' => $bansos,
            'activeMenu' => $activeMenu
        ]);
    }
  
}
