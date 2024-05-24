<?php

namespace App\Http\Controllers;

use App\Models\BansosModel;
use App\Models\DetailBansosModel;
use App\Models\KriteriaBansosModel;
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

        return view('admin.bansos.bansos', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu
        ]);
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

    // detail bansos
    public function show($id)
    {
        $bansos = BansosModel::find($id);

        if (!$bansos) {
            return redirect('admin/bansos')->with('error', 'Data Bantuan Sosial tidak ditemukan');
        }
        $breadcrumb = (object) [
            'title' => 'Detail Bantuan Sosial',
            'list' => ['Home', 'Bantuan Sosial', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail datail bansos '
        ];

        $activeMenu = 'bansos';

        return view('admin.bansos.show', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'bansos' => $bansos,
            'activeMenu' => $activeMenu
        ]);
    }

    // Form tambah bansos
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

    // Simpan data bansos ke database
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

        $bansos = BansosModel::create($request->all());

        return redirect('admin/bansos/' . $bansos->id_bansos . '/create_kriteria')
            ->with('success', 'Data Bansos Berhasil Ditambahkan');
    }

    // Form tambah kriteria yang digunakan pada bansos
    public function create_kriteria($id)
    {
        $bansos = BansosModel::find($id);

        if (!$bansos) {
            return redirect('admin/bansos')->with('error', 'Data Bansos tidak ditemukan');
        }

        $breadcrumb = (object)[
            'title' => 'Kriteria Bansos ' . $bansos->nama,
            'list' => ['Home', 'Kriteria Bansos', 'Tambah']
        ];

        $page = (object)[
            'title' => 'Kriteria Bansos ' . $bansos->nama
        ];

        $activeMenu = 'kriteria_bansos';
        return view('admin.bansos.create_kriteria', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'bansos' => $bansos,
            'activeMenu' => $activeMenu
        ]);
    }

    // Simpan data kriteria yang diinputkan pada form
    public function store_kriteria(Request $request)
    {
        $request->validate([
            'id_bansos' => 'required|integer|exists:bansos,id_bansos',
            'nama_kriteria' => 'required|string',
            'bobot' => 'required|numeric'
        ]);

        KriteriaBansosModel::create($request->all());

        return redirect('admin/bansos')->with('success', 'Kriteria Bansos Berhasil Ditambahkan');
    }

    // Form edit data bansos
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

    // Simpan perubahan bansos
    public function update_bansos(Request $request, string $id)
    {
        $request->validate([
            'kode' => 'required|string',
            'nama' => 'required|string',
            'tanggal_pemberian' => 'required|date',
            'pengirim' => 'required|string',
            'bentuk_pemberian' => 'required|string',
            'jumlah_penerima' => 'required|integer'
        ]);

        $bansos = BansosModel::find($id);

        if ($bansos) {
            $bansos->update($request->all());

            return redirect('admin/bansos')->with('success', 'Kriteria Bansos Berhasil diperbarui');
        } else {
            return redirect('admin/bansos')->with('error', 'Data Bansos tidak ditemukan');
        }
    }

    // hapus bansos
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
}
