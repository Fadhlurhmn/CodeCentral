<?php

namespace App\Http\Controllers;

use App\Models\SuratModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class SuratController extends Controller
{
    public function index()
    {
        // Ambil data user yang login
        $user = Auth::user();

        // Ambil id_penduduk dari user yang login
        $id_user = $user->id_user;

        $breadcrumb = (object) [
            'title' => 'Daftar Surat',
            'list' => [
                ['name' => 'Home', 'url' => url('/admin')],
                ['name' => 'Surat', 'url' => url('admin/surat')],
            ]
        ];

        $page = (object)[
            'title' => 'Daftar Surat'
        ];

        $activeMenu = 'surat';
        $surat = SuratModel::all();
        $totalSurat = SuratModel::count();
        return view('admin.surat.surat', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu, 'surat' => $surat, 'totalSurat' => $totalSurat, 'id_user' => $id_user]);
    }

    public function list(Request $request)
    {
        $surat = SuratModel::all();

        return DataTables::of($surat)
            ->addIndexColumn()
            ->addColumn('aksi', function ($surat) {
                $editUrl = url('admin/surat/' . $surat->id_surat . '/edit');
                $deleteUrl = url('admin/surat/' . $surat->id_surat . '/hapus');

                $btn = '<a href="' . $editUrl . '" class="btn btn-primary ml-1 flex-col"><i class="fas fa-edit"></i></a> ';
                $btn .= '<a href="' . $deleteUrl . '" class="btn btn-danger ml-1 flex-col"><i class="fas fa-trash"></i></a>';

                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Surat',
            'list' => [
                ['name' => 'Home', 'url' => url('/admin')],
                ['name' => 'Surat', 'url' => url('admin/surat')],
                ['name' => 'Tambah', 'url' => url('admin/surat/create')],
            ]
        ];
        $page = (object)[
            'title' => 'Form Tambah Surat Baru'
        ];
        $activeMenu = 'surat';
        return view('admin.surat.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'berkas' => 'required|file|mimes:pdf',
            'deskripsi' => 'required|string|max:255',
            'nama_surat' => 'required|string|max:255'
        ]);

        // Generate a hashed file name
        $hashedFileName = Str::random(40) . '.' . $request->file('berkas')->getClientOriginalExtension();

        // Simpan file dengan nama yang diinginkan oleh pengguna
        $berkasPath = $request->file('berkas')->storeAs('data_surat', $hashedFileName, 'public');

        // Buat entri baru di database
        $surat = SuratModel::create([
            'deskripsi' => $request->deskripsi,
            'nama_surat' => $request->nama_surat,
            'path_berkas' => $berkasPath, // Simpan path untuk referensi (opsional)
            'id_user' => $request->id_user
        ]);

        // Redirect ke halaman daftar surat dengan pesan sukses
        return redirect('admin/surat')->with('success', 'Data surat berhasil disimpan');
    }

    public function edit(string $id)
    {
        $surat = SuratModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Edit Surat',
            'list' => [
                ['name' => 'Home', 'url' => url('/admin')],
                ['name' => 'Surat', 'url' => url('admin/surat')],
                ['name' => 'Edit', 'url' => url('admin/surat/edit')],
            ]
        ];

        $page = (object)[
            'title' => 'Ubah data surat'
        ];

        $activeMenu = 'surat';

        return view('admin.surat.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu, 'surat' => $surat]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'berkas' => 'nullable|file|mimes:pdf',
            'deskripsi' => 'required|string|max:255',
            'nama_surat' => 'required|string|max:255'
        ]);

        $surat = SuratModel::findOrFail($id);

        // Perbarui deskripsi surat
        $surat->deskripsi = $request->deskripsi;
        $surat->nama_surat = $request->nama_surat;

        // Jika ada file baru diunggah, proses perubahan file
        if ($request->hasFile('berkas')) {
            $hashedFileName = Str::random(40) . '.' . $request->file('berkas')->getClientOriginalExtension();
            $berkasPath = $request->file('berkas')->storeAs('data_surat', $hashedFileName, 'public');

            // Hapus file lama jika ada
            if (!empty($surat->path_berkas)) {
                Storage::disk('public')->delete($surat->path_berkas);
            }

            $surat->path_berkas = $berkasPath;
        }

        // Simpan perubahan
        $surat->save();

        return redirect('admin/surat')->with('success', 'Data surat berhasil diperbarui');
    }

    public function delete($id)
    {
        $surat = SuratModel::find($id);
        if ($surat) {
            if ($surat->berkas) {
                Storage::delete($surat->path_berkas);
            }
            // Hapus data dari database
            $surat->delete();
            return response()->json(['success' => 'Surat berhasil dihapus.']);
        } else {
            return response()->json(['error' => 'Surat tidak ditemukan.'], 404);
        }
    }

    public function preview_surat($id)
    {
        $surat = SuratModel::find($id);
        if (!$surat) {
            return redirect()->back()->with('error', 'Surat tidak ditemukan');
        }

        $path = storage_path('app/public/' . $surat->path_berkas);
        if (!file_exists($path)) {
            return redirect()->back()->with('error', 'File surat tidak ditemukan');
        }

        return response()->file($path);
    }
}
