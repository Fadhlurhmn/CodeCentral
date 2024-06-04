<?php

namespace App\Http\Controllers;

use App\Models\PengumumanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class PengumumanController extends Controller
{
    // Menampilkan daftar pengumuman
    public function index(Request $request)
    {
        // Membuat breadcrumb untuk navigasi
        $breadcrumb = (object)[
            'title' => 'Daftar Pengumuman',
            'list' => [
                ['name' => 'Home', 'url' => url('/admin')],
                ['name' => 'Pengumuman', 'url' => url('admin/pengumuman')]
            ]
        ];

        // Membuat data halaman
        $page = (object)[
            'title' => 'Daftar pengumuman dipublish'
        ];

        $activeMenu = 'pengumuman';

        // Mendapatkan query pencarian dan status jika ada
        $query = $request->input('query');
        $status = $request->input('status');

        // Mengambil data pengumuman dari database
        $pengumuman = PengumumanModel::with('user');

        // Menambahkan kondisi pencarian berdasarkan judul pengumuman
        if ($query) {
            $pengumuman->where('judul_pengumuman', 'like', "%$query%");
        }

        // Menambahkan kondisi filter berdasarkan status pengumuman
        if ($status) {
            $pengumuman->where('status_pengumuman', $status);
        }

        // Mendapatkan data pengumuman dari database
        $pengumuman = $pengumuman->get();

        // Menampilkan view dengan data yang telah dikumpulkan
        return view('admin.pengumuman.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
            'pengumuman' => $pengumuman
        ]);
    }

    // Menampilkan daftar pengumuman dalam bentuk DataTables
    public function list()
    {
        // Mengambil data pengumuman dari database
        $pengumuman = PengumumanModel::select(['id_pengumuman', 'judul_pengumuman', 'created_at']);

        // Mengembalikan data dalam bentuk DataTables
        return DataTables::of($pengumuman)
            ->addIndexColumn()
            ->addColumn('aksi', function ($pengumuman) {
                // Membuat tombol aksi untuk melihat dan mengedit pengumuman
                $btn = '<a href="' . url('admin/pengumuman/' . $pengumuman->id_pengumuman . '/show') . '" class="btn btn-primary ml-1 flex-col "><i class="fas fa-info-circle"></i></a> ';
                $btn .= '<a href="' . url('admin/pengumuman/' . $pengumuman->id_pengumuman . '/edit') . '" class="btn btn-info ml-2 mr-2 flex-col"><i class="fas fa-edit"></i></a> ';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    // Menampilkan form untuk membuat pengumuman baru
    public function create()
    {
        $pengumuman = PengumumanModel::all();

        // Membuat breadcrumb untuk navigasi
        $breadcrumb = (object)[
            'title' => 'Tambah Pengumuman',
            'list' => [
                ['name' => 'Home', 'url' => url('/admin')],
                ['name' => 'Pengumuman', 'url' => url('admin/pengumuman')],
                ['name' => 'Tambah', 'url' => url('admin/pengumuman/create')]
            ]
        ];

        // Membuat data halaman
        $page = (object)[
            'title' => 'Tambah Pengumuman baru'
        ];

        $activeMenu = 'pengumuman';

        // Menampilkan view untuk form tambah pengumuman
        return view('admin.pengumuman.create', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'pengumuman' => $pengumuman,
            'activeMenu' => $activeMenu
        ]);
    }

    // Menyimpan pengumuman baru ke database
    public function store(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'judul_pengumuman' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'thumbnail' => 'required|image|max:2048',
            'status_pengumuman' => 'required|string',
        ]);

        // Menyimpan file thumbnail yang diupload
        $thumbnail = $request->file('thumbnail');
        $nama_file = time() . "_" . $thumbnail->getClientOriginalName();
        $tujuan_upload = 'pengumuman_thumbnail';
        $thumbnail->move($tujuan_upload, $nama_file);

        // Menyimpan data pengumuman ke database
        PengumumanModel::create([
            'id_user' => Auth::user()->id_user,
            'judul_pengumuman' => $request->judul_pengumuman,
            'deskripsi' => $request->deskripsi,
            'thumbnail' => $nama_file,
            'status_pengumuman' => $request->status_pengumuman,
        ]);

        // Redirect ke halaman daftar pengumuman dengan pesan sukses
        return redirect('admin/pengumuman/')->with('success', 'Pengumuman berhasil ditambahkan');
    }

    // Menampilkan detail pengumuman
    public function show($id)
    {
        // Mengambil data pengumuman dari database berdasarkan ID
        $pengumuman = PengumumanModel::findOrFail($id);

        // Membuat breadcrumb untuk navigasi
        $breadcrumb = (object)[
            'title' => 'Preview Pengumuman',
            'list' => [
                ['name' => 'Home', 'url' => url('/admin')],
                ['name' => 'Pengumuman', 'url' => url('admin/pengumuman')],
                ['name' => 'Preview', 'url' => url('admin/pengumuman/' . $id . '/show')]
            ]
        ];

        // Membuat data halaman
        $page = (object)[
            'title' => 'Preview pengumuman'
        ];

        $activeMenu = 'pengumuman';

        // Menampilkan view dengan data pengumuman yang dipilih
        return view('admin.pengumuman.show', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
            'pengumuman' => $pengumuman
        ]);
    }

    // Menampilkan form untuk mengedit pengumuman
    public function edit($id)
    {
        // Mengambil data pengumuman dari database berdasarkan ID
        $pengumuman = PengumumanModel::findOrFail($id);

        // Membuat breadcrumb untuk navigasi
        $breadcrumb = (object) [
            'title' => 'Edit Pengumuman',
            'list' => [
                ['name' => 'Home', 'url' => url('/admin')],
                ['name' => 'Pengumuman', 'url' => url('admin/pengumuman')],
                ['name' => 'Edit', 'url' => url('admin/pengumuman/' . $id . '/edit')]
            ]
        ];

        // Membuat data halaman
        $page = (object) [
            'title' => 'Edit pengumuman'
        ];

        $activeMenu = 'pengumuman';

        // Menampilkan view dengan data pengumuman yang akan diedit
        return view('admin.pengumuman.edit', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
            'pengumuman' => $pengumuman
        ]);
    }

    // Mengupdate data pengumuman yang sudah ada di database
    public function update(Request $request, $id)
    {
        // Validasi input dari form
        $request->validate([
            'judul_pengumuman' => 'required|string',
            'deskripsi' => 'required|string',
            'thumbnail' => 'nullable|image|max:2048',
            'status_pengumuman' => 'required|string',
        ]);

        // Mengambil data pengumuman dari database berdasarkan ID
        $pengumuman = PengumumanModel::findOrFail($id);

        // Jika ada file thumbnail yang diupload, simpan dan update data
        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail');
            $nama_file = time() . "_" . $thumbnail->getClientOriginalName();
            $tujuan_upload = 'pengumuman_thumbnail';
            $thumbnail->move($tujuan_upload, $nama_file);

            $pengumuman->update([
                'id_user' => Auth::user()->id_user,
                'judul_pengumuman' => $request->judul_pengumuman,
                'deskripsi' => $request->deskripsi,
                'thumbnail' => $nama_file,
                'status_pengumuman' => $request->status_pengumuman,
            ]);
        } else {
            // Jika tidak ada file thumbnail yang diupload, update data tanpa mengubah thumbnail
            $pengumuman->update([
                'id_user' => Auth::user()->id_user,
                'judul_pengumuman' => $request->judul_pengumuman,
                'deskripsi' => $request->deskripsi,
                'status_pengumuman' => $request->status_pengumuman,
            ]);
        }

        // Redirect ke halaman daftar pengumuman dengan pesan sukses
        return redirect('admin/pengumuman/')->with('success', 'Pengumuman berhasil diubah');
    }

    // Menghapus pengumuman
    public function destroy($id)
    {
        // Mengambil data pengumuman dari database berdasarkan ID
        $pengumuman = PengumumanModel::findOrFail($id);

        // Menghapus pengumuman dari database
        $pengumuman->delete();

        // Mengembalikan respon sukses
        return response()->json(['success' => true]);
    }

    // Mengupload file untuk pengumuman
    public function upload(Request $request)
    {
        // Jika ada file yang diupload
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = pathinfo($originName, PATHINFO_FILENAME) . '_' . uniqid() . '.' . $extension;

            // Menyimpan file yang diupload ke direktori yang ditentukan
            $path = $request->file('upload')->storeAs('public/pengumuman_gambar', $fileName);

            // Mendapatkan URL file yang diupload
            $url = asset('storage/pengumuman_gambar/' . $fileName);

            // Mengembalikan respon dengan URL file yang diupload
            return response()->json(['fileName' => $fileName, 'uploaded' => 1, 'url' => $url]);
        }
    }
}
