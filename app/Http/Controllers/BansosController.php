<?php

namespace App\Http\Controllers;

use App\Models\BansosModel;
use App\Models\detail_pertimbangan_acc_bansos;
use App\Models\DetailBansosModel;
use App\Models\histori_penerimaan_bansos;
use App\Models\KriteriaBansosModel;
use App\Models\list_rekomendasi_bansos;
use Illuminate\Http\Request;
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

    // controller untuk rt
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
        $keluarga_yang_mengajukan = DetailBansosModel::where('status', 'pending')
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
        // Mengambil data Bansos
        $bansos = BansosModel::find($id);

        // Fetching histori_penerimaan_bansos records
        $bansos_acc = histori_penerimaan_bansos::where('id_bansos', $id)->get();
        // dd($bansos_acc);

        // ambil data detail bansos
        $detail_bansos = DetailBansosModel::where('id_bansos', $id)->get();
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
        $bansos = list_rekomendasi_bansos::where('id_bansos', $id)->get();

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
    public function create_bansos_rt()
    {
        
        $breadcrumb = (object) [
            'title' => 'Tambah Bantuan Sosial',
            'list' => [
                ['name' => 'Home', 'url' => url('/rt')],
                ['name' => 'Bantuan Sosial', 'url' => url('rt/bansos')],
                ['name' => 'Create', 'url' => url('rt/bansos/create')],
            ]
        ];

        $page = (object)[
            'title' => 'Tambah Bantuan Sosial'
        ];

        $activeMenu = 'bansos';
        return view('rt.bansos.create', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu
        ]);
    }

    public function store_bansos_rt(Request $request)
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

        return redirect('rt/bansos/')
            ->with('success', 'Data Bansos Berhasil Ditambahkan');
    }

    public function edit_bansos_rt($id)
    {
        $bansos = BansosModel::find($id);

        if (!$bansos) {
            return redirect('rt/bansos')->with('error', 'Data Bantuan Sosial tidak ditemukan');
        }

        $breadcrumb = (object) [
            'title' => 'Edit Bantuan Sosial',
            'list' => [
                ['name' => 'Home', 'url' => url('/rt')],
                ['name' => 'Bantuan Sosial', 'url' => url('rt/bansos')],
                ['name' => 'Edit', 'url' => url('rt/bansos/edit')],
            ]
        ];

        $page = (object)[
            'title' => 'Bantuan Sosial'
        ];

        $activeMenu = 'bansos';
        return view('rt.bansos.edit', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'bansos' => $bansos,
            'activeMenu' => $activeMenu
        ]);
    }

    public function update_bansos_rt(Request $request, string $id)
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

            return redirect('rt/bansos')->with('success', 'Data Bansos Berhasil diperbarui');
        } else {
            return redirect('rt/bansos')->with('error', 'Data Bansos tidak ditemukan');
        }
    }

    public function delete_bansos_rt($id)
    {
        $bansos = BansosModel::find($id);

        if ($bansos) {
            $bansos->delete();

            return redirect('rt/bansos')->with('success', 'Data Bansos Berhasil dihapus');
        } else {
            return redirect('rt/bansos')->with('error', 'Data Bansos tidak ditemukan');
        }
    }

    // show detail isi jawaban form kriteria
    public function show_kriteria_rt($id_bansos, $id_keluarga)
    {
        $detail = detail_pertimbangan_acc_bansos::where('id_keluarga', $id_keluarga)
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
}
