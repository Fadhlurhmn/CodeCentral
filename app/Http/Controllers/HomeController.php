<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\PengumumanModel;
use App\Models\jadwal_kebersihan;
use App\Models\PromosiModel;
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

        // Ambil 9 pengumuman acak berdasarkan tanggal update yang berstatus 'Terima'
        $promosiTerkini = PromosiModel::query()
            ->where('status_pengajuan', 'Terima')
            ->where('countdown', '>', Carbon::now())
            ->inRandomOrder()
            ->take(9)
            ->get();

        $satpam = satpam::all(); // data satpam

        $jadwal_kebersihan = jadwal_kebersihan::all(); // data jadwal kebersihan

        // Mendapatkan hari ini dalam timezone WIB
        $hariIni = Carbon::now('Asia/Jakarta')->locale('id')->isoFormat('dddd');

        $jadwal_keamanan = rangkuman_jadwal_keamanan::whereRaw("LOWER(hari) = ?", strtolower($hariIni))->get();

        $shifts = ['Pagi', 'Siang - Sore', 'Malam'];

        $schedule = [];
        foreach ($shifts as $shift) {
            $schedule[$hariIni][$shift] = $jadwal_keamanan->filter(function ($item) use ($shift) {
                return strtolower($item->waktu) == strtolower($shift);
            });
        }

        return view('index', compact('pengumumanTerkini', 'promosiTerkini', 'schedule', 'hariIni', 'shifts', 'jadwal_kebersihan', 'satpam'));
    }
}
