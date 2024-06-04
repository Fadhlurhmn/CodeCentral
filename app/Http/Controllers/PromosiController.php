<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KeluargaModel;
use App\Models\PromosiModel;
use Yajra\DataTables\Facades\DataTables;

class PromosiController extends Controller
{
    public function index(Request $request)
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Promosi',
            'list' => [
                ['name' => 'Home', 'url' => url('/admin')],
                ['name' => 'Promosi', 'url' => url('admin/promosi')],
            ]
        ];

        $page = (object)[
            'title' => 'Daftar promosi yang terdaftar'
        ];
        $promosi = PromosiModel::all();
        $promosi = PromosiModel::where('status_pengajuan', '!=', 'pending')->get();
        // Fitur search 
        $promosiQuery = PromosiModel::query();
        if ($request->has('query')) {
            $promosiQuery->where('nama_usaha', 'like', '%' . $request->query('query') . '%');
        }
        $promosiQuery->where('status_pengajuan', '!=', 'pending');
        // Ambil data promosi setelah filter
        $promosi = $promosiQuery->get();
        $activeMenu = 'promosi';

        $keluarga = KeluargaModel::all();

        return view('admin.promosi.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'promosi' => $promosi, 'keluarga' => $keluarga, 'activeMenu' => $activeMenu]);
    }
    public function daftar(Request $request)
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Permintaan Promosi',
            'list' => [
                ['name' => 'Home', 'url' => url('/admin')],
                ['name' => 'Promosi', 'url' => url('admin/promosi')],
                ['name' => 'Daftar', 'url' => url('admin/daftar')],
            ]
        ];

        $page = (object)[
            'title' => 'Daftar permintaan promosi usaha warga'
        ];

        $promosi = PromosiModel::all();
        $promosi = PromosiModel::where('status_pengajuan', 'pending')->get();
        $activeMenu = 'promosi';
        // Fitur search
        $promosiQuery = PromosiModel::query();
        if ($request->has('query')) {
            $promosiQuery->where('nama_usaha', 'like', '%' . $request->query('query') . '%');
        }
        $promosiQuery->where('status_pengajuan', '=', 'pending');
        // Ambil data promosi setelah filter
        $promosi = $promosiQuery->get();

        $keluarga = KeluargaModel::all();

        return view('admin.promosi.daftar', ['breadcrumb' => $breadcrumb, 'page' => $page, 'promosi' => $promosi, 'keluarga' => $keluarga, 'activeMenu' => $activeMenu]);
    }
    public function list(Request $request)
    {
        $promosi = PromosiModel::select('id_umkm', 'nama_usaha', 'gambar', 'deskripsi', 'status_pengajuan', 'alamat', 'countdown', 'id_keluarga')
            ->with('keluarga');

        if ($request->keluarga_id) {
            $promosi->where('id_keluarga', $request->keluarga_id);
        }

        // Filter berdasarkan usaha per keluarga 
        if ($request->has('id_keluarga')) {
            $promosi->where('id_keluarga', $request->id_keluarga);
        }
        return DataTables::of($promosi)
            ->addIndexColumn()
            ->addColumn('aksi', function ($promosi) {
                $btn = '<a href="' . url('/promosi/' . $promosi->id_umkm . '/show') . '" class="btn btn-primary ml-1 flex-col "><i class="fas fa-info-circle"></i></i></a> ';
                $btn .= '<a href="' . url('/promosi/' . $promosi->id_umkm . '/edit') . '" class="btn btn-info ml-2 mr-2 flex-col"><i class="fas fa-edit"></i></a> ';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Promosi',
            'list' => [
                ['name' => 'Home', 'url' => url('/admin')],
                ['name' => 'Promosi', 'url' => url('admin/promosi')],
                ['name' => 'Tambah', 'url' => url('admin/promosi/create')],
            ]
        ];

        $page = (object)[
            'title' => 'Tambah promosi baru'
        ];

        $keluarga = KeluargaModel::all(); // ambil data keluar$keluarga untuk ditampilkan di form
        $activeMenu = 'promosi'; // set menu yang sedang aktif

        return view('admin.promosi.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'keluarga' => $keluarga, 'activeMenu' => $activeMenu]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_usaha' => 'required|string',
            'deskripsi' => 'required|string',
            'status_pengajuan' => 'required|string',
            'alamat' => 'required|string',
            'countdown' => 'required|string',
            'id_keluarga' => 'required|integer',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        // menyimpan data foto ktp yang diupload ke variabel foto_usaha
        $foto_usaha = $request->file('foto_usaha');

        $nama_file = time() . "_" . $foto_usaha->getClientOriginalName();

        // isi dengan nama folder tempat kemana file diupload
        $tujuan_upload = 'data_usaha';
        $foto_usaha->move($tujuan_upload, $nama_file);

        PromosiModel::create([
            'nama_usaha' => $request->nama_usaha,
            'deskripsi' => $request->deskripsi,
            'status_pengajuan' => $request->status_pengajuan,
            'alamat' => $request->alamat,
            'countdown' => $request->countdown,
            'id_keluarga' => $request->id_keluarga,
            'gambar' => $nama_file // simpan nama file gambar ke dalam database
        ]);


        return redirect('/promosi')->with('success', 'Data promosi berhasil disimpan');
    }
    public function show(string $id)
    {
        $promosi = PromosiModel::with('keluarga')->find($id);
        $nomor_kk = $promosi->keluarga->nomor_keluarga;

        $breadcrumb = (object) [
            'title' => 'Detail Promosi',
            'list' => [
                ['name' => 'Home', 'url' => url('/admin')],
                ['name' => 'Promosi', 'url' => url('admin/promosi')],
                ['name' => 'Detail', 'url' => url('admin/promosi/show')],
            ]
        ];

        $page = (object)[
            'title' => 'Detail data promosi '
        ];

        $activeMenu = 'promosi'; // set menu yang sedang aktif

        return view('admin.promosi.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'nomor_kk' => $nomor_kk, 'promosi' => $promosi, 'activeMenu' => $activeMenu]);
    }
    public function edit(string $id)
    {
        $promosi = PromosiModel::find($id);
        $keluarga = KeluargaModel::all();

        $breadcrumb = (object) [
            'title' => 'Edit Promosi',
            'list' => [
                ['name' => 'Home', 'url' => url('/admin')],
                ['name' => 'Promosi', 'url' => url('admin/promosi')],
                ['name' => 'Edit', 'url' => url('admin/promosi/edit')],
            ]
        ];

        $page = (object) [
            'title' => 'Ubah data promosi'
        ];

        $activeMenu = 'promosi'; // set menu yang sedang aktif

        return view('admin.promosi.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'promosi' => $promosi, 'keluarga' => $keluarga, 'activeMenu' => $activeMenu]);
    }
    // menyimpan perubahan data barang
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_usaha' => 'required|string',
            'deskripsi' => 'required|string',
            'status_pengajuan' => 'required|string',
            'alamat' => 'required|string',
            'countdown' => 'required|string',
            'id_keluarga' => 'required|integer',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $promosi = PromosiModel::find($id);

        // Cek apakah ada file gambar yang diunggah
        if ($request->hasFile('foto_usaha')) {
            // Dapatkan nama file baru
            $foto_usaha = $request->file('foto_usaha');
            $nama_file_baru = time() . "_" . $foto_usaha->getClientOriginalName();

            // Simpan file baru
            $tujuan_upload = 'data_usaha';
            $foto_usaha->move($tujuan_upload, $nama_file_baru);

            // Update data promosi beserta foto ktp baru
            $promosi->update([
                'nama_usaha' => $request->nama_usaha,
                'gambar' => $request->gambar,
                'deskripsi' => $request->deskripsi,
                'status_pengajuan' => $request->status_pengajuan,
                'alamat' => $request->alamat,
                'countdown' => $request->countdown,
                'id_keluarga' => $request->id_keluarga,
                'gambar' => $nama_file_baru // Gunakan nama file baru
            ]);
        } else {
            // Update data promosi tanpa mengubah foto ktp
            $promosi->update([
                'nama_usaha' => $request->nama_usaha,
                'deskripsi' => $request->deskripsi,
                'status_pengajuan' => $request->status_pengajuan,
                'alamat' => $request->alamat,
                'countdown' => $request->countdown,
                'id_keluarga' => $request->id_keluarga,
            ]);
        }

        return redirect('/promosi/' . $id . '/show')->with('success', 'Data promosi berhasil diubah');
    }
    // acc promosi
    // public function acc_promosi(Request $request,string $id)
    // {
    //     $request->validate([
    //         'status_pengajuan' => 'required|string|in'
    //     ])
    //     PromosiModel::find($id)->update([
    //         'status_pengajuan' => 'acc'
    //     ]);

    //     return redirect('/promosi/' . $id . '/show')->with('success', 'Promosi berhasil di acc');
    // }
    // // tolak promosi
    // public function tolak_promosi(Request $request, string $id)
    // {
    //     PromosiModel::find($id)->update([
    //         'status_pengajuan' => 'tolak'
    //     ]);
    //     return redirect('/promosi/' . $id . '/show')->with('success', 'Promosi berhasil di tolak');
    // }

    public function updateStatus(Request $request, string $id)
    {
        $request->validate([
            'status_pengajuan' => 'required|string|in:acc,tolak' // Validasi status_pengajuan
        ]);

        $promosi = PromosiModel::find($id);

        $promosi->update([
            'status_pengajuan' => $request->status_pengajuan
        ]);

        $message = $request->status_pengajuan === 'acc' ? 'Promosi berhasil di acc' : 'Promosi berhasil ditolak';

        return redirect('admin/promosi/' . $id . '/show')->with('success', $message);
    }
}
