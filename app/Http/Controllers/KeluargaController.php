<?php

namespace App\Http\Controllers;

use App\Models\detail_keluarga_model;
use App\Models\KeluargaModel;
use App\Models\PendudukModel;
use App\Models\rangkuman_keluarga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class KeluargaController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Keluarga Penduduk',
            'list' => [
                ['name' => 'Home', 'url' => url('/admin')],
                ['name' => 'Keluarga', 'url' => url('admin/keluarga')],
            ]
        ];

        $page = (object)[
            'title' => 'Daftar Keluarga Keluarga Penduduk yang terdaftar'
        ];

        $activeMenu = 'keluarga';

        return view('admin.keluarga.keluarga', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    public function list(Request $request)
    {
        $keluarga = KeluargaModel::select('id_keluarga', 'nomor_keluarga', 'jumlah_kendaraan', 'jumlah_tanggungan', 'jumlah_orang_kerja');

        return DataTables::of($keluarga)
            ->addIndexColumn()
            ->addColumn('aksi', function ($keluarga) {
                $btn = '<a href="' . url('admin/keluarga/' . $keluarga->id_keluarga . '/show') . '" class="btn btn-primary ml-1 flex-col "><i class="fas fa-info-circle"></i></a> ';

                // Periksa apakah detail keluarga ada untuk keluarga saat ini
                $detailKeluarga = detail_keluarga_model::where('id_keluarga', $keluarga->id_keluarga)->first();

                // Jika detail keluarga ditemukan
                if ($detailKeluarga) {
                    $btn .= '<a href="' . url('admin/keluarga/' . $keluarga->id_keluarga . '/edit') . '" class="btn btn-info ml-2 mr-2 flex-col"><i class="fas fa-edit"></i></a> ';
                } else {
                    $btn .= '<a href="' . url('admin/keluarga/' . $keluarga->id_keluarga . '/create_anggota') . '" class="btn btn-primary ml-2 mr-2 flex-col"><i class="fas fa-user-plus"></i></a> ';
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
            'list' => [
                ['name' => 'Home', 'url' => url('/admin')],
                ['name' => 'Keluarga', 'url' => url('admin/keluarga')],
                ['name' => 'Tambah Data', 'url' => url('admin/keluarga/create')],
            ]
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
            // 'rt' => 'required|integer',
            // 'rw' => 'required|integer',
            'foto_kk' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'jumlah_tanggungan' => 'required|integer',
            'jumlah_orang_kerja' => 'required|integer',
        ]);
        $foto_kk = $request->file('foto_kk')->store('data_kk', 'public');

        // // Menyimpan data foto KK yang diupload ke variabel foto_kk
        // $foto_kk = $request->file('foto_kk');
        // $nama_file = time() . "_" . $foto_kk->getClientOriginalName();

        // // Isi dengan nama folder tempat kemana file diupload
        // $tujuan_upload = 'data_kk';
        // $foto_kk->move($tujuan_upload, $nama_file);

        // Simpan data keluarga dan ambil objek yang baru saja disimpan
        KeluargaModel::create([
            'nomor_keluarga' => $request->nomor_keluarga,
            'jumlah_kendaraan' => $request->jumlah_kendaraan,
            // 'rt' => $request->rt,
            // 'rw' => $request->rw,
            'jumlah_tanggungan' => $request->jumlah_tanggungan,
            'jumlah_orang_kerja' => $request->jumlah_orang_kerja,
            'foto_kk' => $foto_kk,
        ]);

        $keluarga = KeluargaModel::where('nomor_keluarga', $request->nomor_keluarga)->first();

        // Redirect ke halaman create_anggota dengan pesan sukses
        return redirect('admin/keluarga/' . $keluarga->id_keluarga . '/create_anggota')->with('success', 'Data keluarga berhasil disimpan');
    }


    // form untuk tabel detail keluarga
    public function createAnggota($id)
    {
        $keluarga = $id; // ambil id keluarga
        // $breadcrumb = (object)[
        //     'title' => 'Anggota Keluarga',
        //     'list' => ['Home', 'Anggota Keluarga', 'Tambah']
        // ];
        $breadcrumb = (object) [
            'title' => 'Anggota Keluarga',
            'list' => [
                ['name' => 'Home', 'url' => url('/admin')],
                ['name' => 'Keluarga', 'url' => url('admin/keluarga')],
                ['name' => 'Tambah Anggota Keluarga', 'url' => url('admin/keluarga/create_anggota')],
            ]
        ];

        $page = (object)[
            'title' => 'Anggota Keluarga'
        ];

        // Ambil data jumlah orang bekerja dan tanggungan dari database
        $jumlahOrangBekerja = KeluargaModel::where('id_keluarga', $id)->sum('jumlah_orang_kerja');
        $jumlahTanggungan = KeluargaModel::where('id_keluarga', $id)->sum('jumlah_tanggungan');

        // Hitung total jumlah orang dari kedua kategori tersebut
        $totalOrang = $jumlahOrangBekerja + $jumlahTanggungan;

        $penduduk = PendudukModel::all(); // ambil data penduduk untuk ditampilkan di form
        $activeMenu = 'detail_keluarga'; // set menu yang sedang aktif

        return view('admin.keluarga.create_anggota', ['breadcrumb' => $breadcrumb, 'page' => $page, 'penduduk' => $penduduk, 'keluarga' => $keluarga, 'activeMenu' => $activeMenu], compact('totalOrang'));
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

        // Menghapus data lama berdasarkan id_keluarga
        detail_keluarga_model::where('id_keluarga', $request->id_keluarga)->delete();

        // Loop through each submitted data to store the family members
        foreach ($request->id_penduduk as $key => $pendudukId) {
            // Store the family member
            detail_keluarga_model::create([
                'id_penduduk' => $pendudukId,
                'peran_keluarga' => $request->peran_keluarga[$key],
                'id_keluarga' => $request->id_keluarga
            ]);
        }

        return redirect('admin/keluarga/')->with('success', 'Data detail anggota berhasil disimpan');
    }


    public function show(string $id)
    {
        $keluarga = KeluargaModel::find($id);

        if (!$keluarga) {
            return redirect('admin/keluarga')->with('error', 'Data keluarga tidak ditemukan');
        }

        // Anda bisa menambahkan logika untuk menampilkan detail anggota keluarga di sini
        $detail_keluarga = detail_keluarga_model::where('id_keluarga', $id)->whereIn('peran_keluarga', ['Kepala Keluarga', 'Istri', 'Anggota Keluarga'])->get();
        $kepala_keluarga = $detail_keluarga->where('peran_keluarga', 'Kepala Keluarga');
        $istri = $detail_keluarga->where('peran_keluarga', 'Istri');
        $anggota = $detail_keluarga->where('peran_keluarga', 'Anggota Keluarga');
        
        $breadcrumb = (object)[
            'title' => 'Detail Keluarga Penduduk',
            'list' => [
                ['name' => 'Home', 'url' => url('/admin')],
                ['name' => 'Keluarga', 'url' => url('admin/keluarga')],
                ['name' => 'Detail', 'url' => url('admin/keluarga/show')],
            ]
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
            return redirect('admin/keluarga')->with('error', 'Data keluarga tidak ditemukan');
        }

        $breadcrumb = (object)[
            'title' => 'Tambah Keluarga Penduduk',
            'list' => [
                ['name' => 'Home', 'url' => url('/admin')],
                ['name' => 'Keluarga', 'url' => url('admin/keluarga')],
                ['name' => 'Edit', 'url' => url('admin/keluarga/edit')],
            ]
        ];

        $page = (object) [
            'title' => 'Ubah data keluarga'
        ];

        $activeMenu = 'keluarga'; // set menu yang sedang aktif
        return view('admin.keluarga.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'keluarga' => $keluarga, 'activeMenu' => $activeMenu]);
    }

    // menyimpan perubahan data keluarga
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nomor_keluarga' => 'required|integer|digits:16',
            'jumlah_kendaraan' => 'required|integer',
            // 'rt' => 'required|integer',
            // 'rw' => 'required|integer',
            'jumlah_tanggungan' => 'required|integer',
            'jumlah_orang_kerja' => 'required|integer',
            // 'foto_kk' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $keluarga = KeluargaModel::find($id);

        if (!$keluarga) {
            return redirect('admin/keluarga')->with('error', 'Data keluarga tidak ditemukan');
        }

        // Menyimpan data foto KK yang diupload ke variabel foto_kk
        // $foto_kk = $request->file('foto_kk');
        // $nama_file = time() . "_" . $foto_kk->getClientOriginalName();

        // // Isi dengan nama folder tempat kemana file diupload
        // $tujuan_upload = 'data_kk';
        // $foto_kk->move($tujuan_upload, $nama_file);

        $data = [
            'nomor_keluarga' => $request->nomor_keluarga,
            'jumlah_kendaraan' => $request->jumlah_kendaraan,
            // 'rt' => $request->rt,
            // 'rw' => $request->rw,
            'jumlah_tanggungan' => $request->jumlah_tanggungan,
            'jumlah_orang_kerja' => $request->jumlah_orang_kerja,
            // 'foto_kk' => $nama_file
        ];

        // Cek apakah ada file gambar yang diunggah
        if ($request->hasFile('foto_kk')) {
            $request->validate([
                'foto_kk' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            // $foto_kk = $request->file('foto_kk');
            // $nama_file_baru = time() . "_" . $foto_kk->getClientOriginalName();
            // $tujuan_upload = 'data_kk';
            // $foto_kk->move($tujuan_upload, $nama_file_baru);

            $foto_kk = $request->file('foto_kk')->store('data_kk', 'public');


            // // Hapus foto KK lama jika ada
            // if ($keluarga->foto_kk) {
            //     unlink(public_path('data_kk/' . $keluarga->foto_kk));
            // }

            $data['foto_kk'] = $foto_kk;
        }

        $keluarga->update($data);

        return redirect('admin/keluarga/' . $keluarga->id_keluarga . '/create_anggota')->with('success', 'Data keluarga berhasil disimpan');
    }

    // controller rw
    public function index_rw()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Keluarga Penduduk',
            'list' => [
                ['name' => 'Home', 'url' => url('/rw')],
                ['name' => 'Keluarga', 'url' => url('rw/keluarga')]
            ]
        ];

        $page = (object)[
            'title' => 'Daftar Keluarga Keluarga Penduduk yang terdaftar'
        ];

        $activeMenu = 'keluarga';

        return view('rw.keluarga.keluarga', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    public function list_rw(Request $request)
    {
        $keluarga = KeluargaModel::select('id_keluarga', 'nomor_keluarga', 'jumlah_kendaraan', 'jumlah_tanggungan', 'jumlah_orang_kerja');
        if ($request->has('rt')) {
            $keluarga->where('rt', $request->rt);
        }
        // return DataTables::of($keluarga)

        $query = rangkuman_keluarga::query();

        if ($request->has('rt') && $request->rt !== 'all') {
            $query->where('rt', $request->rt);
        }

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('aksi', function ($keluarga) {
                $btn = '<a href="' . url('rw/keluarga/' . $keluarga->id_keluarga . '/show') . '" class="btn btn-primary ml-1 flex-col ">Detail   <i class="fas fa-info-circle"></i></a> ';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function show_rw(string $id)
    {
        $keluarga = KeluargaModel::find($id);

        if (!$keluarga) {
            return redirect('rw/keluarga')->with('error', 'Data keluarga tidak ditemukan');
        }

        // Anda bisa menambahkan logika untuk menampilkan detail anggota keluarga di sini
        $detail_keluarga = detail_keluarga_model::where('id_keluarga', $id)->whereIn('peran_keluarga', ['Kepala Keluarga', 'Istri', 'Anggota Keluarga'])->get();
        $kepala_keluarga = $detail_keluarga->where('peran_keluarga', 'Kepala Keluarga');
        $istri = $detail_keluarga->where('peran_keluarga', 'Istri');
        $anggota = $detail_keluarga->where('peran_keluarga', 'Anggota Keluarga');

        $breadcrumb = (object) [
            'title' => 'Daftar Keluarga Penduduk',
            'list' => [
                ['name' => 'Home', 'url' => url('/rw')],
                ['name' => 'Keluarga', 'url' => url('rw/keluarga')],
                ['name' => 'Detail', 'url' => url('rw/keluarga/show')],
            ]
        ];

        $page = (object) [
            'title' => 'Detail data keluarga '
        ];

        $activeMenu = 'keluarga';

        return view('rw.keluarga.show', [
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


    // controller untuk rt
    public function index_rt()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Keluarga Penduduk',
            'list' => [
                ['name' => 'Home', 'url' => url('/rt')],
                ['name' => 'Keluarga', 'url' => url('rt/keluarga')],
            ]
        ];

        $page = (object)[
            'title' => 'Daftar Keluarga Keluarga Penduduk yang terdaftar'
        ];

        $activeMenu = 'keluarga';

        return view('rt.keluarga.keluarga', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    public function list_rt(Request $request)
    {
        // Get logged in user
        $user = Auth::user();

        // Get id_penduduk from logged in user
        $id_penduduk_rt = $user->id_penduduk;

        // Find RT of logged in user
        $rt_penduduk = PendudukModel::select('rt')
            ->where('id_penduduk', $id_penduduk_rt)
            ->first();

        $keluarga = rangkuman_keluarga::where('rt', $rt_penduduk->rt);

        return DataTables::of($keluarga)
            ->addIndexColumn()
            ->addColumn('aksi', function ($keluarga) {
                $btn = '<a href="' . url('rt/keluarga/' . $keluarga->id_keluarga . '/show') . '" class="btn btn-primary ml-1 flex-col "><i class="fas fa-info-circle"></i></a> ';

                $detailKeluarga = detail_keluarga_model::where('id_keluarga', $keluarga->id_keluarga)->first();

                if ($detailKeluarga) {
                    $btn .= '<a href="' . url('rt/keluarga/' . $keluarga->id_keluarga . '/edit') . '" class="btn btn-info ml-2 mr-2 flex-col"><i class="fas fa-edit"></i></a> ';
                } else {
                    $btn .= '<a href="' . url('rt/keluarga/' . $keluarga->id_keluarga . '/create_anggota') . '" class="btn btn-primary ml-2 mr-2 flex-col"><i class="fas fa-user-plus"></i></a> ';
                }

                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    // form untuk tabel keluarga
    public function create_rt()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Data Keluarga',
            'list' => [
                ['name' => 'Home', 'url' => url('/rt')],
                ['name' => 'Keluarga', 'url' => url('rt/keluarga')],
                ['name' => 'Tambah', 'url' => url('rt/keluarga/create')],
            ]
        ];

        $page = (object)[
            'title' => 'Tambah Data Keluarga'
        ];

        $penduduk = PendudukModel::all(); // ambil data penduduk untuk ditampilkan di form
        $activeMenu = 'keluarga'; // set menu yang sedang aktif

        return view('rt.keluarga.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'penduduk' => $penduduk, 'activeMenu' => $activeMenu]);
    }

    // store untuk tabel keluarga
    public function store_rt(Request $request)
    {
        $request->validate([
            'nomor_keluarga' => 'required|integer|digits:16',
            'jumlah_kendaraan' => 'required|integer',
            'foto_kk' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'jumlah_tanggungan' => 'required|integer',
            'jumlah_orang_kerja' => 'required|integer',
        ]);
        $foto_kk = $request->file('foto_kk')->store('data_kk', 'public');

        // // Menyimpan data foto KK yang diupload ke variabel foto_kk
        // $foto_kk = $request->file('foto_kk');
        // $nama_file = time() . "_" . $foto_kk->getClientOriginalName();

        // // Isi dengan nama folder tempat kemana file diupload
        // $tujuan_upload = 'data_kk';
        // $foto_kk->move($tujuan_upload, $nama_file);

        // Simpan data keluarga dan ambil objek yang baru saja disimpan
        KeluargaModel::create([
            'nomor_keluarga' => $request->nomor_keluarga,
            'jumlah_kendaraan' => $request->jumlah_kendaraan,
            'jumlah_tanggungan' => $request->jumlah_tanggungan,
            'jumlah_orang_kerja' => $request->jumlah_orang_kerja,
            'foto_kk' => $foto_kk,
        ]);

        $keluarga = KeluargaModel::where('nomor_keluarga', $request->nomor_keluarga)->first();

        // Redirect ke halaman create_anggota dengan pesan sukses
        return redirect('rt/keluarga/' . $keluarga->id_keluarga . '/create_anggota')->with('success', 'Data keluarga berhasil disimpan');
    }


    // form untuk tabel detail keluarga
    public function createAnggota_rt($id)
    {
        $keluarga = $id; // ambil id keluarga
        $breadcrumb = (object) [
            'title' => 'Anggota Keluarga',
            'list' => [
                ['name' => 'Home', 'url' => url('/rt')],
                ['name' => 'Keluarga', 'url' => url('rt/keluarga')],
                ['name' => 'Tambah Anggota', 'url' => url('rt/keluarga/create_anggota')],
            ]
        ];

        $page = (object)[
            'title' => 'Anggota Keluarga'
        ];

        // Ambil data jumlah orang bekerja dan tanggungan dari database
        $jumlahOrangBekerja = KeluargaModel::where('id_keluarga', $id)->sum('jumlah_orang_kerja');
        $jumlahTanggungan = KeluargaModel::where('id_keluarga', $id)->sum('jumlah_tanggungan');

        // Hitung total jumlah orang dari kedua kategori tersebut
        $totalOrang = $jumlahOrangBekerja + $jumlahTanggungan;

        $penduduk = PendudukModel::all(); // ambil data penduduk untuk ditampilkan di form
        $activeMenu = 'detail_keluarga'; // set menu yang sedang aktif

        return view('rt.keluarga.create_anggota', ['breadcrumb' => $breadcrumb, 'page' => $page, 'penduduk' => $penduduk, 'keluarga' => $keluarga, 'activeMenu' => $activeMenu], compact('totalOrang'));
    }

    // method untuk simpan data detail anggota di keluarga
    public function storeAnggota_rt(Request $request)
    {
        $request->validate([
            'id_keluarga' => 'required|integer',
            'id_penduduk' => 'required|array',
            'id_penduduk.*' => 'required|exists:penduduk,id_penduduk',
            'peran_keluarga' => 'required|array',
            'peran_keluarga.*' => 'required|string',
        ]);

        // Menghapus data lama berdasarkan id_keluarga
        detail_keluarga_model::where('id_keluarga', $request->id_keluarga)->delete();

        // Loop through each submitted data to store the family members
        foreach ($request->id_penduduk as $key => $pendudukId) {
            // Store the family member
            detail_keluarga_model::create([
                'id_penduduk' => $pendudukId,
                'peran_keluarga' => $request->peran_keluarga[$key],
                'id_keluarga' => $request->id_keluarga
            ]);
        }

        return redirect('rt/keluarga/')->with('success', 'Data detail anggota keluarga berhasil disimpan');
    }


    public function show_rt(string $id)
    {
        $keluarga = KeluargaModel::find($id);

        if (!$keluarga) {
            return redirect('rt/keluarga')->with('error', 'Data keluarga tidak ditemukan');
        }

        // Anda bisa menambahkan logika untuk menampilkan detail anggota keluarga di sini
        $detail_keluarga = detail_keluarga_model::where('id_keluarga', $id)->whereIn('peran_keluarga', ['Kepala Keluarga', 'Istri', 'Anggota Keluarga'])->get();
        $kepala_keluarga = $detail_keluarga->where('peran_keluarga', 'Kepala Keluarga');
        $istri = $detail_keluarga->where('peran_keluarga', 'Istri');
        $anggota = $detail_keluarga->where('peran_keluarga', 'Anggota Keluarga');

        $breadcrumb = (object) [
            'title' => 'Detail Data Keluarga',
            'list' => [
                ['name' => 'Home', 'url' => url('/rt')],
                ['name' => 'Keluarga', 'url' => url('rt/keluarga')],
                ['name' => 'Detail', 'url' => url('rt/keluarga/show')],
            ]
        ];

        $page = (object) [
            'title' => 'Detail data keluarga '
        ];

        $activeMenu = 'keluarga';

        return view('rt.keluarga.show', [
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

    public function edit_rt(string $id)
    {
        $keluarga = KeluargaModel::find($id);

        if (!$keluarga) {
            return redirect('rt/keluarga')->with('error', 'Data keluarga tidak ditemukan');
        }

        $breadcrumb = (object) [
            'title' => 'Ubah Data Keluarga',
            'list' => [
                ['name' => 'Home', 'url' => url('/rt')],
                ['name' => 'Keluarga', 'url' => url('rt/keluarga')],
                ['name' => 'Edit', 'url' => url('rt/keluarga/edit')],
            ]
        ];

        $page = (object) [
            'title' => 'Ubah data keluarga'
        ];

        $activeMenu = 'keluarga'; // set menu yang sedang aktif
        return view('rt.keluarga.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'keluarga' => $keluarga, 'activeMenu' => $activeMenu]);
    }

    // menyimpan perubahan data keluarga
    public function update_rt(Request $request, string $id)
    {
        $request->validate([
            'nomor_keluarga' => 'required|integer|digits:16',
            'jumlah_kendaraan' => 'required|integer',
            'jumlah_tanggungan' => 'required|integer',
            'jumlah_orang_kerja' => 'required|integer',
            // 'foto_kk' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $keluarga = KeluargaModel::find($id);

        if (!$keluarga) {
            return redirect('rt/keluarga')->with('error', 'Data keluarga tidak ditemukan');
        }

        // Menyimpan data foto KK yang diupload ke variabel foto_kk
        // $foto_kk = $request->file('foto_kk');
        // $nama_file = time() . "_" . $foto_kk->getClientOriginalName();

        // // Isi dengan nama folder tempat kemana file diupload
        // $tujuan_upload = 'data_kk';
        // $foto_kk->move($tujuan_upload, $nama_file);

        $data = [
            'nomor_keluarga' => $request->nomor_keluarga,
            'jumlah_kendaraan' => $request->jumlah_kendaraan,
            'jumlah_tanggungan' => $request->jumlah_tanggungan,
            'jumlah_orang_kerja' => $request->jumlah_orang_kerja,
            // 'foto_kk' => $nama_file
        ];

        // Cek apakah ada file gambar yang diunggah
        if ($request->hasFile('foto_kk')) {
            $request->validate([
                'foto_kk' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            // $foto_kk = $request->file('foto_kk');
            // $nama_file_baru = time() . "_" . $foto_kk->getClientOriginalName();
            // $tujuan_upload = 'data_kk';
            // $foto_kk->move($tujuan_upload, $nama_file_baru);

            $foto_kk = $request->file('foto_kk')->store('data_kk', 'public');


            // // Hapus foto KK lama jika ada
            // if ($keluarga->foto_kk) {
            //     unlink(public_path('data_kk/' . $keluarga->foto_kk));
            // }

            $data['foto_kk'] = $foto_kk;
        }

        $keluarga->update($data);

        return redirect('rt/keluarga/' . $keluarga->id_keluarga . '/create_anggota')->with('success', 'Data keluarga berhasil disimpan');
    }
}
