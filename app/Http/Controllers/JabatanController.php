<?php

namespace App\Http\Controllers;

use App\Models\LevelModel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class JabatanController extends Controller
{
    // Menampilkan halaman daftar jabatan
    public function index()
    {
        $jabatan = LevelModel::all(); // Mengambil semua data jabatan
        $breadcrumb = (object) [
            'title' => 'Daftar Jabatan',
            'list' => [
                ['name' => 'Home', 'url' => url('/admin')],
                ['name' => 'Akun', 'url' => url('admin/jabatan')]
            ]
        ];
        $page = (object) [
            'title' => 'Daftar jabatan yang tersimpan dalam sistem'
        ];
        $activeMenu = 'jabatan';

        return view('admin.jabatan.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'jabatan' => $jabatan,
            'activeMenu' => $activeMenu
        ]);
    }

    // Mengambil data jabatan untuk ditampilkan dalam format DataTables
    public function list()
    {
        $jabatan = LevelModel::select('id_level', 'kode_level', 'nama_level');

        return DataTables::of($jabatan)
            ->addIndexColumn()
            ->addColumn('aksi', function ($jabatan) {
                // Membuat tombol edit
                $btn = '<a href="'.url('admin/jabatan/' . $jabatan->id_level . '/edit').'" class="btn btn-info ml-2 mr-2"><i class="fas fa-edit"></i></a>';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    // Menampilkan halaman form untuk menambah jabatan baru
    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Form Tambah Akun Baru',
            'list' => [
                ['name' => 'Home', 'url' => url('/admin')],
                ['name' => 'Jabatan', 'url' => url('admin/jabatan')],
                ['name' => 'Tambah', 'url' => url('admin/jabatan/create')]
            ]
        ];
        $page = (object) [
            'title' => 'Isi data jabatan'
        ];
        $activeMenu = 'jabatan';

        return view('admin.jabatan.create', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu
        ]);
    }

    // Menyimpan data jabatan baru ke database
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'kode_level' => 'required|string|min:3|unique:level,kode_level',
            'nama_level' => 'required|string',
        ]);

        // Menyimpan data ke database
        LevelModel::create($request->all());

        return redirect('admin/jabatan/')->with('success', 'Data jabatan berhasil disimpan');
    }

    // Menampilkan halaman form untuk mengedit jabatan
    public function edit(string $id)
    {
        $jabatan = LevelModel::findOrFail($id); // Mengambil data jabatan berdasarkan ID
        $breadcrumb = (object) [
            'title' => 'Edit Jabatan',
            'list' => [
                ['name' => 'Home', 'url' => url('/admin')],
                ['name' => 'Jabatan', 'url' => url('admin/jabatan')],
                ['name' => 'Edit', 'url' => url('admin/jabatan/'.$id.'/edit')]
            ]
        ];
        $page = (object) [
            'title' => 'Ubah data jabatan'
        ];
        $activeMenu = 'jabatan';

        return view('admin.jabatan.edit', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'jabatan' => $jabatan,
            'activeMenu' => $activeMenu
        ]);
    }

    // Mengupdate data jabatan ke database
    public function update(Request $request, string $id)
    {
        // Validasi input
        $request->validate([
            'kode_level' => 'required|string|min:3|unique:level,kode_level,'.$id.',id_level',
            'nama_level' => 'required|string',
        ]);

        // Mengambil data jabatan berdasarkan ID dan mengupdate data
        $jabatan = LevelModel::findOrFail($id);
        $jabatan->update($request->all());

        return redirect('admin/jabatan/')->with('success', 'Data jabatan berhasil diubah');
    }

}
