<?php

namespace App\Http\Controllers;

use App\Models\KeluargaModel;
use App\Models\PendudukModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class KeluargaController extends Controller
{
    public function index()
    {
        $breadcrumb = (object)[
            'title' => 'Daftar Keluarga Keluarga Penduduk',
            'list' => ['Home', 'Keluarga Keluarga Penduduk']
        ];

        $page = (object)[
            'title' => 'Daftar Keluarga Keluarga Penduduk yang terdaftar'
        ];

        $activeMenu = 'keluarga';

        return view('admin.keluarga.keluarga', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }
    public function list(Request $request)
    {
        $keluarga = KeluargaModel::select('id_keluarga', 'nomor_keluarga', 'jumlah_kendaraan', 'jumlah_tanggungan', 'jumlah_orang_kerja', 'luas_tanah');

        return DataTables::of($keluarga)
            ->addIndexColumn()
            ->addColumn('aksi', function ($keluarga) {
                $btn = '<a href="' . url('/keluarga/' . $keluarga->id_keluarga . '/show') . '" class="btn btn-primary ml-1 flex-col "><i class="fas fa-info-circle"></i></a> ';
                $btn .= '<a href="' . url('/keluarga/' . $keluarga->id_keluarga . '/edit') . '" class="btn btn-info ml-2 mr-2 flex-col"><i class="fas fa-edit"></i></a> ';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function create()
    {
        $breadcrumb = (object)[
            'title' => 'Tambah Keluarga Penduduk',
            'list' => ['Home', 'Keluarga Penduduk', 'Tambah']
        ];

        $page = (object)[
            'title' => 'Tambah keluarga baru'
        ];

        $keluarga = KeluargaModel::all(); // ambil data keluar$keluarga untuk ditampilkan di form
        $penduduk = PendudukModel::all(); // ambil data penduduk untuk ditampilkan di form
        $activeMenu = 'keluarga'; // set menu yang sedang aktif

        return view('admin.keluarga.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'penduduk' => $penduduk ,'keluarga' => $keluarga, 'activeMenu' => $activeMenu]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor_keluarga' => 'required|string|min:10|max:10',
            'jumlah_kendaraan' => 'required|integer',
            'jumlah_tanggungan' => 'required|integer',
            'jumlah_orang_kerja' => 'required|integer',
            'luas_tanah' => 'required|integer'
        ]);

        KeluargaModel::create([
            'nomor_keluarga' => $request->nomor_keluarga,
            'jumlah_kendaraan' => $request->jumlah_kendaraan,
            'jumlah_tanggungan' => $request->jumlah_tanggungan,
            'jumlah_orang_kerja' => $request->jumlah_orang_kerja,
            'luas_tanah' => $request->luas_tanah
        ]);

        return redirect('/keluarga')->with('success', 'Data keluarga berhasil disimpan');
    }
    public function show(string $id)
    {
        $keluarga = KeluargaModel::find($id);

        $breadcrumb = (object)[
            'title' => 'Detail Keluarga Penduduk',
            'list' => ['Home', 'Keluarga Penduduk', 'Detail']
        ];

        $page = (object)[
            'title' => 'Detail data keluarga '
        ];

        $activeMenu = 'keluarga'; // set menu yang sedang aktif

        return view('admin.keluarga.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'keluarga' => $keluarga, 'activeMenu' => $activeMenu]);
    }
    public function edit(string $id)
    {
        $keluarga = KeluargaModel::find($id);

        if (!$keluarga) {
            return redirect('/keluarga')->with('error', 'Data keluarga tidak ditemukan');
        }

        $breadcrumb = (object) [
            'title' => 'Edit Keluarga Penduduk',
            'list' => ['Home', 'Keluarga Penduduk', 'Edit']
        ];

        $page = (object) [
            'title' => 'Ubah data keluarga'
        ];

        $activeMenu = 'keluarga'; // set menu yang sedang aktif

        return view('admin.keluarga.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'keluarga' => $keluarga, 'activeMenu' => $activeMenu]);
    }
    // menyimpan perubahan data barang
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nomor_keluarga' => 'required|string|min:10|max:10',
            'jumlah_kendaraan' => 'required|integer',
            'jumlah_tanggungan' => 'required|integer',
            'jumlah_orang_kerja' => 'required|integer',
            'luas_tanah' => 'required|integer'
        ]);

        KeluargaModel::find($id)->update([
            'nomor_keluarga' => $request->nomor_keluarga,
            'jumlah_kendaraan' => $request->jumlah_kendaraan,
            'jumlah_tanggungan' => $request->jumlah_tanggungan,
            'jumlah_orang_kerja' => $request->jumlah_orang_kerja,
            'luas_tanah' => $request->luas_tanah
        ]);

        return redirect('/keluarga/' . $id . '/show')->with('success', 'Data keluarga berhasil diubah');
    }
}
