<?php

namespace App\Http\Controllers;

use App\Models\ajuan_bansos_pending_per_rt;
use App\Models\alternatif_per_rt;
use App\Models\BansosModel;
use App\Models\detail_pertimbangan_acc_bansos;
use App\Models\detail_pertimbangan_bansos_per_rt;
use App\Models\DetailBansosModel;
use App\Models\histori_penerimaan_bansos;
use App\Models\kategori_bansos;
use App\Models\KriteriaBansosModel;
use App\Models\list_rekomendasi_bansos;
use App\Models\PendudukModel;
use App\Models\rekomendasi_per_rt;
use App\Models\pengajuan_bansos_acc_rt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class BansosController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $role = '';
        if ($user->id_level == 1) {
            $role = 'admin';
        } else if ($user->id_level == 2) {
            $role = 'rw';
        }
        $breadcrumb = (object) [
            'title' => 'Daftar Penerima Bantuan Sosial',
            'list' => [
                ['name' => 'Home', 'url' => url('/' . $role)],
                ['name' => 'Bantuan Sosial', 'url' => url($role . '/bansos')],
            ]
        ];

        $page = (object)[
            'title' => 'Daftar Penerima Bantuan Sosial'
        ];

        $activeMenu = 'bansos';

        $bansos = BansosModel::with('kategori_bansos')->get();

        $totalBansos = $bansos->count('id_bansos');

        $kriteriaExists = KriteriaBansosModel::count() > 0;


        $kategori_bansos = kategori_bansos::all();

        $total_ajuan_per_bansos = [];
        $keluarga_yang_mengajukan = 0; // Variabel untuk menyimpan total keseluruhan
        foreach ($bansos as $bansos2) {
            $jumlah_pending = DetailBansosModel::where('status', 'pending')
                ->where('id_bansos', $bansos2->id_bansos)
                ->distinct()
                ->count('id_keluarga');

            $total_ajuan_per_bansos[$bansos2->id_bansos] = $jumlah_pending;
            $keluarga_yang_mengajukan += $jumlah_pending; // Tambahkan jumlah pending ke total keseluruhan
        }

        // Sekarang $total_seluruhnya mengandung jumlah keseluruhan dari semua pending per bansos


        return view($role . '.bansos.bansos', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
            'bansos' => $bansos,
            'kategori_bansos' => $kategori_bansos,
            'totalBansos' => $totalBansos,
            'keluarga_yang_mengajukan' => $keluarga_yang_mengajukan,
            'total_ajuan_per_bansos' => $total_ajuan_per_bansos,
        ])->with('kriteriaExists', $kriteriaExists);
    }

    public function list(Request $request)
    {
        $user = Auth::user();
        $role = '';
        if ($user->id_level == 1) {
            $role = 'admin';
        } else if ($user->id_level == 2) {
            $role = 'rw';
        }

        $bansos = BansosModel::all();

        return DataTables::of($bansos)
            ->addIndexColumn()
            ->addColumn('aksi', function ($bansos) use ($role) {
                return '<a href="' . url($role . '/bansos/' . $bansos->id_bansos . '/show') . '">Detail</a>';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }


    public function show($id)
    {
        $user = Auth::user();
        $role = '';
        if ($user->id_level == 1) {
            $role = 'admin';
        } else if ($user->id_level == 2) {
            $role = 'rw';
        }
        $bansos = BansosModel::find($id);

        $bansos_acc = histori_penerimaan_bansos::where('id_bansos', $id)->get();

        $detail_bansos = DetailBansosModel::where('id_bansos', $id)->get();
        if (!$bansos) {
            return redirect('/' . $role . '/bansos')->with('error', 'Data Bantuan Sosial tidak ditemukan');
        }

        $breadcrumb = (object) [
            'title' => 'Detail Bantuan Sosial',
            'list' => [
                ['name' => 'Home', 'url' => url($role . '/')],
                ['name' => 'Bantuan Sosial', 'url' => url($role . '/bansos')],
                ['name' => 'Detail', 'url' => url($role . '/bansos/detail')],
            ]
        ];

        $page = (object) [
            'title' => 'Detail Bantuan Sosial'
        ];

        $activeMenu = 'bansos';

        return view($role . '.bansos.detail', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'detail_bansos' => $detail_bansos,
            'bansos' => $bansos,
            'bansos_acc' => $bansos_acc,
            'activeMenu' => $activeMenu
        ]);
    }

    // Implementasi fungsi-fungsi lainnya

    // Perlu dipastikan bahwa variabel $role sudah didefinisikan di setiap fungsi dengan benar.

    // Lanjutan BansosController

    public function daftar($id)
    {
        $user = Auth::user();
        $role = '';
        if ($user->id_level == 1) {
            $role = 'admin';
        } else if ($user->id_level == 2) {
            $role = 'rw';
        }
        $bansos = list_rekomendasi_bansos::where('id_bansos', $id)->get();
        if ($bansos->isEmpty()) {
            return redirect('/' . $role . '/bansos')->with('error', 'Data Bantuan Sosial tidak ditemukan');
        }

        $breadcrumb = (object) [
            'title' => 'Daftar Permintaan Bantuan Sosial',
            'list' => [
                ['name' => 'Home', 'url' => url($role . '/')],
                ['name' => 'Bantuan Sosial', 'url' => url($role . '/bansos')],
                ['name' => 'Daftar Permintaan', 'url' => url($role . '/bansos/daftar')],
            ]
        ];

        $page = (object) [
            'title' => 'Detail Bantuan Sosial'
        ];

        $activeMenu = 'bansos';

        return view($role . '.bansos.daftar', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'bansos' => $bansos,
            'activeMenu' => $activeMenu
        ]);
    }

    public function update_acc_bansos(Request $request, $id)
    {
        $user = Auth::user();
        $role = '';
        if ($user->id_level == 1) {
            $role = 'admin';
        } else if ($user->id_level == 2) {
            $role = 'rw';
        }

        // Mendapatkan jumlah penerima bansos
        $jumlah_penerima = BansosModel::select('jumlah_penerima')->where('id_bansos', $id)->first();

        // Memastikan setiap status yang dikirim sesuai dengan aturan validasi
        $request->validate([
            'status.*' => 'required|in:acc,tolak'
        ]);

        // Menghitung jumlah status "acc" yang dikirimkan
        $jumlah_acc = count(array_filter($request->status, function ($value) {
            return $value === 'acc';
        }));

        // Memeriksa apakah jumlah status "acc" sesuai dengan jumlah penerima bansos
        if ($jumlah_acc != $jumlah_penerima->jumlah_penerima) {
            return redirect()->back()->with('error', 'Jumlah pengajuan yang diterima harus sesuai dengan jumlah penerima bansos sebanyak ' . $jumlah_penerima->jumlah_penerima);
        }

        // Memperbarui status berdasarkan id_bansos dan id_keluarga
        foreach ($request->status as $id_keluarga => $status) {
            DetailBansosModel::where('id_bansos', $id)
                ->where('id_keluarga', $id_keluarga)
                ->update(['status' => $status]);
        }

        // Update BansosModel status to 'closed'
        $bansos = BansosModel::find($id);
        $bansos->status = 'closed';
        $bansos->save();

        return redirect('/' . $role . '/bansos/' . $id . '/show')->with('success', 'Data Penerima Bantuan Sosial Berhasil diperbarui');
    }


    public function create_bansos()
    {
        $user = Auth::user();
        $role = '';
        if ($user->id_level == 1) {
            $role = 'admin';
        } else if ($user->id_level == 2) {
            $role = 'rw';
        }
        $breadcrumb = (object) [
            'title' => 'Tambah Bantuan Sosial',
            'list' => [
                ['name' => 'Home', 'url' => url($role . '/')],
                ['name' => 'Bantuan Sosial', 'url' => url($role . '/bansos')],
                ['name' => 'Tambah Bantuan Sosial', 'url' => url($role . '/bansos/create')],
            ]
        ];

        $page = (object)[
            'title' => 'Tambah Bantuan Sosial'
        ];

        $kategori = kategori_bansos::all();

        $activeMenu = 'bansos';
        return view($role . '.bansos.create', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'kategori' => $kategori,
            'activeMenu' => $activeMenu
        ]);
    }

    public function store_bansos(Request $request)
    {
        $user = Auth::user();
        $role = '';
        if ($user->id_level == 1) {
            $role = 'admin';
        } else if ($user->id_level == 2) {
            $role = 'rw';
        }
        $request->validate([
            'nama_bansos' => 'required|string',
            'tanggal_bansos' => 'required|date',
            'id_kategori_bansos' => 'required|integer',
            'jumlah_penerima' => 'required|integer'
        ]);

        $bansos = new BansosModel();
        $bansos->nama = $request->nama_bansos;
        $bansos->tanggal_pemberian = $request->tanggal_bansos;
        $bansos->id_kategori_bansos = $request->id_kategori_bansos;
        $bansos->jumlah_penerima = $request->jumlah_penerima;
        $bansos->save();

        return redirect('/' . $role . '/bansos/')
            ->with('success', 'Data Bansos Berhasil Ditambahkan');
    }

    public function edit_bansos($id)
    {
        $user = Auth::user();
        $role = '';
        if ($user->id_level == 1) {
            $role = 'admin';
        } else if ($user->id_level == 2) {
            $role = 'rw';
        }
        $bansos = BansosModel::find($id);

        if (!$bansos) {
            return redirect('/' . $role . '/bansos')->with('error', 'Data Bantuan Sosial tidak ditemukan');
        }

        $breadcrumb = (object) [
            'title' => 'Edit Bantuan Sosial',
            'list' => [
                ['name' => 'Home', 'url' => url($role . '/')],
                ['name' => 'Bantuan Sosial', 'url' => url($role . '/bansos')],
                ['name' => 'Edit Bantuan Sosial', 'url' => url($role . '/bansos/edit')],
            ]
        ];

        $page = (object)[
            'title' => 'Bantuan Sosial'
        ];

        $kategori = kategori_bansos::all();

        $activeMenu = 'bansos';
        return view($role . '.bansos.edit', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'bansos' => $bansos,
            'kategori' => $kategori,
            'activeMenu' => $activeMenu
        ]);
    }

    public function update_bansos(Request $request, string $id)
    {
        $user = Auth::user();
        $role = '';
        if ($user->id_level == 1) {
            $role = 'admin';
        } else if ($user->id_level == 2) {
            $role = 'rw';
        }
        $request->validate([
            'nama_bansos' => 'required|string',
            'tanggal_bansos' => 'required|date',
            'id_kategori_bansos' => 'required|integer',
            'jumlah_penerima' => 'required|integer',
            'status' => 'required|string|in:open,closed',
        ]);

        $bansos = BansosModel::find($id);

        if ($bansos) {
            $bansos->nama = $request->nama_bansos;
            $bansos->tanggal_pemberian = $request->tanggal_bansos;
            $bansos->id_kategori_bansos = $request->id_kategori_bansos;
            $bansos->jumlah_penerima = $request->jumlah_penerima;
            $bansos->status = $request->status;
            $bansos->save();

            return redirect('/' . $role . '/bansos')->with('success', 'Data Bansos Berhasil diperbarui');
        } else {
            return redirect('/' . $role . '/bansos')->with('error', 'Data Bansos tidak ditemukan');
        }
    }

    public function delete_bansos($id)
    {
        $user = Auth::user();
        $role = '';
        if ($user->id_level == 1) {
            $role = 'admin';
        } else if ($user->id_level == 2) {
            $role = 'rw';
        }
        $bansos = BansosModel::find($id);

        if ($bansos) {
            $bansos->delete();

            return redirect('/' . $role . '/bansos')->with('success', 'Data Bansos Berhasil dihapus');
        } else {
            return redirect('/' . $role . '/bansos')->with('error', 'Data Bansos tidak ditemukan');
        }
    }

    // Implementasi fungsi-fungsi lainnya
    // Lanjutan BansosController

    public function show_kriteria($id_bansos, $id_keluarga)
    {
        $user = Auth::user();
        $role = '';
        if ($user->id_level == 1) {
            $role = 'admin';
        } else if ($user->id_level == 2) {
            $role = 'rw';
        }
        $histori_menerima = histori_penerimaan_bansos::where('id_keluarga', $id_keluarga)->get();
        // dd($histori_menerima);
        $detail = detail_pertimbangan_acc_bansos::where('id_keluarga', $id_keluarga)
            ->where('id_bansos', $id_bansos)
            ->get(); // Menggunakan get() untuk mengambil semua data yang cocok
        // dd($detail);
        $breadcrumb = (object) [
            'title' => 'Detail Keluarga Penerima Bantuan Sosial',
            'list' => [
                ['name' => 'Home', 'url' => url('/' . $role . '/')],
                ['name' => 'Bantuan Sosial', 'url' => url('/' . $role . '/bansos')],
                ['name' => 'Detail Bantuan Sosial', 'url' => url('/' . $role . '/bansos/detail_kriteria')],
            ]
        ];

        $page = (object) [
            'title' => 'Detail Keluarga Penerimaan Bantuan Sosial'
        ];

        $activeMenu = 'bansos';

        return view($role . '.bansos.detail_kriteria', [
            'histori_menerima' => $histori_menerima,
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'detail' => $detail,
            'activeMenu' => $activeMenu
        ]);
    }

    public function getHistoriData(Request $request)
    {
        $user = Auth::user();
        $role = '';
        if ($user->id_level == 1) {
            $role = 'admin';
        } else if ($user->id_level == 2) {
            $role = 'rw';
        }
        $bansos = BansosModel::select('id_bansos', 'nama');
        $query = histori_penerimaan_bansos::query();

        // Filter berdasarkan ID_Bansos jika ada
        if ($request->has('search') && !empty($request->search)) {
            $query->where('nomor_keluarga', 'like', '%' . $request->search . '%');
        }

        if ($request->has('id_bansos')) {
            $histori_bansos = histori_penerimaan_bansos::where('id_bansos', $request->id_bansos)->get();
        } else {
            $histori_bansos = histori_penerimaan_bansos::all();
        }

        return DataTables::of($histori_bansos)
            ->addIndexColumn()
            ->make(true);
    }

    public function cek_histori(Request $request)
    {
        $user = Auth::user();
        $role = '';
        if ($user->id_level == 1) {
            $role = 'admin';
        } else if ($user->id_level == 2) {
            $role = 'rw';
        }
        if ($request->has('id_bansos')) {
            $histori_bansos = histori_penerimaan_bansos::where('id_bansos', $request->id_bansos)->get();
        } else {
            $histori_bansos = histori_penerimaan_bansos::all();
        }

        $bansos = BansosModel::with('kategori_bansos')->get();
        $kategori_bansos = kategori_bansos::all();
        $breadcrumb = (object) [
            'title' => 'Histori Penerimaan Bantuan Sosial',
            'list' => [
                ['name' => 'Home', 'url' => url('/' . $role . '/')],
                ['name' => 'Bantuan Sosial', 'url' => url('/' . $role . '/bansos')],
                ['name' => 'Histori', 'url' => url('/' . $role . '/bansos/histori')],
            ]
        ];

        $page = (object) [
            'title' => 'Histori Penerimaan Bantuan Sosial'
        ];

        $activeMenu = 'bansos';

        return view($role . '.bansos.histori', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'histori_bansos' => $histori_bansos,
            'bansos' => $bansos,
            'kategori_bansos' => $kategori_bansos,
            'activeMenu' => $activeMenu
        ]);
    }

    // Implementasi fitur lainnya
    public function tampil_hitung($id)
    {
        $user = Auth::user();
        $role = '';
        if ($user->id_level == 1) {
            $role = 'admin';
        } else if ($user->id_level == 2) {
            $role = 'rw';
        }
        $breadcrumb = (object) [
            'title' => 'Perhitungan Rekomendasi Bantuan Sosial',
            'list' => [
                ['name' => 'Home', 'url' => url('/' . $role . '/')],
                ['name' => 'Bantuan Sosial', 'url' => url('/' . $role . '/bansos')],
                ['name' => 'Perhitungan', 'url' => url('/' . $role . '/bansos/histori')],
            ]
        ];

        $page = (object) [
            'title' => 'Perhitungan Rekomendasi Bantuan Sosial'
        ];

        $activeMenu = 'bansos';

        $alternatif = DB::select("SELECT * FROM alternatif WHERE id_bansos = ?", [$id]); // alternatif
        $normalisasi_bobot = DB::select('SELECT * FROM normalisasi_bobot_kriteria'); // normalisasi bobot
        $max_min_criteria = DB::select("SELECT * FROM max_min_kriteria_perbansos WHERE id_bansos = ?", [$id]); // nilai maksimal dan minimal per bansos
        $nilai_alternatif = DB::select("SELECT * FROM detail_pertimbangan_bansos WHERE id_bansos = ?", [$id]);  // mengambil nilai kriteria
        $nilai_utility = DB::select("SELECT * FROM nilai_utility_kriteria WHERE id_bansos = ?", [$id]); // mengambil nilai utility
        $nilai_akhir = DB::select("SELECT * FROM nilai_akhir_keluarga WHERE id_bansos = ?", [$id]); // mengambil nilai akhir keluarga
        $ranking_keluarga = DB::select("SELECT * FROM ranking_keluarga WHERE id_bansos = ?", [$id]); // mengambil nilai ranking keluarga
        $detail_kriteria = DB::select("SELECT * FROM detail_bansos WHERE id_bansos = ?", [$id]);
        $rekomendasi = DB::select("SELECT * FROM rekomendasi WHERE id_bansos = ?", [$id]);

        // dd($detail_kriteria);
        // dd($alternatif);
        // dd($max_min_criteria);
        // dd($nilai_utility);
        // dd($ranking_keluarga);
        // dd($rekomendasi);
        return view($role . '.bansos.tampil_hitung', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
            'alternatif' => $alternatif,
            'normalisasi_bobot' => $normalisasi_bobot,
            'max_min_criteria' => $max_min_criteria,
            'nilai_alternatif' => $nilai_alternatif,
            'nilai_utility' => $nilai_utility,
            'nilai_akhir' => $nilai_akhir,
            'ranking_keluarga' => $ranking_keluarga,
            'detail_kriteria' => $detail_kriteria,
            'rekomendasi' => $rekomendasi
        ]);
    }

    // kategori bansos
    public function indexKategori()
    {
        $user = Auth::user();
        $role = ($user->id_level == 1) ? 'admin' : 'rw';

        $breadcrumb = (object) [
            'title' => 'Daftar Kategori Bantuan Sosial',
            'list' => [
                ['name' => 'Home', 'url' => url('/' . $role)],
                ['name' => 'Kategori Bantuan Sosial', 'url' => url($role . '/kategori_bansos')],
            ]
        ];

        $page = (object)[
            'title' => 'Daftar Kategori Bantuan Sosial'
        ];

        $activeMenu = 'kategori_bansos';

        $kategori_bansos = kategori_bansos::all();

        return view($role . '.kategori_bansos.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
            'kategori_bansos' => $kategori_bansos
        ]);
    }

    // Method untuk menampilkan data kategori bansos dalam DataTables
    public function listKategori(Request $request)
    {
        $kategori_bansos = kategori_bansos::all();
        return DataTables::of($kategori_bansos)
            ->addIndexColumn()
            ->addColumn('aksi', function ($kategori_bansos) {
                return '<a href="' . url('admin/kategori_bansos/' . $kategori_bansos->id . '/edit') . '">Edit</a> | 
                        <form method="POST" action="' . url('admin/kategori_bansos/' . $kategori_bansos->id) . '" style="display:inline">
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '
                            <button type="submit" onclick="return confirm(\'Yakin ingin menghapus kategori ini?\')">Delete</button>
                        </form>';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    // Method untuk menampilkan form tambah kategori bansos
    public function createKategori()
    {
        $user = Auth::user();
        $role = ($user->id_level == 1) ? 'admin' : 'rw';

        $breadcrumb = (object) [
            'title' => 'Kategori Bantuan Sosial',
            'list' => [
                ['name' => 'Home', 'url' => url('/' . $role)],
                ['name' => 'Bantuan Sosial', 'url' => url($role . '/bansos')],
                ['name' => 'Ubah Kategori', 'url' => url($role . '/kategori_bansos/create')],
            ]
        ];

        $page = (object)[
            'title' => 'Tambah Kategori Bantuan Sosial'
        ];

        $bansos = BansosModel::all();
        $kategori = kategori_bansos::all();

        $activeMenu = 'kategori_bansos';

        return view($role . '.kategori_bansos.create', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'bansos' => $bansos,
            'kategori' => $kategori,
            'activeMenu' => $activeMenu
        ]);
    }

    // Method untuk menyimpan kategori bansos baru
    public function storeKategori(Request $request)
    {
        $user = Auth::user();
        $role = ($user->id_level == 1) ? 'admin' : 'rw';

        $request->validate([
            'nama_kategori' => 'required|array',
            'nama_kategori.*' => 'required|string',
            'bentuk_pemberian' => 'required|array',
            'bentuk_pemberian.*' => 'required|string',
            'pengirim' => 'required|array',
            'pengirim.*' => 'required|string',
            'id_kategori_bansos' => 'nullable|array',
            'id_kategori_bansos.*' => 'nullable|integer|exists:kategori_bansos,id_kategori_bansos'
        ]);

        $ids = $request->id_kategori_bansos;
        $names = $request->nama_kategori;
        $senders = $request->pengirim;
        $types = $request->bentuk_pemberian;

        for ($i = 0; $i < count($names); $i++) {
            if (!empty($ids[$i])) {
                // Update existing record
                $kategori = kategori_bansos::find($ids[$i]);
                if ($kategori) {
                    $kategori->nama_kategori = $names[$i];
                    $kategori->bentuk_pemberian = $types[$i];
                    $kategori->pengirim = $senders[$i];
                    $kategori->save();
                }
            } else {
                // Create new record
                kategori_bansos::create([
                    'nama_kategori' => $names[$i],
                    'bentuk_pemberian' => $types[$i],
                    'pengirim' => $senders[$i]
                ]);
            }
        }

        return redirect($role . '/bansos')
            ->with('success', 'Kategori Bantuan Sosial Berhasil Ditambahkan atau Diperbarui');
    }


    // Method untuk menampilkan form edit kategori bansos
    public function editKategori($id)
    {
        $kategori = kategori_bansos::find($id);

        if (!$kategori) {
            return redirect('admin/kategori_bansos')->with('error', 'Data Kategori Bantuan Sosial tidak ditemukan');
        }

        $user = Auth::user();
        $role = ($user->id_level == 1) ? 'admin' : 'rw';

        $bansos = BansosModel::all();
        $breadcrumb = (object) [
            'title' => 'Edit Kategori Bantuan Sosial',
            'list' => [
                ['name' => 'Home', 'url' => url('/' . $role)],
                ['name' => 'Kategori Bantuan Sosial', 'url' => url($role . '/kategori_bansos')],
                ['name' => 'Edit Kategori Bantuan Sosial', 'url' => url($role . '/kategori_bansos/' . $id . '/edit')],
            ]
        ];

        $page = (object)[
            'title' => 'Edit Kategori Bantuan Sosial'
        ];

        $activeMenu = 'kategori_bansos';

        return view($role . '.kategori_bansos.edit', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'bansos' => $bansos,
            'kategori' => $kategori,
            'activeMenu' => $activeMenu
        ]);
    }

    // Method untuk mengupdate kategori bansos
    public function updateKategori(Request $request, $id)
    {
        $request->validate([
            'nama_kategori' => 'required|string',
            'bentuk_pemberian' => 'required|string',
            'pengirim' => 'required|string'
        ]);

        $kategori = kategori_bansos::find($id);

        if ($kategori) {
            $kategori->nama_kategori = $request->nama_kategori;
            $kategori->bentuk_pemberian = $request->bentuk_pemberian;
            $kategori->pengirim = $request->pengirim;
            $kategori->save();

            return redirect('admin/kategori_bansos')->with('success', 'Kategori Bantuan Sosial Berhasil Diperbarui');
        } else {
            return redirect('admin/kategori_bansos')->with('error', 'Data Kategori Bantuan Sosial tidak ditemukan');
        }
    }

    // Method untuk menghapus kategori bansos
    public function deleteKategori($id)
    {
        $user = Auth::user();
        $role = ($user->id_level == 1) ? 'admin' : 'rw';
        $kategori = kategori_bansos::find($id);

        if (!$kategori) {
            return redirect($role . '/bansos')->with('error', 'Data Kategori Bantuan Sosial tidak ditemukan');
        }

        // Check if there are related Bansos entries
        $relatedBansosCount = $kategori->detail_kategori()->count();

        if ($relatedBansosCount > 0) {
            return redirect($role . '/bansos')->with('error', 'Kategori ini memiliki bantuan sosial terkait dan tidak dapat dihapus.');
        }

        // Proceed with deletion
        $kategori->delete();
        return redirect($role . '/bansos')->with('success', 'Kategori Bantuan Sosial Berhasil Dihapus');
    }
}
