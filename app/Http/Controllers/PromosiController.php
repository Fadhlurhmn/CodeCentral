<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PendudukModel;
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

        // Fitur search
        $promosiQuery = PromosiModel::query();
        if ($request->has('query')) {
            $promosiQuery->where('nama_usaha', 'like', '%' . $request->query('query') . '%');
        }

        // Fitur filter kategori
        if ($request->has('kategori') && $request->kategori != 'Semua') {
            $promosiQuery->where('kategori', $request->kategori);
        }

        // Filter status pengajuan dan countdown
        $promosiQuery->where('status_pengajuan', 'Terima');
        // ->orWhere('status_pengajuan', 'Tolak');
        $promosiQuery->where('countdown', '>', now());

        // Ambil data promosi setelah filter
        $promosi = $promosiQuery->get();
        $activeMenu = 'promosi';

        $penduduk = PendudukModel::all();

        return view('admin.promosi.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'promosi' => $promosi,
            'penduduk' => $penduduk,
            'activeMenu' => $activeMenu,
            'kategori' => $request->kategori ?? 'Semua'
        ]);
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

        // Fitur search dan filter
        $promosiQuery = PromosiModel::query();
        if ($request->has('query')) {
            $promosiQuery->where('nama_usaha', 'like', '%' . $request->query('query') . '%');
        }

        // Fitur filter kategori
        if ($request->has('kategori') && $request->kategori != 'Semua') {
            $promosiQuery->where('kategori', $request->kategori);
        }

        $promosiQuery->where('status_pengajuan', '=', 'Menunggu');

        // Ambil data promosi setelah filter
        $promosi = $promosiQuery->get();

        $activeMenu = 'promosi';
        $penduduk = PendudukModel::all();

        return view('admin.promosi.daftar', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'promosi' => $promosi,
            'penduduk' => $penduduk,
            'activeMenu' => $activeMenu,
            'kategori' => $request->kategori ?? 'Semua'
        ]);
    }

    public function list(Request $request)
    {
        $promosi = PromosiModel::select('id_umkm', 'nama_usaha', 'gambar', 'deskripsi', 'status_pengajuan', 'alamat', 'countdown', 'id_penduduk')
            ->with('penduduk');

        if ($request->penduduk_id) {
            $promosi->where('id_penduduk', $request->penduduk_id);
        }

        // Filter berdasarkan usaha per penduduk
        if ($request->has('id_penduduk')) {
            $promosi->where('id_penduduk', $request->id_penduduk);
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

        $penduduk = PendudukModel::all(); // ambil data penduduk untuk ditampilkan di form
        $activeMenu = 'promosi'; // set menu yang sedang aktif

        return view('admin.promosi.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'penduduk' => $penduduk, 'activeMenu' => $activeMenu]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_usaha' => 'required|string',
            'deskripsi' => 'required|string',
            'status_pengajuan' => 'required|string',
            'alamat' => 'required|string',
            'countdown' => 'required|string',
            'id_penduduk' => 'required|integer',
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
            'id_penduduk' => $request->id_penduduk,
            'gambar' => $nama_file // simpan nama file gambar ke dalam database
        ]);


        return redirect('/promosi')->with('success', 'Data promosi berhasil disimpan');
    }

    public function show(string $id)
    {
        $promosi = PromosiModel::with('penduduk')->find($id);
        $nik = $promosi->penduduk->nik;

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

        return view('admin.promosi.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'nik' => $nik, 'promosi' => $promosi, 'activeMenu' => $activeMenu]);
    }

    public function edit(string $id)
    {
        $promosi = PromosiModel::find($id);
        $penduduk = PendudukModel::all();

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

        return view('admin.promosi.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'promosi' => $promosi, 'penduduk' => $penduduk, 'activeMenu' => $activeMenu]);
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
            'id_penduduk' => 'required|integer',
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
                'id_penduduk' => $request->id_penduduk,
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
                'id_penduduk' => $request->id_penduduk,
            ]);
        }

        return redirect('/promosi/' . $id . '/show')->with('success', 'Data promosi berhasil diubah');
    }

    public function destroy(string $id)
    {
        $promosi = PromosiModel::find($id);
        if ($promosi) {
            $promosi->delete();
            return redirect('/admin/promosi')->with('success', 'Promosi berhasil dihapus');
        } else {
            return redirect('/admin/promosi')->with('error', 'Promosi tidak ditemukan');
        }
    }


    public function updateStatus(Request $request, string $id)
    {
        $request->validate([
            'status_pengajuan' => 'required|string|in:Terima,Tolak' // Validasi status_pengajuan
        ]);

        $promosi = PromosiModel::find($id);

        $updateData = [
            'status_pengajuan' => $request->status_pengajuan
        ];

        if ($request->status_pengajuan === 'Terima') {
            $updateData['countdown'] = now()->addDays(14);
        }

        $promosi->update($updateData);

        $message = $request->status_pengajuan === 'Terima' ? 'Promosi berhasil diterima' : 'Promosi berhasil ditolak';

        return redirect('admin/promosi/' . $id . '/show')->with('success', $message);
    }
}
