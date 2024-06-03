<?php

namespace App\Http\Controllers;

use App\Models\PengumumanModel;
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

        return view('index', compact('pengumumanTerkini'));
    }
}
