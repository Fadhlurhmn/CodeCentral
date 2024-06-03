<?php

namespace App\Http\Controllers;

use App\Models\KriteriaBansosModel;
use Illuminate\Http\Request;
use PDO;
use Yajra\DataTables\Facades\DataTables;

class KriteriaController extends Controller
{
    public function show_kriteria()
    {
        $kriteria = KriteriaBansosModel::all();

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

    public function update_kriteria()
    {
        $breadcrumb = (object)[
            'title' => 'Tambah Kriteria',
            'list' => ['Home', 'Kriteria', 'Tambah']
        ];

        $page = (object)[
            'title' => 'Tambah Kriteria'
        ];

        $activeMenu = 'kriteria';

        return view('admin.kriteria.update', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu
        ])->with('success', 'Kriteria Berhasil Dibuat');
    }

    public function store_kriteria(Request $request)
    {
        // dd($request->all());
        // Menghapus semua data jika sudah ada sebelumnya
        KriteriaBansosModel::query()->delete();

        $request->validate([
            'kriteria.*' => 'required|string',
            'bobot.*' => 'required|numeric',
            'jenis.*' => 'required|string'
        ]);

        // Mengambil semua data yang dikirimkan melalui form
        $kriteriaData = $request->only('kriteria', 'bobot', 'jenis');

        // Inisialisasi array untuk menyimpan data kriteria
        $kriteria = [];

        // Melakukan iterasi untuk setiap elemen dalam array nama_kriteria dan bobot
        foreach ($kriteriaData['kriteria'] as $key => $value) {
            // Menambahkan data kriteria ke dalam array kriteria
            $kriteria[] = [
                'nama_kriteria' => $kriteriaData['kriteria'][$key],
                'bobot' => $kriteriaData['bobot'][$key],
                'jenis' => $kriteriaData['jenis'][$key]
            ];
        }

        // Menyimpan data kriteria ke dalam database
        KriteriaBansosModel::insert($kriteria);

        return redirect('rt/bansos')
            ->with('success', 'Data Kriteria Berhasil Ditambahkan');
    }

    // controller untuk rt
    public function show_kriteria_rt()
    {
        $kriteria = KriteriaBansosModel::all();

        if (!$kriteria) {
            return redirect('rt/kriteria')->with('error', 'Data Kriteria tidak ditemukan');
        }

        $breadcrumb = (object) [
            'title' => 'Detail Kriteria',
            'list' => [
                ['name' => 'Home', 'url' => url('/rt')],
                ['name' => 'Bantuan Sosial', 'url' => url('rt/bansos')],
                ['name' => 'Show', 'url' => url('rt/kriteria/show')],
            ]
        ];

        $page = (object) [
            'title' => 'Detail Kriteria'
        ];

        $activeMenu = 'kriteria';

        return view('rt.kriteria.show', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'kriteria' => $kriteria,
            'activeMenu' => $activeMenu
        ]);
    }

    public function update_kriteria_rt()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Kriteria',
            'list' => [
                ['name' => 'Home', 'url' => url('/rt')],
                ['name' => 'Bantuan Sosial', 'url' => url('/rt/bansos')],
                ['name' => 'Kriteria Create', 'url' => url('rt/kriteria/create')],
            ]
        ];
        $page = (object)[
            'title' => 'Tambah Kriteria'
        ];

        $activeMenu = 'kriteria';

        return view('rt.kriteria.update', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu
        ])->with('success', 'Kriteria Berhasil Dibuat');
    }

    public function store_kriteria_rt(Request $request)
    {
        // dd($request->all());
        // Menghapus semua data jika sudah ada sebelumnya
        KriteriaBansosModel::query()->delete();

        $request->validate([
            'kriteria.*' => 'required|string',
            'bobot.*' => 'required|numeric',
            'jenis.*' => 'required|string'
        ]);

        // Mengambil semua data yang dikirimkan melalui form
        $kriteriaData = $request->only('kriteria', 'bobot', 'jenis');

        // Inisialisasi array untuk menyimpan data kriteria
        $kriteria = [];

        // Melakukan iterasi untuk setiap elemen dalam array nama_kriteria dan bobot
        foreach ($kriteriaData['kriteria'] as $key => $value) {
            // Menambahkan data kriteria ke dalam array kriteria
            $kriteria[] = [
                'nama_kriteria' => $kriteriaData['kriteria'][$key],
                'bobot' => $kriteriaData['bobot'][$key],
                'jenis' => $kriteriaData['jenis'][$key]
            ];
        }

        // Menyimpan data kriteria ke dalam database
        KriteriaBansosModel::insert($kriteria);

        return redirect('rt/bansos')
            ->with('success', 'Data Kriteria Berhasil Ditambahkan');
    }

    public function show_kriteria_rw()
    {
        $kriteria = KriteriaBansosModel::all();

        if (!$kriteria) {
            return redirect('rw/kriteria')->with('error', 'Data Kriteria tidak ditemukan');
        }

        $breadcrumb = (object) [
            'title' => 'Detail Kriteria',
            'list' => ['Home', 'Kriteria', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail Kriteria'
        ];

        $activeMenu = 'kriteria';

        return view('rw.kriteria.show', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'kriteria' => $kriteria,
            'activeMenu' => $activeMenu
        ]);
    }

    public function update_kriteria_rw()
    {
        $breadcrumb = (object)[
            'title' => 'Tambah Kriteria',
            'list' => ['Home', 'Kriteria', 'Tambah']
        ];

        $page = (object)[
            'title' => 'Tambah Kriteria'
        ];

        $activeMenu = 'kriteria';

        return view('rw.kriteria.update', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu
        ])->with('success','Kriteria Berhasil Dibuat');
    }

    public function store_kriteria_rw(Request $request)
    {
        // dd($request->all());
        // Menghapus semua data jika sudah ada sebelumnya
        KriteriaBansosModel::query()->delete();

        $request->validate([
            'kriteria.*' => 'required|string',
            'bobot.*' => 'required|numeric',
            'jenis.*' => 'required|string'
        ]);

        // Mengambil semua data yang dikirimkan melalui form
        $kriteriaData = $request->only('kriteria', 'bobot', 'jenis');

        // Inisialisasi array untuk menyimpan data kriteria
        $kriteria = [];

        // Melakukan iterasi untuk setiap elemen dalam array nama_kriteria dan bobot
        foreach ($kriteriaData['kriteria'] as $key => $value) {
            // Menambahkan data kriteria ke dalam array kriteria
            $kriteria[] = [
                'nama_kriteria' => $kriteriaData['kriteria'][$key],
                'bobot' => $kriteriaData['bobot'][$key],
                'jenis' => $kriteriaData['jenis'][$key]
            ];
        }

        // Menyimpan data kriteria ke dalam database
        KriteriaBansosModel::insert($kriteria);

        return redirect('rw/bansos')
            ->with('success', 'Data Kriteria Berhasil Ditambahkan');
    }
}
