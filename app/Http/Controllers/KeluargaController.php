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

                // Periksa apakah detail keluarga ada untuk keluarga saat ini
                $detailKeluarga = detail_keluarga_model::where('id_keluarga', $keluarga->id_keluarga)->first();

                // Jika detail keluarga ditemukan
                if ($detailKeluarga) {
                    $btn .= '<a href="' . url('/keluarga/' . $keluarga->id_keluarga . '/edit') . '" class="btn btn-info ml-2 mr-2 flex-col"><i class="fas fa-edit"></i></a> ';
                } else {
                    $btn .= '<a href="' . url('/keluarga/' . $keluarga->id_keluarga . '/create_anggota') . '" class="btn btn-primary ml-2 mr-2 flex-col"><i class="fas fa-user-plus"></i></a> ';
                }

                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    // form untuk tabel keluarga
    public function create()
    {
        $breadcrumb = (object)[
            'title' => 'Tambah Keluarga Penduduk',
            'list' => ['Home', 'Keluarga Penduduk', 'Tambah']
        ];

        $page = (object)[
            'title' => 'Tambah Data Keluarga'
        ];

        $penduduk = PendudukModel::all(); // ambil data penduduk untuk ditampilkan di form
        $activeMenu = 'keluarga'; // set menu yang sedang aktif

        return view('admin.keluarga.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'penduduk' => $penduduk, 'activeMenu' => $activeMenu]);
    }

    // store untuk tabel keluarga
    public function store(Request $request)
    {
        $request->validate([
            'nomor_keluarga' => 'required|integer|digits:16',
            'jumlah_kendaraan' => 'required|integer',
            'alamat' => 'required|string',
            'kelurahan' => 'required|string',
            'kecamatan' => 'required|string',
            'kota' => 'required|string',
            'rt' => 'required|integer',
            'rw' => 'required|integer',
            'luas_tanah' => 'required|integer',
            'foto_kk' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:204',
            'jumlah_tanggungan' => 'required|integer',
            'jumlah_orang_kerja' => 'required|integer',
        ]);

        // menyimpan data foto kk yang diupload ke variabel foto_kk
        $foto_kk = $request->file('foto_kk');

        $nama_file = time() . "_" . $foto_kk->getClientOriginalName();

        // isi dengan nama folder tempat kemana file diupload
        $tujuan_upload = 'data_kk';
        $foto_kk->move($tujuan_upload, $nama_file);

        // Simpan data keluarga
        KeluargaModel::create([
            'nomor_keluarga' => $request->nomor_keluarga,
            'jumlah_kendaraan' => $request->jumlah_kendaraan,
            'alamat' => $request->alamat,
            'kelurahan' => $request->kelurahan,
            'kecamatan' => $request->kecamatan,
            'kota' => $request->kota,
            'luas_tanah' => $request->luas_tanah,
            'jumlah_tanggungan' => $request->jumlah_tanggungan,
            'jumlah_orang_kerja' => $request->jumlah_orang_kerja,
            'rt' => $request->rt,
            'rw' => $request->rw,
            'foto_kk' => $nama_file
        ]);
        // Redirect ke halaman daftar keluarga dengan pesan sukses
        return redirect('/keluarga')->with('success', 'Data keluarga berhasil disimpan');
    }

    // form untuk tabel detail keluarga
    public function createAnggota($id)
    {
        $keluarga = $id; // ambil id keluarga
        $breadcrumb = (object)[
            'title' => 'Tambah Anggota Keluarga',
            'list' => ['Home', 'Anggota Keluarga', 'Tambah']
        ];

        $page = (object)[
            'title' => 'Tambah Anggota Keluarga'
        ];

        $penduduk = PendudukModel::all(); // ambil data penduduk untuk ditampilkan di form
        $activeMenu = 'detail_keluarga'; // set menu yang sedang aktif

        return view('admin.keluarga.create_anggota', ['breadcrumb' => $breadcrumb, 'page' => $page, 'penduduk' => $penduduk, 'keluarga' => $keluarga, 'activeMenu' => $activeMenu]);
    }

    // method untuk simpan data detail anggota di keluarga
    public function storeAnggota(Request $request)
    {
        $request->validate([
            'id_keluarga' => 'required|integer',
            'id_penduduk' => 'required|array',
            'id_penduduk.*' => 'required|exists:penduduk,id_penduduk',
            'peran_keluarga' => 'required|array',
            'peran_keluarga.*' => 'required|string',
        ]);

        // Loop through each submitted data to store the family members
        foreach ($request->id_penduduk as $key => $pendudukId) {
            // Store the family member
            detail_keluarga_model::create([
                'id_penduduk' => $pendudukId,
                'peran_keluarga' => $request->peran_keluarga[$key],
                'id_keluarga' => $request->id_keluarga
            ]);
        }

        return redirect('/keluarga/' . $request->id_keluarga . '/show')->with('success', 'Data detail anggota berhasil disimpan');
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
            // Dapatkan nama file baru
            $foto_kk = $request->file('foto_kk');
            $nama_file_baru = time() . "_" . $foto_kk->getClientOriginalName();

            // Simpan file baru
            $tujuan_upload = 'data_ktp';
            $foto_kk->move($tujuan_upload, $nama_file_baru);

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
                'foto_kk' => $nama_file_baru // simpan nama file gambar ke dalam database
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
}
