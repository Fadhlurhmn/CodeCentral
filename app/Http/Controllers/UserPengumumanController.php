<?php

namespace App\Http\Controllers;

use App\Models\PengumumanModel;
use Illuminate\Http\Request;

class UserPengumumanController extends Controller {
    public function index(Request $request) {
        $topPengumuman = PengumumanModel::orderBy('views', 'desc')->take(2)->get();

        foreach ($topPengumuman as $pengumuman) {
            $pengumuman->deskripsi = $this->getPlainTextFromHtml($pengumuman->deskripsi);
        }

        // Mendapatkan query pencarian jika ada
        $query = $request->input('query');
        if ($query) {
            // Jika ada query, cari pengumuman berdasarkan judul
            $allPengumuman = PengumumanModel::with('user')
                ->where('judul_pengumuman', 'like', "%$query%")
                ->orderBy('created_at', 'desc')
                ->get();

            // Cek apakah hasil pencarian kosong
            if ($allPengumuman->isEmpty()) {
                return view('user.pengumuman')->with('error', 'Pengumuman tidak ditemukan');
            }
        } else {
            // Jika tidak ada query, ambil semua pengumuman
            $allPengumuman = PengumumanModel::with('user')
                ->orderBy('created_at', 'desc')
                ->get();

            // Cek apakah tidak ada pengumuman
            if ($allPengumuman->isEmpty()) {
                return view('user.pengumuman')->with('error', 'Tidak ada pengumuman tersedia');
            }
        }

        foreach ($allPengumuman as $pengumuman) {
            $pengumuman->deskripsi = $this->getPlainTextFromHtml($pengumuman->deskripsi);
        }

        return view('user.pengumuman.index', compact('topPengumuman', 'allPengumuman'));
    }

    public function show($id) {
        $pengumuman = PengumumanModel::findOrFail($id);
        $pengumuman->increment('views');

        return view('user.pengumuman.show', compact('pengumuman'));
    }

    private function getPlainTextFromHtml($htmlContent) {
        // Extract content within <p> tags
        preg_match('/<p>(.*?)<\/p>/', $htmlContent, $matches);
        $text = $matches[1] ?? $htmlContent;

        // Allow certain HTML tags
        $allowedTags = '<br><strong><i>';
        return strip_tags($text, $allowedTags);
    }
}
