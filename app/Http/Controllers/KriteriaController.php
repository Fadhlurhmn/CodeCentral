<?php

namespace App\Http\Controllers;

use App\Models\KriteriaBansosModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDO;
use Yajra\DataTables\Facades\DataTables;

class KriteriaController extends Controller
{
    public function show_kriteria()
    {
        $user = Auth::user();
        $role = '';
        if ($user->id_level == 1) {
            $role = 'admin';
        } else if ($user->id_level == 2) {
            $role = 'rw';
        }
        $kriteria = KriteriaBansosModel::all();

        if (!$kriteria) {
            return redirect($role . '/kriteria')->with('error', 'Data Kriteria tidak ditemukan');
        }

        $breadcrumb = (object) [
            'title' => 'Detail Kriteria',
            'list' => [
                ['name' => 'Home', 'url' => url('/' . $role)],
                ['name' => 'Detail Kriteria', 'url' => url($role . '/bansos')],
            ]
        ];

        $page = (object) [
            'title' => 'Detail Kriteria'
        ];

        $activeMenu = 'bansos';

        return view($role . '.kriteria.show', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'kriteria' => $kriteria,
            'activeMenu' => $activeMenu
        ]);
    }

    public function update_kriteria()
    {
        $user = Auth::user();
        $role = '';
        if ($user->id_level == 1) {
            $role = 'admin';
        } else if ($user->id_level == 2) {
            $role = 'rw';
        }
        $breadcrumb = (object) [
            'title' => 'Tambah Kriteria',
            'list' => [
                ['name' => 'Home', 'url' => url('/' . $role)],
                ['name' => 'Bantuan Sosial', 'url' => url('/' . $role . '/bansos')],
                ['name' => 'Kriteria Create', 'url' => url($role . '/kriteria/create')],
            ]
        ];

        $page = (object)[
            'title' => 'Tambah Kriteria'
        ];

        $activeMenu = 'bansos';

        return view($role . '.kriteria.update', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu
        ])->with('success', 'Kriteria Berhasil Dibuat');
    }

    public function store_kriteria(Request $request)
    {
        $user = Auth::user();
        $role = '';
        if ($user->id_level == 1) {
            $role = 'admin';
        } else if ($user->id_level == 2) {
            $role = 'rw';
        }

        $request->validate([
            'kriteria.*' => 'required|string',
            'bobot.*' => 'required|numeric',
            'jenis.*' => 'required|string'
        ]);

        // Mengambil semua data yang dikirimkan melalui form
        $kriteriaData = $request->only('kriteria', 'bobot', 'jenis');

        // Melakukan iterasi untuk setiap elemen dalam array kriteria
        foreach ($kriteriaData['kriteria'] as $key => $value) {
            // Menemukan kriteria berdasarkan nama_kriteria
            $kriteria = KriteriaBansosModel::where('nama_kriteria', $value)->first();

            if ($kriteria) {
                // Mengupdate kriteria yang ditemukan
                $kriteria->bobot = $kriteriaData['bobot'][$key];
                $kriteria->jenis = $kriteriaData['jenis'][$key];
                $kriteria->save();
            } else {
                // Jika tidak ditemukan, membuat kriteria baru
                KriteriaBansosModel::create([
                    'nama_kriteria' => $value,
                    'bobot' => $kriteriaData['bobot'][$key],
                    'jenis' => $kriteriaData['jenis'][$key]
                ]);
            }
        }

        return redirect($role . '/bansos')
            ->with('success', 'Data Kriteria Berhasil Ditambahkan');
    }
}
