<?php

namespace App\Http\Controllers;

use App\Models\detail_jadwal_keamanan;
use App\Models\jadwal_kebersihan;
use App\Models\jadwal_keamanan;
use App\Models\rangkuman_jadwal_keamanan;
use App\Models\satpam;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class JadwalController extends Controller
{
    
    public function index()
    {   
        $satpam = satpam::all(); // data satpam
    
        $jadwal_kebersihan = jadwal_kebersihan::all(); // data jadwal kebersihan
    
        $jadwal_keamanan = rangkuman_jadwal_keamanan::all();

    $days = ['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu', 'minggu'];
    $shifts = ['Pagi', 'Siang - Sore', 'Malam'];

    $schedule = [];
    foreach ($days as $day) {
        foreach ($shifts as $shift) {
            $schedule[$day][$shift] = $jadwal_keamanan->filter(function ($item) use ($day, $shift) {
                return $item->hari == $day && $item->waktu == $shift;
            });
        }
    }

    $breadcrumb = (object) [
        'title' => 'Jadwal Keamanan & Kebersihan',
        'list' => [
            ['name' => 'Home', 'url' => url('/admin')],
            ['name' => 'Jadwal', 'url' => url('admin/jadwal')],
        ]
    ];

    $page = (object)[
        'title' => 'Daftar Jadwal Keamanan & Kebersihan'
    ];

    $activeMenu = 'jadwal';

    return view('admin.jadwal.jadwal', [
        'breadcrumb' => $breadcrumb,
        'page' => $page,
        'activeMenu' => $activeMenu,
        'schedule' => $schedule,
        'days' => $days,
        'shifts' => $shifts,
        'jadwal_kebersihan'=>$jadwal_kebersihan,
        'satpam'=>$satpam,
    ]);
    }


    public function list_satpam(Request $request)
    {
        $satpam = satpam::all(); // data satpam

        return DataTables::of($satpam)
            ->addIndexColumn()
            ->addColumn('aksi', function ($satpam) {
                $btn = '<a href="' . url('admin/jadwal/satpam' . $satpam->id_satpam . '/show') . '" class="btn btn-primary ml-1 flex-col "><i class="fas fa-info-circle"></i></a> ';
                $btn .= '<a href="' . url('admin/jadwal/satpam/' . $satpam->id_satpam . '/edit') . '" class="btn btn-info ml-2 mr-2 flex-col"><i class="fas fa-edit"></i></a> ';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }
    public function list_jadwal_kebersihan(Request $request)
    {
        $jadwal_kebersihan = jadwal_kebersihan::all(); // data jadwal kebersihan

        return DataTables::of($jadwal_kebersihan)
            ->addIndexColumn()
            ->addColumn('aksi', function ($jadwal_kebersihan) {
                $btn = '<a href="' . url('admin/jadwal/kebersihan' . $jadwal_kebersihan->id_jadwal_kebersihan . '/show') . '" class="btn btn-primary ml-1 flex-col "><i class="fas fa-info-circle"></i></a> ';
                $btn .= '<a href="' . url('admin/jadwal/kebersihan/' . $jadwal_kebersihan->id_jadwal_kebersihan . '/edit') . '" class="btn btn-info ml-2 mr-2 flex-col"><i class="fas fa-edit"></i></a> ';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }
    public function list_jadwal_keamanan(Request $request)
    {
        $jadwal_keamanan = rangkuman_jadwal_keamanan::all(); // data jadwal keamanan

        return DataTables::of($jadwal_keamanan)
            ->addIndexColumn()
            ->addColumn('aksi', function ($jadwal_keamanan) {
                $btn = '<a href="' . url('admin/jadwal/keamanan' . $jadwal_keamanan->id_jadwal_keamanan . '/show') . '" class="btn btn-primary ml-1 flex-col "><i class="fas fa-info-circle"></i></a> ';
                $btn .= '<a href="' . url('admin/jadwal/keamanan/' . $jadwal_keamanan->id_jadwal_keamanan . '/edit') . '" class="btn btn-info ml-2 mr-2 flex-col"><i class="fas fa-edit"></i></a> ';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }
    // form untuk create satpam
    public function create_satpam()
    {
        $breadcrumb = (object)[
            'title' => 'Tambah Satpam',
            'list' => [
                ['name' => 'Home', 'url' => url('/admin')],
                ['name' => 'Keluarga', 'url' => url('admin/jadwal')],
                ['name' => 'Tambah Data', 'url' => url('admin/jadwal/satpam/create')],
            ]
        ];

        $page = (object)[
            'title' => 'Tambah Data Satpam'
        ];
        $activeMenu = 'jadwal';

        return view('admin.jadwal.satpam.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }
    // store data satpam
    public function store_satpam(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'nomor_telepon' => 'required|string|digits:15'
        ]);
        satpam::create([
            'nama' => $request->nama,
            'nomor_telepon' => $request->nomor_telepon
        ]);
        return redirect('admin/jadwal/')->with('success', 'Data Satpam berhasil disimpan');
    }
    // show data satpam
    public function edit_satpam(string $id)
    {
        $satpam = satpam::find($id);

        if (!$satpam) {
            return redirect('admin/jadwal')->with('error', 'Data Satpam tidak ditemukan');
        }

        $breadcrumb = (object)[
            'title' => 'Edit Satpam',
            'list' => [
                ['name' => 'Home', 'url' => url('/admin')],
                ['name' => 'Keluarga', 'url' => url('admin/jadwal')],
                ['name' => 'Edit Data', 'url' => url('admin/jadwal/satpam/create')],
            ]
        ];

        $page = (object)[
            'title' => 'Edit Data Satpam'
        ];
        $activeMenu = 'jadwal';
        return view('admin.jadwal.satpam.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'satpam' => $satpam, 'activeMenu' => $activeMenu]);
    }
    // update data satpam
    public function update_satpam(Request $request, string $id)
    {
        $request->validate([
            'nama' => 'required|string',
            'nomor_telepon' => 'required|string|digits:15'
        ]);

        // Temukan data satpam berdasarkan id
        $satpam = Satpam::find($id);

        // Periksa jika data satpam ditemukan
        if ($satpam) {
            // Perbarui data satpam
            $satpam->update([
                'nama' => $request->nama,
                'nomor_telepon' => $request->nomor_telepon
            ]);

            return redirect('admin/jadwal/')->with('success', 'Data Satpam berhasil diupdate');
        } else {
            // Jika data satpam tidak ditemukan, kembalikan dengan pesan kesalahan
            return redirect('admin/jadwal/')->with('error', 'Data Satpam tidak ditemukan');
        }
    }
    // delete satpam
    public function destroy_satpam(string $id)
    {
        // Temukan data satpam berdasarkan id
        $satpam = Satpam::find($id);

        // Periksa jika data satpam ditemukan
        if ($satpam) {
            // Hapus data satpam
            $satpam->delete();

            return redirect('admin/jadwal/')->with('success', 'Data Satpam berhasil dihapus');
        } else {
            // Jika data satpam tidak ditemukan, kembalikan dengan pesan kesalahan
            return redirect('admin/jadwal/')->with('error', 'Data Satpam tidak ditemukan');
        }
    }
    // form update jadwal keamanan
    public function edit_jadwal_keamanan(string $id)
    {
        $jadwal_keamanan = detail_jadwal_keamanan::find($id);

        if (!$jadwal_keamanan) {
            return redirect('admin/jadwal')->with('error', 'Data Jadwal Keamanan tidak ditemukan');
        }

        $breadcrumb = (object)[
            'title' => 'Edit Jadwal Keamanan',
            'list' => [
                ['name' => 'Home', 'url' => url('/admin')],
                ['name' => 'Keluarga', 'url' => url('admin/jadwal')],
                ['name' => 'Edit Data', 'url' => url('admin/jadwal/keamanan/edit')],
            ]
        ];

        $page = (object)[
            'title' => 'Edit Jadwal Keamanan'
        ];
        $activeMenu = 'jadwal';
        return view('admin.jadwal.keamanan.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'jadwal_keamanan' => $jadwal_keamanan, 'activeMenu' => $activeMenu]);
    }
    // update jadwal keamanan
    public function update_jadwal_keamanan(Request $request, $id)
    {
        $request->validate([
            'id_satpam' => 'required|string'
        ]);

        // Temukan data jadwal_keamanan berdasarkan id
        $jadwal_keamanan = detail_jadwal_keamanan::find($id);

        // Periksa jika data jadwal_keamanan ditemukan
        if ($jadwal_keamanan) {
            // Perbarui data jadwal_keamanan
            $jadwal_keamanan->update([
                'id_satpam' => $request->id_satpam
            ]);

            return redirect('admin/jadwal/')->with('success', 'Data Jadwal Keamanan berhasil diupdate');
        } else {
            // Jika data jadwal_keamanan tidak ditemukan, kembalikan dengan pesan kesalahan
            return redirect('admin/jadwal/')->with('error', 'Data Jadwal Keamanan tidak ditemukan');
        }
    }
    public function edit_jadwal_kebersihan(string $id)
    {
        $jadwal_kebersihan = jadwal_kebersihan::find($id);

        if (!$jadwal_kebersihan) {
            return redirect('admin/jadwal')->with('error', 'Data Jadwal Kebersihan tidak ditemukan');
        }

        $breadcrumb = (object)[
            'title' => 'Edit Jadwal kebersihan',
            'list' => [
                ['name' => 'Home', 'url' => url('/admin')],
                ['name' => 'Keluarga', 'url' => url('admin/jadwal')],
                ['name' => 'Edit Data', 'url' => url('admin/jadwal/kebersihan/edit')],
            ]
        ];

        $page = (object)[
            'title' => 'Edit Jadwal kebersihan'
        ];
        $activeMenu = 'jadwal';
        return view('admin.jadwal.kebersihan.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'jadwal_kebersihan' => $jadwal_kebersihan, 'activeMenu' => $activeMenu]);
    }
    // update jadwal kebersihan
    public function update_jadwal_kebersihan(Request $request, $id)
    {
        $request->validate([
            'waktu' => 'required'
        ]);

        // Temukan data jadwal_kebersihan berdasarkan id
        $jadwal_kebersihan = jadwal_kebersihan::find($id);

        // Periksa jika data jadwal_kebersihan ditemukan
        if ($jadwal_kebersihan) {
            // Perbarui data jadwal_kebersihan
            $jadwal_kebersihan->update([
                'waktu' => $request->waktu
            ]);

            return redirect('admin/jadwal/')->with('success', 'Data Jadwal kebersihan berhasil diupdate');
        } else {
            // Jika data jadwal_kebersihan tidak ditemukan, kembalikan dengan pesan kesalahan
            return redirect('admin/jadwal/')->with('error', 'Data Jadwal kebersihan tidak ditemukan');
        }
    }
}
