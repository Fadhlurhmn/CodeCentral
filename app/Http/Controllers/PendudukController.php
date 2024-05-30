<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PendudukModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PendudukController extends Controller
{
    public function index()
    {
        $breadcrumb = (object)[
            'title' => 'Daftar Penduduk',
            'list' => ['Home', 'Penduduk']
        ];

        $page = (object)[
            'title' => 'Daftar penduduk '
        ];

        $activeMenu = 'penduduk';

        return view('admin.penduduk.penduduk', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
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
        $breadcrumb = (object)[
            'title' => 'Tambah Penduduk',
            'list' => ['Home', 'Penduduk', 'Tambah']
        ];

        $page = (object)[
            'title' => 'Form Tambah penduduk baru'
        ];
        $activeMenu = 'penduduk'; // set menu yang sedang aktif

        return view('admin.penduduk.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|string|digits:16',
            'nama' => 'required|string',
            'alamat_ktp' => 'required|string',
            'no_telp' => 'required|string',
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

        // $nama_file = time() . "_" . $request->foto_ktp->getClientOriginalName();

        // isi dengan nama folder tempat kemana file diupload
        // $path = $request->file('image')->store('foto_barang', 'public');
        // $tujuan_upload = 'data_ktp';
        // $foto_ktp->move($tujuan_upload, $nama_file);

        PendudukModel::create([
            'nik' => $request->nik,
            'nama' => $request->nama,
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

        $breadcrumb = (object)[
            'title' => 'Detail Penduduk',
            'list' => ['Home', 'Penduduk', 'Detail']
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
            'list' => ['Home', 'Penduduk', 'Edit']
        ];

        $page = (object) [
            'title' => 'Ubah data penduduk'
        ];

        $activeMenu = 'penduduk'; // set menu yang sedang aktif

        return view('admin.penduduk.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'penduduk' => $penduduk, 'activeMenu' => $activeMenu]);
    }
    // menyimpan perubahan data penduduk
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nik' => 'required|string|digits:16',
            'nama' => 'required|string',
            'alamat_ktp' => 'required|string',
            'alamat_domisili' => 'required|string',
            'no_telp' => 'required|string',
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
        $breadcrumb = (object)[
            'title' => 'Daftar Penduduk',
            'list' => ['Home', 'Penduduk']
        ];

        $page = (object)[
            'title' => 'Daftar penduduk '
        ];

        $activeMenu = 'penduduk';

        return view('rw.penduduk.penduduk', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
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
            ->make(true);
    }
    public function show_rw(string $id)
    {
        $penduduk = PendudukModel::all()->find($id);

        $breadcrumb = (object)[
            'title' => 'Detail Penduduk',
            'list' => ['Home', 'Penduduk', 'Detail']
        ];

        $page = (object)[
            'title' => 'Detail data penduduk '
        ];

        $activeMenu = 'penduduk'; // set menu yang sedang aktif

        return view('rw.penduduk.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'penduduk' => $penduduk, 'activeMenu' => $activeMenu]);
    }
}
