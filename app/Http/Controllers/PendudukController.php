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
            'title' => 'Daftar penduduk '
        ];

        $activeMenu = 'penduduk';

        $keluarga = KeluargaModel::all();

        return view('admin.penduduk.penduduk', ['breadcrumb' => $breadcrumb, 'page' => $page, 'keluarga' => $keluarga, 'activeMenu' => $activeMenu]);
    }
    public function list(Request $request)
    {
        $penduduk = PendudukModel::select('id_penduduk', 'nama', 'nik', 'alamat_ktp', 'alamat_domisili', 'no_telp', 'tempat_lahir', 'tanggal_lahir', 'agama', 'pekerjaan', 'gol_darah', 'status_data', 'rt', 'rw', 'status_penduduk');

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
            'title' => 'Form Tambah penduduk baru'
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
        $foto_ktp = $request->file('foto_ktp');

        $nama_file = time() . "_" . $foto_ktp->getClientOriginalName();

        // isi dengan nama folder tempat kemana file diupload
        $tujuan_upload = 'data_ktp';
        $foto_ktp->move($tujuan_upload, $nama_file);

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
            'foto_ktp' => $nama_file // simpan nama file gambar ke dalam database
        ]);

        return redirect('/penduduk')->with('success', 'Data penduduk berhasil disimpan');
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
            'foto_ktp' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $penduduk = PendudukModel::find($id);

        // menyimpan data foto ktp yang diupload ke variabel foto_ktp
        $foto_ktp = $request->file('foto_ktp');

        $nama_file = time() . "_" . $foto_ktp->getClientOriginalName();

        // isi dengan nama folder tempat kemana file diupload
        $tujuan_upload = 'data_ktp';
        $foto_ktp->move($tujuan_upload, $nama_file);

        // Hapus foto ktp lama jika ada
        if ($penduduk->foto_ktp) {
            $path_foto_ktp_lama = public_path('data_ktp/' . $penduduk->foto_ktp);
            if (file_exists($path_foto_ktp_lama)) {
                unlink($path_foto_ktp_lama);
            }
        }

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
            'foto_ktp' => $nama_file // simpan nama file gambar ke dalam database
        ]);

        return redirect('/penduduk/' . $id . '/show')->with('success', 'Data penduduk berhasil diubah');
    }
}
