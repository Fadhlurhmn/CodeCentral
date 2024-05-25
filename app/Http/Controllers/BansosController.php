<?php

namespace App\Http\Controllers;

use App\Models\bansos\BansosModel;
use App\Models\bansos\DetailBansosModel;
use App\Models\bansos\histori_penerimaan_bansos;
use App\Models\bansos\KriteriaBansosModel;
use App\Models\bansos\list_rekomendasi_bansos;
use App\Models\BansosModel as ModelsBansosModel;
use App\Models\detail_pertimbangan_acc_bansos;
use App\Models\DetailBansosModel as ModelsDetailBansosModel;
use App\Models\histori_penerimaan_bansos as ModelsHistori_penerimaan_bansos;
use App\Models\KriteriaBansosModel as ModelsKriteriaBansosModel;
use App\Models\list_rekomendasi_bansos as ModelsList_rekomendasi_bansos;
use Illuminate\Http\Request;
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

        $bansos = ModelsBansosModel::all();

        $totalBansos = $bansos->count('id_bansos');

        // Lakukan pengecekan apakah kriteria sudah ada atau belum
        $kriteriaExists = ModelsKriteriaBansosModel::count() > 0;

        return view('admin.bansos.bansos', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
            'bansos' => $bansos,
            'totalBansos' => $totalBansos,
        ])->with('kriteriaExists', $kriteriaExists);
    }

    public function list(Request $request)
    {
        $bansos = ModelsBansosModel::all();

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
        // Mengambil data Bansos beserta DetailBansos terkait berdasarkan id_bansos
        $bansos = ModelsBansosModel::with(['detail_bansos.keluarga'])->find($id);

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
            'bansos' => $bansos,
            'activeMenu' => $activeMenu,
            'detailBansos' => $bansos->detail_bansos
        ]);
    }

    public function daftar($id)
    {
        $bansos = ModelsBansosModel::find($id);

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

        return view('admin.bansos.daftar', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'bansos' => $bansos,
            'activeMenu' => $activeMenu
        ]);
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

        $bansos = new ModelsBansosModel();
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
        $bansos = ModelsBansosModel::find($id);

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

        $bansos = ModelsBansosModel::find($id);

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
        $bansos = ModelsBansosModel::find($id);

        if ($bansos) {
            $bansos->delete();

            return redirect('admin/bansos')->with('success', 'Data Bansos Berhasil dihapus');
        } else {
            return redirect('admin/bansos')->with('error', 'Data Bansos tidak ditemukan');
        }
    }

    public function cek_histori()
    {
        $histori_bansos = ModelsHistori_penerimaan_bansos::all();

        $breadcrumb = (object) [
            'title' => 'Histori Penerimaan Bantuan Sosial',
            'list' => ['Home', 'Bantuan Sosial', 'Histori Penerimaan']
        ];

        $page = (object) [
            'title' => 'Histori Penerimaan Bantuan Sosial'
        ];

        $activeMenu = 'bansos';

        return view('admin.bansos.hisgori', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'histori_bansos' => $histori_bansos,
            'activeMenu' => $activeMenu
        ]);
    }
    // ini buat nampilin list rekomendasi penerimaan bansos beserta ranking nya berdasarkan id bansos
    public function list_rekomendasi($id)
    {
        $rekomendasi = ModelsList_rekomendasi_bansos::where('id_bansos', $id)->get();

        $breadcrumb = (object) [
            'title' => 'Rekomendasi Penerimaan Bantuan Sosial',
            'list' => ['Home', 'Bantuan Sosial', 'Rekomendasi Penerimaan']
        ];

        $page = (object) [
            'title' => 'Rekomendasi Penerimaan Bantuan Sosial'
        ];

        $activeMenu = 'bansos';

        return view('admin.bansos.rekomendasi', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'rekomendasi' => $rekomendasi,
            'activeMenu' => $activeMenu
        ]);
    }
    // show detail isi jawaban form kriteria
    public function show_kriteria($id)
    {
        $detail = detail_pertimbangan_acc_bansos::where('id_keluarga', $id)->first();
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
    public function update_acc_bansos(Request $request)
    {
        $request->validate([
            'status' => 'required|in:acc,tolak'
        ]);

        $cari_data = ModelsDetailBansosModel::where('id_keluarga', $request->id_keluarga)
            ->where('id_bansos', $request->id_bansos)
            ->first();

        if ($cari_data) {
            $cari_data->update([
                'status' => $request->status
            ]);

            return redirect('admin/bansos')->with('success', 'Data Penerima Bantuan Sosial Berhasil diperbarui');
        } else {
            return redirect('admin/bansos')->with('error', 'Data tidak ditemukan');
        }
    }
}
