<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function __construct()
    {
        if (!session()->has('jadwal_kebersihan')) {
            session(['jadwal_kebersihan' => (object)[
                'hari' => ['Senin', 'Kamis', 'Sabtu'],
                'waktu' => ['08:00-12:00', '12:00-16:00'],
            ]]);
        }
        if (!session()->has('jadwal_keamanan')) {
            session(['jadwal_keamanan' => (object)[
                'hari' => ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
                'waktu' => ['Pagi', 'Sore', 'Malam'],
                'nama' => [['Budi', 'Adi', 'Dedi'], ['Charli', 'Fahmi', 'Ahmadi'], ['Budi', 'Adi', 'Dedi'], ['Budi', 'Adi', 'Dedi'], ['Budi', 'Adi', 'Dedi'], ['Budi', 'Adi', 'Dedi'], ['Dedi', 'Adi', 'Budi']],
                'telepon' => [['08123456789', '082122222222', '08211111111'], ['11111111111', '082122222222', '08211111111'], ['08123456789', '082122222222', '08211111111'], ['08123456789', '082122222222', '08211111111'], ['08123456789', '082122222222', '08211111111'], ['08123456789', '082122222222', '08211111111'], ['08123456789', '082122222222', '08211111111']],
            ]]);
        }
    }

    public function index()
    {
        $breadcrumb = (object)[
            'title' => 'Daftar Jadwal Petugas',
            'list' => ['Home', 'Jadwal Petugas']
        ];

        $page = (object)[
            'title' => 'Daftar Jadwal Petugas'
        ];

        $activeMenu = 'jadwal';

        return view('admin.jadwal.jadwal', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
            'jadwal_kebersihan' => session('jadwal_kebersihan'),
            'jadwal_keamanan' => session('jadwal_keamanan')
        ]);
    }


    public function form_kebersihan()
    {
        $breadcrumb = (object)[
            'title' => 'Update Jadwal Kebersihan',
            'list' => ['Home', 'Jadwal Kebersihan', 'Update']
        ];

        $page = (object)[
            'title' => 'Form Update Jadwal Kebersihan'
        ];
        $activeMenu = 'jadwal';
        return view('admin.jadwal.update_kebersihan', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu, 'jadwal_kebersihan' => session('jadwal_kebersihan')]);
    }

    public function update_kebersihan(Request $request)
    {
        $data = $request->all();
        $jadwal_kebersihan = (object)[
            'hari' => $data['hari'],
            'waktu' => $data['waktu'],
        ];
        session(['jadwal_kebersihan' => $jadwal_kebersihan]);
    
        return redirect('admin/jadwal');
    }
    public function form_keamanan()
    {
        $breadcrumb = (object)[
            'title' => 'Update Jadwal Keamanan',
            'list' => ['Home', 'Jadwal Keamanan', 'Update']
        ];

        $page = (object)[
            'title' => 'Form Update Jadwal Keamanan'
        ];
        $activeMenu = 'jadwal';
        return view('admin.jadwal.update_keamanan', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu, 'jadwal_keamanan' => session('jadwal_keamanan')]);
    }

    public function update_keamanan(Request $request)
    {
        $changes = $request->input('changes');
        $jadwal_keamanan = session('jadwal_keamanan');

        foreach ($changes as $change) {
            $field = $change['field'];
            $row = $change['row'];
            $col = $change['col'];
            $value = $change['value'];

            if ($field === 'nama') {
                $jadwal_keamanan->nama[$row][$col] = $value;
            }

            if ($field === 'telepon') {
                $jadwal_keamanan->telepon[$row][$col] = $value;
            }
        }

        session(['jadwal_keamanan' => $jadwal_keamanan]);

        return response()->json(['success' => true]);
    }
}
