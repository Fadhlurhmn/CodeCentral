<?php

namespace App\Http\Controllers;

use App\Models\PengumumanModel;
use Illuminate\Http\Request;

class HomeController extends Controller {
    public function index() {
        // Ambil 3 pengumuman terbaru berdasarkan tanggal publish
        $pengumumanTerkini = PengumumanModel::orderBy('updated_at', 'desc')->take(9)->get();

        foreach ($pengumumanTerkini as $pengumuman) {
            $pengumuman->deskripsi = $this->getPlainTextFromHtml($pengumuman->deskripsi);
        }

        return view('index', compact('pengumumanTerkini'));
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
