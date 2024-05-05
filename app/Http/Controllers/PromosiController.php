<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KeluargaModel;
use App\Models\PromosiModel;
use Yajra\DataTables\Facades\DataTables;

class PromosiController extends Controller
{
    public function index()
    {
        $breadcrumb = (object)[
            'title' => 'Daftar Promosi',
            'list' => ['Home', 'Promosi']
        ];

        $page = (object)[
            'title' => 'Daftar promosi yang terdaftar'
        ];
        $promosi = PromosiModel::all();
        $promosi = PromosiModel::where('status_pengajuan', '!=', 'pending')->get();
        $activeMenu = 'promosi';

        $keluarga = KeluargaModel::all();

        return view('admin.promosi.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'promosi' => $promosi, 'keluarga' => $keluarga, 'activeMenu' => $activeMenu]);
    }
    public function daftar()
    {
        $breadcrumb = (object)[
            'title' => 'Daftar Permintaan Promosi',
            'list' => ['Home', 'Promosi']
        ];

        $page = (object)[
            'title' => 'Daftar permintaan promosi usaha warga'
        ];

        $promosi = PromosiModel::all();
        $promosi = PromosiModel::where('status_pengajuan', 'pending')->get();
        $activeMenu = 'promosi';

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
        $breadcrumb = (object)[
            'title' => 'Tambah Promosi',
            'list' => ['Home', 'Promosi', 'Tambah']
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
            'gambar' => 'required|string',
            'deskripsi' => 'required|string',
            'status_pengajuan' => 'required|string',
            'alamat' => 'required|string',
            'countdown' => 'required|string',
            'id_keluarga' => 'required|integer',
        ]);

        PromosiModel::create([
            'nama_usaha' => $request->nama_usaha,
            'gambar' => $request->gambar,
            'deskripsi' => $request->deskripsi,
            'status_pengajuan' => $request->status_pengajuan,
            'alamat' => $request->alamat,
            'countdown' => $request->countdown,
            'id_keluarga' => $request->id_keluarga,
        ]);

        return redirect('/promosi')->with('success', 'Data promosi berhasil disimpan');
    }
    public function show(string $id)
    {
        $promosi = PromosiModel::with('keluarga')->find($id);
        $nomor_kk = $promosi->keluarga->nomor_keluarga;

        $breadcrumb = (object)[
            'title' => 'Detail Promosi',
            'list' => ['Home', 'Promosi', 'Detail']
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
            'list' => ['Home', 'Promosi', 'Edit']
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
            'gambar' => 'required|string',
            'deskripsi' => 'required|string',
            'status_pengajuan' => 'required|string',
            'alamat' => 'required|string',
            'countdown' => 'required|string',
            'id_keluarga' => 'required|integer',
        ]);

        PromosiModel::find($id)->update([
            'nama_usaha' => $request->nama_usaha,
            'gambar' => $request->gambar,
            'deskripsi' => $request->deskripsi,
            'status_pengajuan' => $request->status_pengajuan,
            'alamat' => $request->alamat,
            'countdown' => $request->countdown,
            'id_keluarga' => $request->id_keluarga,
        ]);

        return redirect('/promosi/' . $id . '/show')->with('success', 'Data promosi berhasil diubah');
    }
    // acc promosi
    public function acc_promosi(string $id)
    {
        PromosiModel::find($id)->update([
            'status_pengajuan' => 'acc'
        ]);
    }
}
