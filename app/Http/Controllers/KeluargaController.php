<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\KeluargaModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class KeluargaController extends Controller
{
    public function index()
    {
        $breadcrumb = (object)[
            'title' => 'Daftar Keluarga',
            'list' => ['Home', 'Keluarga']
        ];

        $page = (object)[
            'title' => 'Daftar keluarga yang terdaftar dalam sistem'
        ];

        $activeMenu = 'keluarga'; // set menu yang sedang aktif

        return view('keluarga.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }
    // ambil data user dalam bentuk json untuk datatables
    public function list(Request $request)
    {
        $kategoris = KeluargaModel::select('keluarga_id', 'nomor_keluarga', 'jumlah_kendaraan', 'jumlah_tanggungan', 'jumlah_orang_kerja', 'luas_tanah');

        return DataTables::of($kategoris)
            ->addIndexColumn()
            ->addColumn('aksi', function ($keluarga) {
                $btn = '<a href="' . url('/keluarga/' . $keluarga->keluarga_id) . '" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<a href="' . url('/keluarga/' . $keluarga->keluarga_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="' . url('/keluarga/' . $keluarga->keluarga_id) . '">'
                    . csrf_field() . method_field('DELETE') . '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }
    // menampilkan halaman form tambah user
    public function create()
    {
        $breadcrumb = (object)[
            'title' => 'Tambah Keluarga',
            'list' => ['Home', 'Keluarga', 'Tambah']
        ];

        $page = (object)[
            'title' => 'Tambah keluarga baru'
        ];

        $activeMenu = 'keluarga'; // set menu yang sedang aktif

        return view('keluarga.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'nomor_keluarga' => 'required|string|min:10|unique:keluarga_penduduk,nomor_keluarga',
            'jumlah_kendaraan'     => 'required|integer',
            'jumlah_tanggungan'     => 'required|integer',
            'jumlah_orang_kerja'     => 'required|integer',
            'luas_tanah'     => 'required|double'
        ]);

        KeluargaModel::create([
            'nomor_keluarga' => $request->nomor_keluarga,
            'jumlah_kendaraan'     => $request->jumlah_kendaraan,
            'jumlah_tanggungan' => $request->jumlah_tanggungan,
            'jumlah_orang_kerja'     => $request->jumlah_orang_kerja,
            'luas_tanah'     => $request->luas_tanah

        ]);

        return redirect('/keluarga')->with('success', 'Data keluarga berhasil disimpan');
    }
    public function show(string $id)
    {
        $keluarga = KeluargaModel::find($id);

        $breadcrumb = (object)[
            'title' => 'Detail Keluarga',
            'list' => ['Home', 'Keluarga', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail Keluarga'
        ];

        $activeMenu = 'keluarga'; // set menu yang sedang aktif

        return view('keluarga.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'keluarga' => $keluarga, 'activeMenu' => $activeMenu]);
    }

    // menampilkan halaman form edit user
    // menampilkan halaman form edit keluarga
    public function edit(string $id)
    {
        $keluarga = KeluargaModel::find($id);

        if (!$keluarga) {
            return redirect('/keluarga')->with('error', 'Data keluarga tidak ditemukan');
        }

        $breadcrumb = (object) [
            'title' => 'Edit Keluarga',
            'list' => ['Home', 'Keluarga', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit Keluarga'
        ];

        $activeMenu = 'keluarga'; // set menu yang sedang aktif

        return view('keluarga.edit', ['breadcrumb' => $breadcrumb, 'page' => $page,  'keluarga' => $keluarga, 'activeMenu' => $activeMenu]);
    }


    // menyimpan perubahan data user
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nomor_keluarga' => 'required|string|min:10|unique:keluarga_penduduk,nomor_keluarga',
            'jumlah_kendaraan'     => 'required|integer',
            'jumlah_tanggungan'     => 'required|integer',
            'jumlah_orang_kerja'     => 'required|integer',
            'luas_tanah'     => 'required|double'
        ]);

        KeluargaModel::find($id)->update([
            'nomor_keluarga' => $request->nomor_keluarga,
            'jumlah_kendaraan'     => $request->jumlah_kendaraan,
            'jumlah_tanggungan' => $request->jumlah_tanggungan,
            'jumlah_orang_kerja'     => $request->jumlah_orang_kerja,
            'luas_tanah'     => $request->luas_tanah
        ]);

        return redirect('/keluarga')->with('success', 'Data keluarga berhasil diubah');
    }
    public function destroy(string $id)
    {
        $check = KeluargaModel::find($id);
        if (!$check) { // untuk mengecek apakah data user dengan id yang dimaksud ada atau tidak
            return redirect('/keluarga')->with('error', 'Data keluarga tidak ditemukan');
        }
        try {
            KeluargaModel::destroy($id); // hapus data keluarga

            return redirect('/keluarga')->with('success', 'Data keluarga berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            // jika terjadi error ketika menghapus data, redirect kembali ke halaman dengan membawa pesan error
            return redirect('/keluarga')->with('error', 'Data keluarga gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }
}
