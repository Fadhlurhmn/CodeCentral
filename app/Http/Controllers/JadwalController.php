<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JadwalController extends Controller
{
    // Variables to hold the schedules
    private $jadwal_kebersihan = [
        'hari' => 'Senin',
        'waktu' => '08:00 - 12:00'
    ];
    private $jadwal_keamanan = [
        'hari' => ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'],
        'waktu' => ['Pagi', 'Sore', 'Malam'],
        'nama' => ['Budi', 'Adi', 'Dedi'],
        'telepon' => ['08123456789', '082122222222', '08211111111'],
    ];

    // Method to display the index page with schedules
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
            'jadwal_kebersihan' => $this->jadwal_kebersihan,
            'jadwal_keamanan' => $this->jadwal_keamanan
        ]);
    }

    // method buat nampilin form update kebersihan
    public function rubah_kebersihan()
    {
        $breadcrumb = (object)[
            'title' => 'Update Jadwal Kebersihan',
            'list' => ['Home', 'Jadwal Kebersihan', 'Update']
        ];

        $page = (object)[
            'title' => 'Form Update Jadwal Kebersihan'
        ];
        $activeMenu = 'jadwal';
        return view('admin.jadwal.update_kebersihan', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    // Method to update jadwal_kebersihan
    public function udpate_kebersihan(Request $request)
    {
        $this->jadwal_kebersihan['hari'] = $request->input('hari');
        $this->jadwal_kebersihan['waktu'] = $request->input('waktu');

        // Redirect back to the index page or wherever needed
        return redirect('admin/jadwal')->with('success', 'Jadwal kebersihan updated successfully');
    }

    // method buat nampilin form update keamanan
    public function rubah_keamanan()
    {
        $breadcrumb = (object)[
            'title' => 'Update Jadwal Keamanan',
            'list' => ['Home', 'Jadwal Keamanan', 'Update']
        ];

        $page = (object)[
            'title' => 'Form Update Jadwal Keamanan'
        ];
        $activeMenu = 'jadwal';
        return view('admin.jadwal.update_keamanan', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }
    // Method to update jadwal_keamanan
    public function update_keamanan(Request $request)
    {
        $this->jadwal_keamanan['hari'] = $request->input('hari');
        $this->jadwal_keamanan['waktu'] = $request->input('waktu');
        $this->jadwal_keamanan['nama'] = $request->input('nama');
        $this->jadwal_keamanan['telepon'] = $request->input('telepon');

        // Redirect back to the index page or wherever needed
        return redirect('admin/jadwal')->with('success', 'Jadwal keamanan updated successfully');
    }
}
