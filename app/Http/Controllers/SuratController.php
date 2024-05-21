<?php

namespace App\Http\Controllers;

use App\Models\SuratModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\File;

class SuratController extends Controller
{
    public function index()
    {
        $breadcrumb = (object)[
            'title' => 'Daftar Surat',
            'list' => ['Home', 'Surat']
        ];

        $page = (object)[
            'title' => 'Daftar Surat'
        ];

        $activeMenu = 'surat';
        $surat = SuratModel::all();
        $totalSurat = SuratModel::count();
        return view('admin.surat.surat', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu, 'surat' => $surat, 'totalSurat' => $totalSurat]);
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
        $breadcrumb = (object)[
            'title' => 'Tambah Surat',
            'list' => ['Home', 'Surat', 'Tambah']
        ];
        $page = (object)[
            'title' => 'Form Tambah Surat Baru'
        ];
        $activeMenu = 'surat';
        return view('admin.surat.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'berkas' => 'required|file|mimes:docx',
            'deskripsi' => 'required|string|max:255',
            'nama_surat' => 'required|string|max:255'
        ]);

        // Dapatkan nama asli file
        $namaFile = $request->nama_surat;
        // Dapatkan ekstensi file
        $extfile = $request->file('berkas')->getClientOriginalExtension();
        // Gabungkan nama file dengan ekstensi
        $namaFileFix = $namaFile . '.' . $extfile;

        // Simpan file dengan nama yang diinginkan oleh pengguna
        $berkasPath = $request->file('berkas')->storeAs('data_surat', $namaFileFix, 'public');

        // Buat entri baru di database
        $surat = SuratModel::create([
            'deskripsi' => $request->deskripsi,
            'nama_surat' => $request->nama_surat,
            'path_berkas' => $berkasPath // Simpan path untuk referensi (opsional)
        ]);

        // Redirect ke halaman daftar surat dengan pesan sukses
        return redirect('admin/surat')->with('success', 'Data surat berhasil disimpan');
    }


    public function edit(string $id)
    {
        $surat = SuratModel::find($id);

        $breadcrumb = (object)[
            'title' => 'Edit Surat',
            'list' => ['Home', 'Surat', 'Edit']
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
            'berkas' => 'nullable|file|mimes:docx',
            'deskripsi' => 'required|string|max:255',
            'nama_surat' => 'required|string|max:255'
        ]);

        $surat = SuratModel::findOrFail($id);

        // Perbarui deskripsi surat
        $surat->deskripsi = $request->deskripsi;
        $surat->nama_surat = $request->nama_surat;

        // Jika ada file baru diunggah, proses perubahan file
        if ($request->hasFile('berkas')) {
            $extfile = $request->berkas->getClientOriginalExtension();
            $namaFile = $request->nama_surat;
            $namaFileFix = $namaFile . '.' . $extfile;
            $berkasPath = $request->file('berkas')->storeAs('data_surat', $namaFileFix, 'public');

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
}
