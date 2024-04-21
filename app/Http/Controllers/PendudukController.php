<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\KeluargaModel;
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
            'title' => 'Daftar penduduk yang terdaftar'
        ];

        $activeMenu = 'penduduk';

        $keluarga = KeluargaModel::all();

        return view('penduduk.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'keluarga' => $keluarga, 'activeMenu' => $activeMenu]);
    }
    public function list(Request $request)
    {
        $penduduk = PendudukModel::select('nama', 'nik', 'alamat', 'no_telp', 'tempat_lahir', 'tanggal_lahir', 'agama', 'pekerjaan', 'gol_darah', 'id_keluarga', 'status_data', 'rt', 'rw', 'status_penduduk')
            ->with('keluarga');

        if ($request->keluarga_id) {
            $penduduk->where('keluarga_id', $request->kategori_id);
        }

        return DataTables::of($penduduk)
            ->addIndexColumn()
            ->addColumn('aksi', function ($penduduk) {
                $btn = '<a href="' . url('/penduduk/' . $penduduk->penduduk_id) . '" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<a href="' . url('/penduduk/' . $penduduk->penduduk_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="' . url('/penduduk/' . $penduduk->penduduk_id) . '">'
                    . csrf_field() . method_field('DELETE') . '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
                return $btn;
            })
            ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
            ->make(true);
    }
    public function create()
    {
        $breadcrumb = (object)[
            'title' => 'Tambah Penduduk',
            'list' => ['Home', 'Penduduk', 'Tambah']
        ];

        $page = (object)[
            'title' => 'Tambah penduduk baru'
        ];

        $keluarga = KeluargaModel::all(); // ambil data keluar$keluarga untuk ditampilkan di form
        $activeMenu = 'penduduk'; // set menu yang sedang aktif

        return view('penduduk.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'keluar$keluarga' => $keluarga, 'activeMenu' => $activeMenu]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|string|min:16|unique:penduduk,nik',
            'nama' => 'required|string|max:100',
            'alamat' => 'required|string',
            'no_telp' => 'required|integer',
            'tempat_lahir' => 'required|string|max:200',
            'tanggal_lahir' => 'required|string|max:200',
            'agama' => 'required|string|max:200',
            'pekerjaan' => 'required|string|max:200',
            'gol_darah' => 'required|string|max:3',
            'status_data' => 'required|string',
            'status_penduduk' => 'required|string',
            'rt' => 'required|integer',
            'rw' => 'required|integer',
            'id_keluarga' => 'required|integer'
        ]);

        PendudukModel::create([
            'nama' => $request->nama,
            'nik' => $request->nik,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'agama' => $request->agama,
            'pekerjaan' => $request->pekerjaan,
            'gol_darah' => $request->gol_darah,
            'id_keluarga' => $request->id_keluarga,
            'status_data' => $request->status_data,
            'rt' => $request->rt,
            'rw' => $request->rw,
            'status_penduduk' => $request->status_penduduk
        ]);

        return redirect('/penduduk')->with('success', 'Data penduduk berhasil disimpan');
    }
    public function show(string $id)
    {
        $penduduk = PendudukModel::with('keluarga')->find($id);

        $breadcrumb = (object)[
            'title' => 'Detail Penduduk',
            'list' => ['Home', 'Penduduk', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail Penduduk'
        ];

        $activeMenu = 'penduduk'; // set menu yang sedang aktif

        return view('penduduk.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'penduduk' => $penduduk, 'activeMenu' => $activeMenu]);
    }
    public function edit(string $id)
    {
        $penduduk = PendudukModel::find($id);
        $keluarga = KeluargaModel::all();

        $breadcrumb = (object) [
            'title' => 'Edit Penduduk',
            'list' => ['Home', 'Penduduk', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit Penduduk'
        ];

        $activeMenu = 'penduduk'; // set menu yang sedang aktif

        return view('penduduk.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'penduduk' => $penduduk, 'keluarga' => $keluarga, 'activeMenu' => $activeMenu]);
    }
    // menyimpan perubahan data barang
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nik' => 'required|string|min:16|unique:penduduk,nik',
            'nama' => 'required|string|max:100',
            'alamat' => 'required|string',
            'no_telp' => 'required|integer',
            'tempat_lahir' => 'required|string|max:200',
            'tanggal_lahir' => 'required|string|max:200',
            'agama' => 'required|string|max:200',
            'pekerjaan' => 'required|string|max:200',
            'gol_darah' => 'required|string|max:3',
            'status_data' => 'required|string',
            'status_penduduk' => 'required|string',
            'rt' => 'required|integer',
            'rw' => 'required|integer',
            'id_keluarga' => 'required|integer'
        ]);

        PendudukModel::find($id)->update([
            'nama' => $request->nama,
            'nik' => $request->nik,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'agama' => $request->agama,
            'pekerjaan' => $request->pekerjaan,
            'gol_darah' => $request->gol_darah,
            'id_keluarga' => $request->id_keluarga,
            'status_data' => $request->status_data,
            'rt' => $request->rt,
            'rw' => $request->rw,
            'status_penduduk' => $request->status_penduduk
        ]);

        return redirect('/penduduk')->with('success', 'Data penduduk berhasil diubah');
    }
}
