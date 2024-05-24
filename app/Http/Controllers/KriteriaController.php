<?php

namespace App\Http\Controllers;

use App\Models\KriteriaBansosModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class KriteriaController extends Controller
{
    public function index()
    {
        $breadcrumb = (object)[
            'title' => 'Daftar Kriteria Bantuan Sosial',
            'list' => ['Home', 'Kriteria Bantuan Sosial']
        ];

        $page = (object)[
            'title' => 'Daftar Kriteria Bantuan Sosial'
        ];

        $activeMenu = 'kriteria';

        return view('admin.kriteria.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu
        ]);
    }

    public function list(Request $request)
    {
        $kriteria = KriteriaBansosModel::all();

        return DataTables::of($kriteria)
            ->addIndexColumn()
            ->addColumn('aksi', function ($kriteria) {
                return '<a href="' . url('admin/kriteria/' . $kriteria->id_kriteria . '/show') . '">Detail</a>';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function show($id)
    {
        $kriteria = KriteriaBansosModel::find($id);

        if (!$kriteria) {
            return redirect('admin/kriteria')->with('error', 'Data Kriteria tidak ditemukan');
        }

        $breadcrumb = (object) [
            'title' => 'Detail Kriteria',
            'list' => ['Home', 'Kriteria', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail Kriteria'
        ];

        $activeMenu = 'kriteria';

        return view('admin.kriteria.show', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'kriteria' => $kriteria,
            'activeMenu' => $activeMenu
        ]);
    }

    public function create_kriteria()
    {
        $breadcrumb = (object)[
            'title' => 'Tambah Kriteria',
            'list' => ['Home', 'Kriteria', 'Tambah']
        ];

        $page = (object)[
            'title' => 'Tambah Kriteria'
        ];

        $activeMenu = 'kriteria';

        return view('admin.kriteria.create', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu
        ]);
    }

    public function store_kriteria(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'kriteria.*' => 'required|string',
            'bobot.*' => 'required|numeric'
        ]);

        // Mengambil semua data yang dikirimkan melalui form
        $kriteriaData = $request->only('kriteria', 'bobot');

        // Inisialisasi array untuk menyimpan data kriteria
        $kriteria = [];

        // Melakukan iterasi untuk setiap elemen dalam array nama_kriteria dan bobot
        foreach ($kriteriaData['kriteria'] as $key => $value) {
            // Menambahkan data kriteria ke dalam array kriteria
            $kriteria[] = [
                'nama_kriteria' => $kriteriaData['kriteria'][$key],
                'bobot' => $kriteriaData['bobot'][$key],
            ];
        }

        // Menyimpan data kriteria ke dalam database
        KriteriaBansosModel::insert($kriteria);

        return redirect('admin/bansos')
            ->with('success', 'Data Kriteria Berhasil Ditambahkan');
    }
    public function edit_kriteria($id)
    {
        $kriteria = KriteriaBansosModel::find($id);

        if (!$kriteria) {
            return redirect('admin/kriteria')->with('error', 'Data Kriteria tidak ditemukan');
        }

        $breadcrumb = (object)[
            'title' => 'Edit Kriteria',
            'list' => ['Home', 'Kriteria', 'Edit']
        ];

        $page = (object)[
            'title' => 'Edit Kriteria'
        ];

        $activeMenu = 'kriteria';

        return view('admin.kriteria.edit', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'kriteria' => $kriteria,
            'activeMenu' => $activeMenu
        ]);
    }

    public function update_kriteria(Request $request, string $id)
    {
        $request->validate([
            'nama_kriteria' => 'required|string',
            'bobot' => 'required|numeric'
        ]);

        $kriteria = KriteriaBansosModel::find($id);

        if ($kriteria) {
            $kriteria->nama_kriteria = $request->nama_kriteria;
            $kriteria->bobot = $request->bobot;
            $kriteria->save();

            return redirect('admin/kriteria')->with('success', 'Data Kriteria Berhasil diperbarui');
        } else {
            return redirect('admin/kriteria')->with('error', 'Data Kriteria tidak ditemukan');
        }
    }

    public function delete_kriteria($id)
    {
        $kriteria = KriteriaBansosModel::find($id);

        if ($kriteria) {
            $kriteria->delete();

            return redirect('admin/kriteria')->with('success', 'Data Kriteria Berhasil dihapus');
        } else {
            return redirect('admin/kriteria')->with('error', 'Data Kriteria tidak ditemukan');
        }
    }
}
