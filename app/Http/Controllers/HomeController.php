<?php

namespace App\Http\Controllers;

use App\Models\PengumumanModel;
use Illuminate\Http\Request;
use App\Http\Controllers\JadwalController;

class HomeController extends Controller {
    public function index() {
        // Ambil 9 pengumuman terbaru berdasarkan tanggal update yang berstatus 'Publikasi'
        $pengumumanTerkini = PengumumanModel::where('status_pengumuman', 'Publikasi')
            ->orderBy('updated_at', 'desc')
            ->take(9)
            ->get();

        // Menghapus tag <p> dari deskripsi pengumuman
        $pengumumanTerkini = $pengumumanTerkini->map(function ($item) {
            $item->deskripsi = strip_tags(preg_replace('#<p>(.*?)</p>#', '$1', $item->deskripsi), '<p>');
            return $item;
        });

        // Mengambil jadwal keamanan dan kebersihan
        $jadwalController = new JadwalController();
        $jadwal_keamanan = $jadwalController->getJadwalKeamanan();
        $jadwal_kebersihan = $jadwalController->getJadwalKebersihan();

        return view('index', compact('pengumumanTerkini', 'jadwal_keamanan', 'jadwal_kebersihan'));
    }
}
