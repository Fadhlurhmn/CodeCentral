<?php

namespace App\Http\Controllers;

use App\Models\BansosModel;
use App\Models\DetailBansosModel;
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
}
