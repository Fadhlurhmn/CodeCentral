<?php

namespace App\Http\Controllers;

use App\Models\LevelModel;
use App\Models\UserModel;
use App\Models\PendudukModel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    // Menampilkan halaman daftar akun
    public function index()
    {
        // Mengambil semua data level dari database
        $level = LevelModel::all();

        // Menyiapkan data breadcrumb untuk navigasi halaman
        $breadcrumb = (object) [
            'title' => 'Daftar Akun',
            'list' => ['Home', 'Akun']
        ];

        // Menyiapkan judul halaman
        $page = (object) [
            'title' => 'Daftar Akun'
        ];

        // Menentukan menu yang aktif
        $activeMenu = 'user';

        // Menampilkan view dengan data yang sudah disiapkan
        return view('admin.akun.akun', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'level' => $level,
            'activeMenu' => $activeMenu
        ]);
    }

    // Menampilkan data user dalam bentuk JSON untuk datatables
    public function list(Request $request)
    {
        // Mengambil data user dengan kolom yang diperlukan dan relasi level dan penduduk
        $akun = UserModel::select('id_user', 'username', 'id_penduduk', 'id_level', 'status_akun')
            ->with(['level', 'penduduk']);

        // Filter berdasarkan Level jika request memiliki id_level
        if ($request->id_level) {
            $akun->where('id_level', $request->id_level);
        }

        // Mengembalikan data user dalam bentuk datatable
        return DataTables::of($akun)
            ->addIndexColumn()
            ->addColumn('aksi', function ($user) {
                // Membuat tombol aksi untuk melihat dan mengedit user
                $btn = '<a href="'.url('admin/akun/' . $user->id_user. '/show').'" class="btn btn-primary ml-1"><i class="fas fa-info-circle"></i></a> ';
                $btn .= '<a href="'.url('admin/akun/' . $user->id_user . '/edit').'" class="btn btn-info ml-2 mr-2"><i class="fas fa-edit"></i></a>';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    // Menampilkan halaman form tambah user
    public function create()
    {
        // Mengambil semua data level dan penduduk dari database
        $level = LevelModel::all();
        $penduduk = PendudukModel::all();

        // Menyiapkan data breadcrumb untuk navigasi halaman
        $breadcrumb = (object) [
            'title' => 'Tambah Akun',
            'list' => ['Home', 'Akun', 'Tambah']
        ];

        // Menyiapkan judul halaman
        $page = (object) [
            'title' => 'Tambah akun baru'
        ];

        // Menentukan menu yang aktif
        $activeMenu = 'user';

        // Menampilkan view dengan data yang sudah disiapkan
        return view('admin.akun.create', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'level' => $level,
            'penduduk' => $penduduk,
            'activeMenu' => $activeMenu
        ]);
    }

    // Menyimpan data user baru
    public function store(Request $request)
    {
        // Validasi input dari request
        $request->validate([
            'username' => 'required|string|min:3|unique:user,username',
            'id_penduduk' => 'required|integer|exists:penduduk,id_penduduk',
            'password' => 'required|min:5',
            'id_level' => 'required|integer|exists:level,id_level',
            'status_akun' => 'nullable|string',
        ]);

        // Membuat data user baru dengan data yang sudah divalidasi
        $user = UserModel::create([
            'username' => $request->username,
            'id_penduduk' => $request->id_penduduk,
            'password' => bcrypt($request->password),  // Mengenkripsi password
            'id_level' => $request->id_level,
            'status_akun' => $request->status_akun ?? 'Aktif',  // Jika status_akun tidak diisi, defaultnya 'Aktif'
        ]);

        // Mengarahkan ke halaman detail user dengan pesan sukses
        return redirect('admin/akun/' . $user->id_user . '/show')->with('success', 'Data user berhasil disimpan');
    }

    // Menampilkan detail user
    public function show(string $id)
    {
        // Mengambil data user berdasarkan ID yang diberikan
        $user = UserModel::with('penduduk', 'level')->find($id);

        // Jika user tidak ditemukan, arahkan kembali ke halaman daftar user dengan pesan error
        if (!$user) {
            return redirect('admin/akun')->with('error', 'Data user tidak ditemukan');
        }

        // Menyiapkan data breadcrumb untuk navigasi halaman
        $breadcrumb = (object) [
            'title' => 'Detail Akun',
            'list' => ['Home', 'User', 'Detail']
        ];

        // Menyiapkan judul halaman
        $page = (object) [
            'title' => 'Detail Akun yang terdaftar dalam sistem'
        ];

        // Menentukan menu yang aktif
        $activeMenu = 'user';

        // Menampilkan view dengan data yang sudah disiapkan
        return view('admin.akun.show', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'user' => $user,
            'activeMenu' => $activeMenu
        ]);
    }

    // Menampilkan halaman form edit user
    public function edit(string $id)
    {
        // Mengambil data user berdasarkan ID yang diberikan
        $user = UserModel::find($id);
        // Mengambil semua data level dan penduduk dari database
        $level = LevelModel::all();
        $penduduk = PendudukModel::all();

        // Menyiapkan data breadcrumb untuk navigasi halaman
        $breadcrumb = (object) [
            'title' => 'Edit User',
            'list' => ['Home', 'User', 'Edit']
        ];

        // Menyiapkan judul halaman
        $page = (object) [
            'title' => 'Edit user'
        ];

        // Menentukan menu yang aktif
        $activeMenu = 'user';

        // Menampilkan view dengan data yang sudah disiapkan
        return view('admin.akun.edit', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'user' => $user,
            'level' => $level,
            'penduduk' => $penduduk,
            'activeMenu' => $activeMenu
        ]);
    }

    // Menyimpan perubahan data user
    public function update(Request $request, string $id)
    {
        // Validasi input dari request
        $request->validate([
            'username' => 'required|string|min:3|unique:user,username,' . $id . ',id_user',
            'id_penduduk' => 'required|integer|unique:user,id_penduduk,' . $id . ',id_user',
            'password' => 'nullable|min:5',
            'id_level' => 'required|integer',
            'status_akun' => 'nullable|string',
        ]);

        // Mengambil data user berdasarkan ID yang diberikan
        $user = UserModel::find($id);
        $user->username = $request->username;
        $user->id_penduduk = $request->id_penduduk;

        // Jika password diisi, enkripsi password baru sebelum menyimpan
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->id_level = $request->id_level;
        $user->status_akun = $request->status_akun;
        $user->save();  // Menyimpan perubahan data user

        // Mengarahkan ke halaman detail user dengan pesan sukses
        return redirect('admin/akun/' . $user->id_user . '/show')->with('success', 'Data user berhasil disimpan');
    }
}
