<?php

namespace App\Http\Controllers;

use App\Models\PengumumanModel;
use App\Models\jadwal_kebersihan;
use App\Models\rangkuman_jadwal_keamanan;
use App\Models\satpam;
use Illuminate\Http\Request;

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
        return view('index', compact('pengumumanTerkini', 'schedule','days','shifts','jadwal_kebersihan','satpam'));
    }
}
