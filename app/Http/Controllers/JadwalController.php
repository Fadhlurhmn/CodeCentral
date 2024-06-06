<?php

namespace App\Http\Controllers;

use App\Models\detail_jadwal_keamanan;
use App\Models\jadwal_kebersihan;
use App\Models\jadwal_keamanan;
use Illuminate\Support\Facades\DB;
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

        $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
        $shifts = ['Pagi', 'Siang - Sore', 'Malam'];

        $schedule = [];
        foreach ($days as $day) {
            foreach ($shifts as $shift) {
                $schedule[$day][$shift] = $jadwal_keamanan->filter(function ($item) use ($day, $shift) {
                    return strtolower($item->hari) == strtolower($day) && $item->waktu == $shift;
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
            'jadwal_kebersihan' => $jadwal_kebersihan,
            'satpam' => $satpam,
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
                ['name' => 'Jadwal', 'url' => url('admin/jadwal')],
                ['name' => 'Tambah Data', 'url' => url('admin/jadwal/satpam/create')],
            ]
        ];

        $page = (object)[
            'title' => 'Tambah Data Satpam'
        ];

        $satpam = satpam::all();
        $activeMenu = 'jadwal';

        return view('admin.jadwal.satpam.create', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
            'satpam' => $satpam,
        ]);
    }
    // store data satpam
    public function store_satpam(Request $request)
    {
        // Validasi data
        $request->validate([
            'nama.*' => 'required|string',
            'nomor_telepon.*' => 'required|digits:12',
        ]);

        // Ambil data dari form
        $data = $request->all();

        // Loop melalui data dan simpan setiap satpam
        foreach ($data['id'] as $index => $id) {
            if ($id) {
                // Update existing record
                $satpam = satpam::find($id);
                if ($satpam) {
                    $satpam->nama = $data['nama'][$index];
                    $satpam->nomor_telepon = $data['nomor_telepon'][$index];
                    $satpam->save();
                }
            } else {
                // Create new record
                satpam::create([
                    'nama' => $data['nama'][$index],
                    'nomor_telepon' => $data['nomor_telepon'][$index],
                ]);
            }
        }

        // Redirect ke halaman edit dengan pesan sukses
        return redirect('admin/jadwal/')->with('success', 'Data satpam berhasil disimpan.');
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
                ['name' => 'Jadwal', 'url' => url('admin/jadwal')],
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
    public function edit_jadwal_keamanan()
    {
        $satpam = satpam::all();
        $detail_jadwal = detail_jadwal_keamanan::all();
        $jadwal_keamanan = rangkuman_jadwal_keamanan::all();

        $days = ['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu', 'minggu'];
        $shifts = ['Pagi', 'Siang - Sore', 'Malam'];

        $schedule = [];
        foreach ($days as $day) {
            foreach ($shifts as $shift) {
                $schedule[$day][$shift] = $jadwal_keamanan->filter(function ($item) use ($day, $shift) {
                    return strtolower($item->hari) == strtolower($day) && $item->waktu == $shift;
                });
            }
        }

        if (!$detail_jadwal) {
            return redirect('admin/jadwal')->with('error', 'Data Jadwal Keamanan tidak ditemukan');
        }

        $breadcrumb = (object)[
            'title' => 'Edit Jadwal Keamanan',
            'list' => [
                ['name' => 'Home', 'url' => url('/admin')],
                ['name' => 'Jadwal', 'url' => url('admin/jadwal')],
                ['name' => 'Edit Data', 'url' => url('admin/jadwal/keamanan/edit')],
            ]
        ];

        $page = (object)[
            'title' => 'Edit Jadwal Keamanan'
        ];

        $activeMenu = 'jadwal';

        return view('admin.jadwal.keamanan.edit', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'schedule' => $schedule,
            'days' => $days,
            'shifts' => $shifts,
            'satpam' => $satpam,
            'detail_jadwal' => $detail_jadwal,
            'jadwal_keamanan' => $jadwal_keamanan,
            'activeMenu' => $activeMenu
        ]);
    }

    // update jadwal keamanan
    public function update_jadwal_keamanan(Request $request)
    {
        $days = ['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu', 'minggu'];
        $shifts = ['Pagi', 'Siang - Sore', 'Malam'];

        foreach ($days as $day) {
            foreach ($shifts as $shift) {
                if (isset($request->schedule[$day][$shift])) {
                    $satpam_ids = $request->schedule[$day][$shift];

                    foreach ($satpam_ids as $id_satpam) {
                        $satpam = satpam::find($id_satpam);
                        $day_index = array_search($day, $days) + 1;

                        // Update existing record in detail_jadwal_keamanan
                        // detail_jadwal_keamanan::where('id_satpam', $id_satpam)
                        //     ->where('waktu', $shift)
                        //     ->where('id_jadwal_keamanan', $day_index)
                        //     ->update(['id_satpam' => $id_satpam]);

                        DB::statement('UPDATE detail_jadwal_keamanan SET id_satpam = ' . $id_satpam . ' WHERE id_jadwal_keamanan = ' . $day_index . ' AND waktu = "' . $shift . '";');
                    }
                }
            }
        }

        return redirect('admin/jadwal/')->with('success', 'Jadwal keamanan berhasil diperbarui');
    }






    public function edit_jadwal_kebersihan()
    {
        $jadwal_kebersihan = jadwal_kebersihan::all();

        if (!$jadwal_kebersihan) {
            return redirect('admin/jadwal')->with('error', 'Data Jadwal Kebersihan tidak ditemukan');
        }

        $breadcrumb = (object)[
            'title' => 'Edit Jadwal kebersihan',
            'list' => [
                ['name' => 'Home', 'url' => url('/admin')],
                ['name' => 'Jadwal', 'url' => url('admin/jadwal')],
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
    public function store_jadwal_kebersihan(Request $request)
    {
        // Validasi data
        $request->validate([
            'hari.*' => 'required|string',
            'waktu.*' => 'required|string',
        ]);

        // Ambil data dari form
        $data = $request->all();

        // Loop melalui data dan simpan setiap jadwal
        foreach ($data['id'] as $index => $id) {
            $jadwal = jadwal_kebersihan::find($id);
            if ($jadwal) {
                $jadwal->hari = $data['hari'][$index];
                $jadwal->waktu = $data['waktu'][$index];
                $jadwal->save();
            }
        }

        // Redirect ke halaman jadwal dengan pesan sukses
        return redirect('admin/jadwal/')->with('success', 'Jadwal kebersihan berhasil disimpan.');
    }

    public function form_kebersihan()
    {
        $jadwal_kebersihan = jadwal_kebersihan::all();

        $breadcrumb = (object)[
            'title' => 'Edit Jadwal Kebersihan',
            'list' => [
                ['name' => 'Home', 'url' => url('/admin')],
                ['name' => 'Jadwal', 'url' => url('admin/jadwal')],
                ['name' => 'Edit Data', 'url' => url('admin/jadwal/kebersihan/edit')],
            ]
        ];

        $page = (object)[
            'title' => 'Edit Jadwal Kebersihan'
        ];
        $activeMenu = 'jadwal';
        return view('admin.jadwal.kebersihan.create', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
            'jadwal_kebersihan' => $jadwal_kebersihan,
        ]);
    }
}
