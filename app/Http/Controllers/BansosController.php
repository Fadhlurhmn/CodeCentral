<?php

namespace App\Http\Controllers;

use App\Models\BansosModel;
use App\Models\DetailBansosModel;
use App\Models\KriteriaBansosModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
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

        return view('admin.bansos.bansos', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    public function list(Request $request)
    {
        $bansos = BansosModel::all();

        return DataTables::of($bansos)
            ->addIndexColumn()
            ->addColumn('aksi', function ($bansos) {
                $btn = '<a href="' . url('admin/bansos/' . $bansos->id_bansos . '/show') . '"';

                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    // form tambah bansos
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
        return view('admin.bansos.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    // simpan data bansos ke database
    public function store_bansos(Request $request)
    {
        $request->validate([
            'kode' => 'required|string',
            'nama' => 'required|string',
            'tanggal_pemberian' => 'required|date',
            'pengirim' => 'required|string',
            'bentuk_pemberian' => 'required|string',
            'jumlah_penerima' => 'required|integer'
        ]);

        BansosModel::create([
            'kode' => $request->kode,
            'nama' => $request->nama,
            'tanggal_pemberian' => $request->tanggal_pemberian,
            'pengirim' => $request->pengirim,
            'bentuk_pemberian' => $request->bentuk_pemberian,
            'jumlah_penerima' => $request->jumlah_penerima
        ]);

        $bansos = BansosModel::where('kode', $request->kode)->first();

        return redirect('admin/bansos/' . $bansos->id_bansos . '/create_kriteria')->with('success', 'Data Bansos Berhasil Ditambahkan');
    }

    // form tambah kriteria yang diguankan pada bansos
    public function create_kriteria($id)
    {
        $bansos = BansosModel::where('id_bansos', $id);
        $breadcrumb = (object)[
            'title' => 'Kriteria Bansos ' . $bansos->nama,
            'list' => ['Home', 'Kriteria Bansos ' . $bansos->nama . 'Tambah']
        ];

        $page = (object)[
            'title' => 'Kriteria Bansos ' . $bansos->nama
        ];

        $activeMenu = 'kriteria_bansos';
        return view('admin.bansos.create_kriteria', ['breadcrumb' => $breadcrumb, 'page' => $page, 'bansos' => $bansos, 'activeMenu' => $activeMenu]);
    }

    // simpan data kriteria yang diinputkan pada form
    public function store_kriteria(Request $request)
    {
        $request->validate([
            'nama_kriteria' => 'required|string',
            'bobot' => 'kriteria|double'
        ]);

        KriteriaBansosModel::create([
            'id_bansos' => $request->id_bansos,
            'nama_kriteria' => $request->nama_kriteria,
            'bobot' => $request->bobot
        ]);

        return redirect('admin/bansos')->with('success', 'Kriteria Bansos Berhasil ditambahkan');
    }

    // edit data bansos
    public function edit_bansos($id)
    {
        $bansos = BansosModel::fid($id);

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
        return view('admin.bansos.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'bansos' => $bansos, 'activeMenu' => $activeMenu]);
    }

    // simpan perubahan bansos
    public function update_bansos(Request $request, string $id)
    {
        // Validasi data yang diterima dari request
        $request->validate([
            'kode' => 'required|string',
            'nama' => 'required|string',
            'tanggal_pemberian' => 'required|date',
            'pengirim' => 'required|string',
            'bentuk_pemberian' => 'required|string',
            'jumlah_penerima' => 'required|integer'
        ]);

        // Mencari data bansos berdasarkan id
        $bansos = BansosModel::find($id);

        // Mengecek apakah data bansos ditemukan
        if ($bansos) {
            // Mengupdate data bansos
            $bansos->update([
                'kode' => $request->kode,
                'nama' => $request->nama,
                'tanggal_pemberian' => $request->tanggal_pemberian,
                'pengirim' => $request->pengirim,
                'bentuk_pemberian' => $request->bentuk_pemberian,
                'jumlah_penerima' => $request->jumlah_penerima
            ]);

            // Redirect ke halaman admin/bansos dengan pesan sukses
            return redirect('admin/bansos')->with('success', 'Kriteria Bansos Berhasil diperbarui');
        } else {
            // Jika data bansos tidak ditemukan, redirect dengan pesan error
            return redirect('admin/bansos')->with('error', 'Data Bansos tidak ditemukan');
        }
    }

    public function delete_bansos($id)
    {
        // Mencari data bansos berdasarkan id
        $bansos = BansosModel::find($id);

        // Mengecek apakah data bansos ditemukan
        if ($bansos) {
            // Menghapus data bansos
            $bansos->delete();

            // Redirect ke halaman admin/bansos dengan pesan sukses
            return redirect('admin/bansos')->with('success', 'Data Bansos Berhasil dihapus');
        } else {
            // Jika data bansos tidak ditemukan, redirect dengan pesan error
            return redirect('admin/bansos')->with('error', 'Data Bansos tidak ditemukan');
        }
    }


    // kalkulasi perhitungan metode SMART
}
