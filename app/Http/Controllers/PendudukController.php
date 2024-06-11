<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\LevelModel;
use App\Models\PendudukModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class PendudukController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Penduduk',
            'list' => [
                ['name' => 'Home', 'url' => url('/admin')],
                ['name' => 'Penduduk', 'url' => url('admin/penduduk')]
            ]
        ];

        $page = (object)[
            'title' => 'Daftar penduduk '
        ];
        $level = LevelModel::all();
        $activeMenu = 'penduduk';

        return view('admin.penduduk.penduduk', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'level' => $level,
            'activeMenu' => $activeMenu
        ]);
    }
    public function list(Request $request)
    {
        $penduduk = PendudukModel::select('id_penduduk', 'nama', 'nik', 'alamat_ktp', 'alamat_domisili', 'no_telp', 'tempat_lahir', 'tanggal_lahir', 'agama', 'pekerjaan', 'gol_darah', 'status_data', 'rt', 'rw', 'status_penduduk');

        // Filter berdasarkan RT 
        if ($request->has('rt')) {
            $penduduk->where('rt', $request->rt);
        }
        return DataTables::of($penduduk)
            ->addIndexColumn()
            ->addColumn('aksi', function ($penduduk) {
                $btn = '<a href="' . url('admin/penduduk/' . $penduduk->id_penduduk . '/show') . '" class="btn btn-primary ml-1 flex-col "><i class="fas fa-info-circle"></i></i></a> ';
                $btn .= '<a href="' . url('admin/penduduk/' . $penduduk->id_penduduk . '/edit') . '" class="btn btn-info ml-2 mr-2 flex-col"><i class="fas fa-edit"></i></a> ';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Penduduk',
            'list' => [
                ['name' => 'Home', 'url' => url('/admin')],
                ['name' => 'Penduduk', 'url' => url('admin/penduduk')],
                ['name' => 'Tambah', 'url' => url('admin/penduduk/create')],
            ]
        ];
        $level = LevelModel::all();
        $page = (object)[
            'title' => 'Form Tambah penduduk baru'
        ];
        $activeMenu = 'penduduk'; // set menu yang sedang aktif

        return view('admin.penduduk.create', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
            'level' => $level
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|string|digits:16|unique:penduduk,nik',
            'nama' => 'required|string',
            'jenis_kelamin' => 'required|string',
            'alamat_ktp' => 'required|string',
            'no_telp' => 'required|string|size:13',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|string',
            'agama' => 'required|string',
            'pekerjaan' => 'required|string',
            'gol_darah' => 'required|string',
            'status_data' => 'nullable|string',
            'status_penduduk' => 'nullable|string',
            'rt' => 'required|integer',
            'rw' => 'required|integer',
            'alamat_domisili' => 'required|string',
            'foto_ktp' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        // menyimpan data foto ktp yang diupload ke variabel foto_ktp
        $foto_ktp = $request->file('foto_ktp')->store('data_ktp', 'public');

        PendudukModel::create([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat_ktp' => $request->alamat_ktp,
            'alamat_domisili' => $request->alamat_domisili,
            'no_telp' => $request->no_telp,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'agama' => $request->agama,
            'pekerjaan' => $request->pekerjaan,
            'gol_darah' => $request->gol_darah,
            'status_data' => $request->status_data,
            'status_penduduk' => $request->status_penduduk,
            'rt' => $request->rt,
            'rw' => $request->rw,
            'foto_ktp' => $foto_ktp // simpan nama file gambar ke dalam database
        ]);

        return redirect('admin/penduduk')->with('success', 'Data penduduk berhasil disimpan');
    }

    public function show(string $id)
    {
        $penduduk = PendudukModel::all()->find($id);

        $breadcrumb = (object) [
            'title' => 'Daftar Penduduk',
            'list' => [
                ['name' => 'Home', 'url' => url('/admin')],
                ['name' => 'Penduduk', 'url' => url('admin/penduduk')],
                ['name' => 'Detail', 'url' => url('admin/penduduk/show')],
            ]
        ];

        $page = (object)[
            'title' => 'Detail data penduduk '
        ];

        $activeMenu = 'penduduk'; // set menu yang sedang aktif

        return view('admin.penduduk.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'penduduk' => $penduduk, 'activeMenu' => $activeMenu]);
    }
    public function edit(string $id)
    {
        $penduduk = PendudukModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Edit Penduduk',
            'list' => [
                ['name' => 'Home', 'url' => url('/admin')],
                ['name' => 'Penduduk', 'url' => url('admin/penduduk')],
                ['name' => 'Edit', 'url' => url('admin/penduduk/edit')],
            ]
        ];

        $page = (object) [
            'title' => 'Ubah data penduduk'
        ];

        $level = LevelModel::all();

        $activeMenu = 'penduduk'; // set menu yang sedang aktif

        return view('admin.penduduk.edit', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'penduduk' => $penduduk,
            'level' => $level,
            'activeMenu' => $activeMenu
        ]);
    }
    // menyimpan perubahan data penduduk
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nik' => 'required|string|digits:16',
            'nama' => 'required|string',
            'jenis_kelamin' => 'required|string',
            'alamat_ktp' => 'required|string',
            'alamat_domisili' => 'required|string',
            'no_telp' => 'required|string|size:13',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|string',
            'agama' => 'required|string',
            'pekerjaan' => 'required|string',
            'gol_darah' => 'required|string',
            'status_data' => 'nullable|string',
            'status_penduduk' => 'nullable|string',
            'rt' => 'required|integer',
            'rw' => 'required|integer',
            'foto_ktp' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $penduduk = PendudukModel::find($id);

        // Cek apakah ada file gambar yang diunggah
        if ($request->hasFile('foto_ktp')) {
            // Dapatkan nama file baru
            $foto_ktp = $request->file('foto_ktp')->store('data_ktp', 'public');

            // Update data penduduk beserta foto ktp baru
            $penduduk->update([
                'nik' => $request->nik,
                'nama' => $request->nama,
                'jenis_kelamin' => $request->jenis_kelamin,
                'alamat_ktp' => $request->alamat_ktp,
                'alamat_domisili' => $request->alamat_domisili,
                'no_telp' => $request->no_telp,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'agama' => $request->agama,
                'pekerjaan' => $request->pekerjaan,
                'gol_darah' => $request->gol_darah,
                'status_data' => $request->status_data,
                'status_penduduk' => $request->status_penduduk,
                'rt' => $request->rt,
                'rw' => $request->rw,
                'foto_ktp' => $foto_ktp // Gunakan nama file baru
            ]);
        } else {
            // Update data penduduk tanpa mengubah foto ktp
            $penduduk->update([
                'nik' => $request->nik,
                'nama' => $request->nama,
                'jenis_kelamin' => $request->jenis_kelamin,
                'alamat_ktp' => $request->alamat_ktp,
                'alamat_domisili' => $request->alamat_domisili,
                'no_telp' => $request->no_telp,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'agama' => $request->agama,
                'pekerjaan' => $request->pekerjaan,
                'gol_darah' => $request->gol_darah,
                'status_data' => $request->status_data,
                'status_penduduk' => $request->status_penduduk,
                'rt' => $request->rt,
                'rw' => $request->rw
            ]);
        }

        return redirect('admin/penduduk/' . $id . '/show')->with('success', 'Data penduduk berhasil diubah');
    }

    // controller rw
    public function index_rw()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Penduduk',
            'list' => [
                ['name' => 'Home', 'url' => url('/rw')],
                ['name' => 'Penduduk', 'url' => url('rw/penduduk')]
            ]
        ];

        $page = (object)[
            'title' => 'Daftar penduduk '
        ];

        $level = LevelModel::all();

        $activeMenu = 'penduduk';

        return view('rw.penduduk.penduduk', [
            'breadcrumb' => $breadcrumb, 
            'page' => $page,
            'level' => $level, 
            'activeMenu' => $activeMenu]);
    }
    public function list_rw(Request $request)
    {
        $penduduk = PendudukModel::select('id_penduduk', 'nama', 'nik', 'alamat_ktp', 'alamat_domisili', 'no_telp', 'tempat_lahir', 'tanggal_lahir', 'agama', 'pekerjaan', 'gol_darah', 'status_data', 'rt', 'rw', 'status_penduduk');

        // Filter berdasarkan RT 
        if ($request->has('rt')) {
            $penduduk->where('rt', $request->rt);
        }

        return DataTables::of($penduduk)
            ->addIndexColumn()
            ->addColumn('aksi', function ($penduduk) {
                $btn = '<a href="' . url('rw/penduduk/' . $penduduk->id_penduduk . '/show') . '" class="btn btn-primary ml-1 flex-col ">Detail   <i class="fas fa-info-circle"></i></a> ';
                // $btn .= '<a href="' . url('rw/penduduk/' . $penduduk->id_penduduk . '/edit') . '" class="btn btn-info ml-2 mr-2 flex-col"><i class="fas fa-edit"></i></a> ';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }
    public function show_rw(string $id)
    {
        $penduduk = PendudukModel::all()->find($id);

        $breadcrumb = (object) [
            'title' => 'Detail data penduduk',
            'list' => [
                ['name' => 'Home', 'url' => url('/rw')],
                ['name' => 'Penduduk', 'url' => url('rw/penduduk')],
                ['name' => 'Detail', 'url' => url('rw/penduduk/show')]
            ]
        ];

        $page = (object)[
            'title' => 'Detail data penduduk '
        ];

        $activeMenu = 'penduduk'; // set menu yang sedang aktif

        return view('rw.penduduk.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'penduduk' => $penduduk, 'activeMenu' => $activeMenu]);
    }


    // controller untuk rt
    public function index_rt()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Penduduk',
            'list' => [
                ['name' => 'Home', 'url' => url('/rt')],
                ['name' => 'Penduduk', 'url' => url('rt/penduduk')]
            ]
        ];

        $page = (object)[
            'title' => 'Daftar penduduk '
        ];

        $activeMenu = 'penduduk';

        return view('rt.penduduk.penduduk', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    public function list_rt(Request $request)
    {
        // Ambil data user yang login
        $user = Auth::user();

        // Ambil id_penduduk dari user yang login
        $id_penduduk_rt = $user->id_penduduk;

        // Cari RT dari penduduk yang login
        $rt_penduduk = PendudukModel::select('rt')
            ->where('id_penduduk', $id_penduduk_rt)
            ->first();

        // Periksa apakah RT ditemukan
        if ($rt_penduduk) {
            // Dapatkan data penduduk berdasarkan RT
            $penduduk = PendudukModel::select('id_penduduk', 'nama', 'nik', 'alamat_ktp', 'alamat_domisili', 'no_telp', 'tempat_lahir', 'tanggal_lahir', 'agama', 'pekerjaan', 'gol_darah', 'status_data', 'rt', 'rw', 'status_penduduk')
                ->where('rt', $rt_penduduk->rt)
                ->get();

            return DataTables::of($penduduk)
                ->addIndexColumn()
                ->addColumn('aksi', function ($penduduk) {
                    $btn = '<a href="' . url('rt/penduduk/' . $penduduk->id_penduduk . '/show') . '" class="btn btn-primary ml-1 flex-col "><i class="fas fa-info-circle"></i></a> ';
                    $btn .= '<a href="' . url('rt/penduduk/' . $penduduk->id_penduduk . '/edit') . '" class="btn btn-info ml-2 mr-2 flex-col"><i class="fas fa-edit"></i></a> ';
                    return $btn;
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }

        // Jika RT tidak ditemukan, kembalikan response yang sesuai
        return response()->json(['error' => 'RT not found'], 404);
    }

    public function create_rt()
    {
        $breadcrumb = (object)[
            'title' => 'Daftar Penduduk',
            'list' => [
                ['name' => 'Home', 'url' => url('/rt')],
                ['name' => 'Penduduk', 'url' => url('rt/penduduk')],
                ['name' => 'Tambah', 'url' => url('rt/penduduk/create')],
            ]
        ];

        $page = (object)[
            'title' => 'Form Tambah penduduk baru'
        ];
        $activeMenu = 'penduduk'; // set menu yang sedang aktif

        // Ambil data user yang login
        $user = Auth::user();

        // Ambil id_penduduk dari user yang login
        $id_penduduk_rt = $user->id_penduduk;

        // Cari RT dari penduduk yang login
        $rt_penduduk = PendudukModel::select('rt')
            ->where('id_penduduk', $id_penduduk_rt)
            ->first();

        return view('rt.penduduk.create', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
            'rt' => $rt_penduduk->rt // Pastikan key adalah 'rt' dan value adalah $rt_penduduk->rt
        ]);
    }


    public function store_rt(Request $request)
    {
        $request->validate([
            'nik' => 'required|string|digits:16|unique:penduduk,nik',
            'nama' => 'required|string',
            'jenis_kelamin' => 'required|string',
            'alamat_ktp' => 'required|string',
            'no_telp' => 'required|string|size:13',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|string',
            'agama' => 'required|string',
            'pekerjaan' => 'required|string',
            'gol_darah' => 'required|string',
            'status_data' => 'nullable|string',
            'status_penduduk' => 'nullable|string',
            'rt' => 'required|integer',
            'rw' => 'required|integer',
            'alamat_domisili' => 'required|string',
            'foto_ktp' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        // menyimpan data foto ktp yang diupload ke variabel foto_ktp
        $foto_ktp = $request->file('foto_ktp')->store('data_ktp', 'public');


        PendudukModel::create([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat_ktp' => $request->alamat_ktp,
            'alamat_domisili' => $request->alamat_domisili,
            'no_telp' => $request->no_telp,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'agama' => $request->agama,
            'pekerjaan' => $request->pekerjaan,
            'gol_darah' => $request->gol_darah,
            'status_data' => $request->status_data,
            'status_penduduk' => $request->status_penduduk,
            'rt' => $request->rt,
            'rw' => $request->rw,
            'foto_ktp' => $foto_ktp // simpan nama file gambar ke dalam database
        ]);

        return redirect('rt/penduduk')->with('success', 'Data penduduk berhasil disimpan');
    }

    public function show_rt(string $id)
    {
        $penduduk = PendudukModel::all()->find($id);

        $breadcrumb = (object) [
            'title' => 'Daftar Penduduk',
            'list' => [
                ['name' => 'Home', 'url' => url('/rt')],
                ['name' => 'Penduduk', 'url' => url('rt/penduduk')],
                ['name' => 'Detail', 'url' => url('rt/penduduk/show')],
            ]
        ];

        $page = (object)[
            'title' => 'Detail data penduduk '
        ];

        $activeMenu = 'penduduk'; // set menu yang sedang aktif

        return view('rt.penduduk.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'penduduk' => $penduduk, 'activeMenu' => $activeMenu]);
    }
    public function edit_rt(string $id)
    {
        $penduduk = PendudukModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Daftar Penduduk',
            'list' => [
                ['name' => 'Home', 'url' => url('/rt')],
                ['name' => 'Penduduk', 'url' => url('rt/penduduk')],
                ['name' => 'Edit', 'url' => url('rt/penduduk/edit')],
            ]
        ];

        $page = (object) [
            'title' => 'Ubah data penduduk'
        ];

        $activeMenu = 'penduduk'; // set menu yang sedang aktif

        return view('rt.penduduk.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'penduduk' => $penduduk, 'activeMenu' => $activeMenu]);
    }
    // menyimpan perubahan data penduduk
    public function update_rt(Request $request, string $id)
    {
        $request->validate([
            'nik' => 'required|string|digits:16',
            'nama' => 'required|string',
            'jenis_kelamin' => 'required|string',
            'alamat_ktp' => 'required|string',
            'alamat_domisili' => 'required|string',
            'no_telp' => 'required|string|size:13',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|string',
            'agama' => 'required|string',
            'pekerjaan' => 'required|string',
            'gol_darah' => 'required|string',
            'status_data' => 'nullable|string',
            'status_penduduk' => 'nullable|string',
            'rt' => 'required|integer',
            'rw' => 'required|integer',
            'foto_ktp' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $penduduk = PendudukModel::find($id);

        // Cek apakah ada file gambar yang diunggah
        if ($request->hasFile('foto_ktp')) {
            // Dapatkan nama file baru
            $foto_ktp = $request->file('foto_ktp')->store('data_ktp', 'public');

            // Update data penduduk beserta foto ktp baru
            $penduduk->update([
                'nik' => $request->nik,
                'nama' => $request->nama,
                'jenis_kelamin' => $request->jenis_kelamin,
                'alamat_ktp' => $request->alamat_ktp,
                'alamat_domisili' => $request->alamat_domisili,
                'no_telp' => $request->no_telp,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'agama' => $request->agama,
                'pekerjaan' => $request->pekerjaan,
                'gol_darah' => $request->gol_darah,
                'status_data' => $request->status_data,
                'status_penduduk' => $request->status_penduduk,
                'rt' => $request->rt,
                'rw' => $request->rw,
                'foto_ktp' => $foto_ktp // Gunakan nama file baru
            ]);
        } else {
            // Update data penduduk tanpa mengubah foto ktp
            $penduduk->update([
                'nik' => $request->nik,
                'nama' => $request->nama,
                'jenis_kelamin' => $request->jenis_kelamin,
                'alamat_ktp' => $request->alamat_ktp,
                'alamat_domisili' => $request->alamat_domisili,
                'no_telp' => $request->no_telp,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'agama' => $request->agama,
                'pekerjaan' => $request->pekerjaan,
                'gol_darah' => $request->gol_darah,
                'status_data' => $request->status_data,
                'status_penduduk' => $request->status_penduduk,
                'rt' => $request->rt,
                'rw' => $request->rw
            ]);
        }

        return redirect('rt/penduduk/' . $id . '/show')->with('success', 'Data penduduk berhasil diubah');
    }
}
