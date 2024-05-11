<?php

namespace App\Http\Controllers;

use App\Models\detail_keluarga_model;
use App\Models\KeluargaModel;
use App\Models\PendudukModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class KeluargaController extends Controller
{
    public function index()
    {
        $breadcrumb = (object)[
            'title' => 'Daftar Keluarga Keluarga Penduduk',
            'list' => ['Home', 'Keluarga Keluarga Penduduk']
        ];

        $page = (object)[
            'title' => 'Daftar Keluarga Keluarga Penduduk yang terdaftar'
        ];

        $activeMenu = 'keluarga';

        return view('admin.keluarga.keluarga', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    public function list(Request $request)
    {
        $keluarga = KeluargaModel::select('id_keluarga', 'nomor_keluarga', 'jumlah_kendaraan', 'jumlah_tanggungan', 'jumlah_orang_kerja', 'luas_tanah');

        return DataTables::of($keluarga)
            ->addIndexColumn()
            ->addColumn('aksi', function ($keluarga) {
                $btn = '<a href="' . url('/keluarga/' . $keluarga->id_keluarga . '/show') . '" class="btn btn-primary ml-1 flex-col "><i class="fas fa-info-circle"></i></a> ';
                $btn .= '<a href="' . url('/keluarga/' . $keluarga->id_keluarga . '/edit') . '" class="btn btn-info ml-2 mr-2 flex-col"><i class="fas fa-edit"></i></a> ';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function create()
    {
        $breadcrumb = (object)[
            'title' => 'Tambah Keluarga Penduduk',
            'list' => ['Home', 'Keluarga Penduduk', 'Tambah']
        ];

        $page = (object)[
            'title' => 'Tambah Data Keluarga'
        ];

        $keluarga = KeluargaModel::all(); // ambil data keluar$keluarga untuk ditampilkan di form
        $penduduk = PendudukModel::all(); // ambil data penduduk untuk ditampilkan di form
        $activeMenu = 'keluarga'; // set menu yang sedang aktif

        return view('admin.keluarga.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'penduduk' => $penduduk, 'keluarga' => $keluarga, 'activeMenu' => $activeMenu]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor_keluarga' => 'required|string|min:10|max:10',
            'jumlah_kendaraan' => 'required|integer',
            'jumlah_tanggungan' => 'required|integer',
            'jumlah_orang_kerja' => 'required|integer',
            'luas_tanah' => 'required|integer',
            'alamat' => 'required|string',
            'rt' => 'required|integer',
            'rw' => 'required|integer',
            'kelurahan' => 'required|string',
            'kecamatan' => 'required|string',
            'kota' => 'required|string',
            'foto_kk' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        // menyimpan data foto kk yang diupload ke variabel foto_kk
        $foto_kk = $request->file('foto_kk');

        $nama_file = time() . "_" . $foto_kk->getClientOriginalName();

        // isi dengan nama folder tempat kemana file diupload
        $tujuan_upload = 'data_kk';
        $foto_kk->move($tujuan_upload, $nama_file);

        $keluarga = KeluargaModel::create([
            'nomor_keluarga' => $request->nomor_keluarga,
            'jumlah_kendaraan' => $request->jumlah_kendaraan,
            'jumlah_tanggungan' => $request->jumlah_tanggungan,
            'jumlah_orang_kerja' => $request->jumlah_orang_kerja,
            'luas_tanah' => $request->luas_tanah,
            'alamat' => $request->alamat,
            'rt' => $request->rt,
            'rw' => $request->rw,
            'kelurahan' => $request->kelurahan,
            'kecamatan' => $request->kecamatan,
            'kota' => $request->kota,
            'foto_kk' => $nama_file // simpan nama file gambar ke dalam database
        ]);

        // Simpan detail keluarga
        foreach ($request->id_penduduk as $key => $pendudukid) {
            detail_keluarga_model::create([
                'id_keluarga' => $keluarga->id, // gunakan id keluarga yang baru disimpan
                'id_penduduk' => $pendudukid, // gunakan id penduduk yang dipilih
                'peran_keluarga' => $request->peran_keluarga[$key] // gunakan peran keluarga yang sesuai
            ]);
        }

        return redirect('/keluarga')->with('success', 'Data keluarga berhasil disimpan');
    }
    public function show(string $id)
    {
        $keluarga = KeluargaModel::find($id);

        if (!$keluarga) {
            return redirect('/keluarga')->with('error', 'Data keluarga tidak ditemukan');
        }

        // Anda bisa menambahkan logika untuk menampilkan detail anggota keluarga di sini
        $detail_keluarga = detail_keluarga_model::where('id_keluarga', $id)->whereIn('peran_keluarga', ['Kepala Keluarga', 'Istri', 'Anggota Keluarga'])->get();
        $kepala_keluarga = $detail_keluarga->where('peran_keluarga', 'Kepala Keluarga');
        $istri = $detail_keluarga->where('peran_keluarga', 'Istri');
        $anggota = $detail_keluarga->where('peran_keluarga', 'Anggota Keluarga');
        $breadcrumb = (object) [
            'title' => 'Detail Keluarga Penduduk',
            'list' => ['Home', 'Keluarga Penduduk', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail data keluarga '
        ];

        $activeMenu = 'keluarga';

        return view('admin.keluarga.show', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'keluarga' => $keluarga,
            'detail_keluarga' => $detail_keluarga,
            'kepala_keluarga' => $kepala_keluarga,
            'istri' => $istri,
            'anggota' => $anggota,
            'activeMenu' => $activeMenu
        ]);
    }

    public function edit(string $id)
    {
        $keluarga = KeluargaModel::find($id);

        if (!$keluarga) {
            return redirect('/keluarga')->with('error', 'Data keluarga tidak ditemukan');
        }

        $breadcrumb = (object) [
            'title' => 'Edit Keluarga Penduduk',
            'list' => ['Home', 'Keluarga Penduduk', 'Edit']
        ];

        $page = (object) [
            'title' => 'Ubah data keluarga'
        ];

        $activeMenu = 'keluarga'; // set menu yang sedang aktif
        $penduduk = PendudukModel::all();
        return view('admin.keluarga.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'keluarga' => $keluarga, 'penduduk' => $penduduk, 'activeMenu' => $activeMenu]);
    }
    // menyimpan perubahan data barang
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nomor_keluarga' => 'required|string|min:10|max:10',
            'jumlah_kendaraan' => 'required|integer',
            'jumlah_tanggungan' => 'required|integer',
            'jumlah_orang_kerja' => 'required|integer',
            'luas_tanah' => 'required|integer',
            'alamat' => 'required|string',
            'rt' => 'required|integer',
            'rw' => 'required|integer',
            'kelurahan' => 'required|string',
            'kecamatan' => 'required|string',
            'kota' => 'required|string',
            'foto_kk' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $keluarga = KeluargaModel::find($id);

        // Cek apakah ada file gambar yang diunggah
        if ($request->hasFile('foto_kk')) {
            // menyimpan data foto kk yang diupload ke variabel foto_kk
            $foto_kk = $request->file('foto_kk');

            $nama_file = time() . "_" . $foto_kk->getClientOriginalName();

            // isi dengan nama folder tempat kemana file diupload
            $tujuan_upload = 'data_kk';
            $foto_kk->move($tujuan_upload, $nama_file);

            // Hapus foto kk lama jika ada
            if ($keluarga->foto_kk) {
                $path_foto_ktp_lama = public_path('data_kk/' . $keluarga->foto_kk);
                if (file_exists($path_foto_ktp_lama)) {
                    unlink($path_foto_ktp_lama);
                }
            }

            // Update data keluarga beserta foto kk baru
            $keluarga->update([
                'nomor_keluarga' => $request->nomor_keluarga,
                'jumlah_kendaraan' => $request->jumlah_kendaraan,
                'jumlah_tanggungan' => $request->jumlah_tanggungan,
                'jumlah_orang_kerja' => $request->jumlah_orang_kerja,
                'luas_tanah' => $request->luas_tanah,
                'alamat' => $request->alamat,
                'rt' => $request->rt,
                'rw' => $request->rw,
                'kelurahan' => $request->kelurahan,
                'kecamatan' => $request->kecamatan,
                'kota' => $request->kota,
                'foto_kk' => $nama_file // simpan nama file gambar ke dalam database
            ]);
        } else {
            // Update data keluarga tanpa mengubah foto kk
            $keluarga->update([
                'nomor_keluarga' => $request->nomor_keluarga,
                'jumlah_kendaraan' => $request->jumlah_kendaraan,
                'jumlah_tanggungan' => $request->jumlah_tanggungan,
                'jumlah_orang_kerja' => $request->jumlah_orang_kerja,
                'luas_tanah' => $request->luas_tanah,
                'alamat' => $request->alamat,
                'rt' => $request->rt,
                'rw' => $request->rw,
                'kelurahan' => $request->kelurahan,
                'kecamatan' => $request->kecamatan,
                'kota' => $request->kota,
            ]);
        }

        // Perbarui detail keluarga
        detail_keluarga_model::where('id_keluarga', $id)->delete(); // hapus detail keluarga yang ada
        foreach ($request->id_penduduk as $key => $pendudukid) {
            detail_keluarga_model::create([
                'id_keluarga' => $id,
                'id_penduduk' => $pendudukid,
                'peran_keluarga' => $request->peran_keluarga[$key]
            ]);
        }

        return redirect('/keluarga/' . $id . '/show')->with('success', 'Data keluarga berhasil diubah');
    }
    // Bagian Controller Anggota
    public function createAnggota()
    {
        $breadcrumb = (object)[
            'title' => 'Tambah Anggota Penduduk',
            'list' => ['Home', 'Keluarga Penduduk', 'Tambah']
        ];

        $page = (object)[
            'title' => 'Tambah Data Anggota Keluarga'
        ];

        $keluarga = KeluargaModel::all(); // ambil data keluar$keluarga untuk ditampilkan di form
        $penduduk = PendudukModel::all(); // ambil data penduduk untuk ditampilkan di form
        $activeMenu = 'keluarga'; // set menu yang sedang aktif

        return view('admin.keluarga.create_anggota', ['breadcrumb' => $breadcrumb, 'page' => $page, 'keluarga' => $keluarga, 'penduduk' => $penduduk, 'activeMenu' => $activeMenu]);
    }

    public function storeAnggota(Request $request)
    {
        $request->validate([
            // Atur validasi sesuai dengan kebutuhan Anda
        ]);

        // Simpan data anggota keluarga ke dalam database
        detail_keluarga_model::create([
            // Sesuaikan atribut-atribut yang disimpan dengan atribut yang ada pada model Anda
        ]);

        return redirect('/keluarga')->with('success', 'Anggota keluarga berhasil ditambahkan');
    }
}
