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

        return view('admin.penduduk.penduduk', ['breadcrumb' => $breadcrumb, 'page' => $page, 'keluarga' => $keluarga, 'activeMenu' => $activeMenu]);
    }
    public function list(Request $request)
    {
        $penduduk = PendudukModel::select('id_penduduk', 'nama', 'nik', 'alamat', 'no_telp', 'tempat_lahir', 'tanggal_lahir', 'agama', 'pekerjaan', 'gol_darah', 'id_keluarga', 'status_data', 'rt', 'rw', 'status_penduduk')
            ->with('keluarga');

        if ($request->keluarga_id) {
            $penduduk->where('id_keluarga', $request->keluarga_id);
        }

        // Filter berdasarkan RT 
        if ($request->has('rt')) {
            $penduduk->where('rt', $request->rt);
        }
        return DataTables::of($penduduk)
            ->addIndexColumn()
            ->addColumn('aksi', function ($penduduk) {
                $btn = '<a href="' . url('/penduduk/' . $penduduk->id_penduduk . '/show') . '" class="btn btn-primary ml-1 flex-col "><i class="fas fa-info-circle"></i></i></a> ';
                $btn .= '<a href="' . url('/penduduk/' . $penduduk->id_penduduk . '/edit') . '" class="btn btn-info ml-2 mr-2 flex-col"><i class="fas fa-edit"></i></a> ';
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
            'title' => 'Tambah penduduk baru'
        ];

        $keluarga = KeluargaModel::all(); // ambil data keluar$keluarga untuk ditampilkan di form
        $activeMenu = 'penduduk'; // set menu yang sedang aktif

        return view('admin.penduduk.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'keluarga' => $keluarga, 'activeMenu' => $activeMenu]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|string',
            'nama' => 'required|string',
            'alamat' => 'required|string',
            'no_telp' => 'required|integer',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|string',
            'agama' => 'required|string',
            'pekerjaan' => 'required|string',
            'gol_darah' => 'required|string',
            'status_data' => 'nullable|string',
            'status_penduduk' => 'nullable|string',
            'rt' => 'required|integer',
            'rw' => 'required|integer',
            'id_keluarga' => 'required|integer'
        ]);

        PendudukModel::create([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
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
            'id_keluarga' => $request->id_keluarga,
        ]);

        return redirect('/penduduk')->with('success', 'Data penduduk berhasil disimpan');
    }
    public function show(string $id)
    {
        $penduduk = PendudukModel::with('keluarga')->find($id);
        $nomor_kk = $penduduk->keluarga->nomor_keluarga;

        $breadcrumb = (object)[
            'title' => 'Detail Penduduk',
            'list' => ['Home', 'Penduduk', 'Detail']
        ];

        $page = (object)[
            'title' => 'Detail data penduduk '
        ];

        $activeMenu = 'penduduk'; // set menu yang sedang aktif

        return view('admin.penduduk.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'penduduk' => $penduduk, 'activeMenu' => $activeMenu, 'nomor_kk' => $nomor_kk]);
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
            'title' => 'Ubah data penduduk'
        ];

        $activeMenu = 'penduduk'; // set menu yang sedang aktif

        return view('admin.penduduk.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'penduduk' => $penduduk, 'keluarga' => $keluarga, 'activeMenu' => $activeMenu]);
    }
    // menyimpan perubahan data barang
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nik' => 'required|string',
            'nama' => 'required|string',
            'alamat' => 'required|string',
            'no_telp' => 'required|integer',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|string',
            'agama' => 'required|string',
            'pekerjaan' => 'required|string',
            'gol_darah' => 'required|string',
            'status_data' => 'nullable|string',
            'status_penduduk' => 'nullable|string',
            'rt' => 'required|integer',
            'rw' => 'required|integer',
            'id_keluarga' => 'required|integer'
        ]);

        PendudukModel::find($id)->update([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
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
            'id_keluarga' => $request->id_keluarga,
        ]);

        return redirect('/penduduk/' . $id . '/show')->with('success', 'Data penduduk berhasil diubah');
    }
}
