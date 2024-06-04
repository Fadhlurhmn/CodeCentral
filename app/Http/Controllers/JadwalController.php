<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public $jadwalKebersihan;
    public $jadwalKeamanan;

    public function __construct()
    {
        $this->jadwalKebersihan = (object)[
            'hari' => ['Senin', 'Kamis', 'Sabtu'],
            'waktu' => ['08:00-12:00', '12:00-16:00'],
        ];

        $this->jadwalKeamanan = (object)[
            'hari' => ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
            'waktu' => ['Pagi', 'Sore', 'Malam'],
            'nama' => [['Budi', 'Adi', 'Dedi'], ['Charli', 'Fahmi', 'Ahmadi'], ['Budi', 'Adi', 'Dedi'], ['Budi', 'Adi', 'Dedi'], ['Budi', 'Adi', 'Dedi'], ['Budi', 'Adi', 'Dedi'], ['Dedi', 'Adi', 'Budi']],
            'telepon' => [['08123456789', '082122222222', '08211111111'], ['11111111111', '082122222222', '08211111111'], ['08123456789', '082122222222', '08211111111'], ['08123456789', '082122222222', '08211111111'], ['08123456789', '082122222222', '08211111111'], ['08123456789', '082122222222', '08211111111'], ['08123456789', '082122222222', '08211111111']],
        ];
    }

    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Jadwal Petugas',
            'list' => [
                ['name' => 'Home', 'url' => url('/admin')],
                ['name' => 'Jadwal', 'url' => url('admin/jadwal')],
            ]
        ];

        $page = (object)[
            'title' => 'Daftar Jadwal Petugas'
        ];

        $activeMenu = 'jadwal';

        return view('admin.jadwal.jadwal', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
            'jadwal_kebersihan' => $this->jadwalKebersihan,
            'jadwal_keamanan' => $this->jadwalKeamanan
        ]);
    }

    public function form_kebersihan()
    {
        $breadcrumb = (object) [
            'title' => 'Update Jadwal Pengangkutan Sampah',
            'list' => [
                ['name' => 'Home', 'url' => url('/admin')],
                ['name' => 'Jadwal', 'url' => url('admin/jadwal')],
                ['name' => 'Update Angkutan Sampah', 'url' => url('admin/jadwal/update_kebersihan')],
            ]
        ];

        $page = (object)[
            'title' => 'Form Update Jadwal Kebersihan'
        ];
        $activeMenu = 'jadwal';

        return view('admin.jadwal.update_kebersihan', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
            'jadwal_kebersihan' => $this->jadwalKebersihan
        ]);
    }

    public function update_kebersihan(Request $request)
    {
        $data = $request->all();
        $this->jadwalKebersihan = (object)[
            'hari' => $data['hari'],
            'waktu' => $data['waktu'],
        ];

        // Here you would save the updated data to a database or another persistent storage

        return redirect('admin/jadwal');
    }

    public function form_keamanan()
    {
        $breadcrumb = (object) [
            'title' => 'Update Jadwal Petugas Satpam',
            'list' => [
                ['name' => 'Home', 'url' => url('/admin')],
                ['name' => 'Jadwal', 'url' => url('admin/jadwal')],
                ['name' => 'Update Petugas Satpam', 'url' => url('admin/jadwal/update_keamanan')],
            ]
        ];

        $page = (object)[
            'title' => 'Form Update Jadwal Keamanan'
        ];
        $activeMenu = 'jadwal';

        return view('admin.jadwal.update_keamanan', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
            'jadwal_keamanan' => $this->jadwalKeamanan
        ]);
    }

    public function update_keamanan(Request $request)
    {
        $changes = $request->input('changes');
        foreach ($changes as $change) {
            $field = $change['field'];
            $row = $change['row'];
            $col = $change['col'];
            $value = $change['value'];

            if ($field === 'nama') {
                $this->jadwalKeamanan->nama[$row][$col] = $value;
            }

            if ($field === 'telepon') {
                $this->jadwalKeamanan->telepon[$row][$col] = $value;
            }
        }

        // Here you would save the updated data to a database or another persistent storage
        return redirect('admin/jadwal');
    }

    public function getJadwalKeamanan()
    {
        return $this->jadwalKeamanan;
    }

    public function getJadwalKebersihan()
    {
        return $this->jadwalKebersihan;
    }
}
