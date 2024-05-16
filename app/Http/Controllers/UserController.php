<?php
namespace App\Http\Controllers;

use App\Models\LevelModel;
use App\Models\UserModel;
use App\Models\PendudukModel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Akun',
            'list' => ['Home', 'Akun']
        ];

        $page = (object) [
            'title' => 'Daftar Akun'
        ];

        $level = LevelModel::all();
        $activeMenu = 'user';
        return view('admin.akun.akun', ['breadcrumb' => $breadcrumb, 'page' => $page,'level' => $level, 'activeMenu' => $activeMenu]);
    }

    public function list(Request $request)
    {
        $akun = UserModel::select('id_user', 'username', 'id_penduduk', 'id_level', 'status_akun')->with(['level', 'penduduk']);

        // Filter berdasarkan Level
        if ($request->id_level) {
            $akun->where('id_level', $request->id_level);
        }

        return DataTables::of($akun)
            ->addIndexColumn()
            ->addColumn('aksi', function ($user) {
                $btn = '<a href="'.url('admin/akun/' . $user->id_user).'" class="btn btn-primary ml-1 flex-col "><i class="fas fa-info-circle"></i></i></a> ';
                $btn .= '<a href="'.url('admin/akun/' . $user->id_user . '/edit').'" class="btn btn-info ml-2 mr-2 flex-col"><i class="fas fa-edit"></i></a> ';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Akun',
            'list' => ['Home', 'Akun', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah akun baru'
        ];

        $activeMenu = 'user';
        $level = LevelModel::all();
        $penduduk = PendudukModel::all();

        return view('admin.akun.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'level' => $level,'penduduk' => $penduduk, 'activeMenu' => $activeMenu]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|min:3|unique:user,username',
            'id_penduduk' => 'required|integer|unique:use,id_penduduk',
            'password' => 'required|min:5',
            'id_level' => 'required|integer',
            'status_akun' => 'nullable|string',
        ]);

        UserModel::create([
            'username' => $request->username,
            'id_penduduk' => $request->id_penduduk,
            'password' => bcrypt($request->password),
            'id_level' => $request->id_level,
            'status_akun' => $request->status_akun,
        ]);

        return redirect('admin/akun')->with('success', 'Data user berhasil disimpan ');
    }

    public function show(string $id)
    {
        $user = UserModel::with('level')->find($id);
        $level = LevelModel::all()->find($id);
        $penduduk = PendudukModel::all()->find($id);

        $breadcrumb = (object) [
            'title' => 'Detail Akun',
            'list' => ['Home', 'User', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail Akun yang terdaftar dalam sistem'
        ];

        $activeMenu = 'user';

        return view('admin.akun.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'user' => $user,'level' => $level,'penduduk' => $penduduk, 'activeMenu' => $activeMenu]);
    }

    public function edit(string $id)
    {
        $user = UserModel::find($id);
        $level = LevelModel::all();
        $penduduk = PendudukModel::all();

        $breadcrumb = (object) [
            'title' => 'Edit User',
            'list' => ['Home', 'User', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit user'
        ];

        $activeMenu = 'user';

        return view('admin.akun.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'user' => $user,'level' => $level,'penduduk' => $penduduk, 'activeMenu' => $activeMenu]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'username' => 'required|string|min:3|unique:user,username',
            'id_penduduk' => 'required|integer|unique:user,id_penduduk',
            'password' => 'nullable|min:5',
            'id_level' => 'required|integer',
            'status_akun' => 'nullable|string',
        ]);

        UserModel::find($id)->update([
            'username' => $request->username,
            'id_penduduk' => $request->id_penduduk,
            'password' => $request->password ? bcrypt($request->password) : UserModel::find($id)->password,
            'id_level' => $request->id_level,
            'status_akun' => $request->status_akun,
        ]);

        return redirect('/akun/' . $id . '/show')->with('success', 'Data user berhasil disimpan ');
    }
}
