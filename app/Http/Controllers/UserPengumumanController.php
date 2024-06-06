<?php

namespace App\Http\Controllers;

use App\Models\PengumumanModel;
use Illuminate\Http\Request;

class UserPengumumanController extends Controller
{
    // Fungsi untuk menampilkan halaman utama pengumuman
    public function index(Request $request)
    {
        // Mendapatkan pengumuman teratas berdasarkan jumlah views, hanya menampilkan yang berstatus 'Publikasi'
        $topPengumuman = PengumumanModel::where('status_pengumuman', 'Publikasi')
            ->orderBy('views', 'desc')
            ->take(2)
            ->get()
            ->map(function ($item) {
                // Menghapus tag <p> dari deskripsi pengumuman
                $item->deskripsi = strip_tags(preg_replace('#<p>(.*?)</p>#', '$1', $item->deskripsi), '<p>');
                return $item;
            });

        // Mengambil query pencarian dari input pengguna
        $query = $request->input('query');

        // Jika terdapat query pencarian, melakukan pencarian berdasarkan judul pengumuman
        if ($query) {
            $allPengumuman = PengumumanModel::with('user')
                ->where('status_pengumuman', 'Publikasi')
                ->where('judul_pengumuman', 'like', "%$query%")
                ->orderBy('created_at', 'desc')
                ->get()
                ->map(function ($item) {
                    // Menghapus tag <p> dari deskripsi pengumuman
                    $item->deskripsi = strip_tags(preg_replace('#<p>(.*?)</p>#', '$1', $item->deskripsi), '<p>');
                    return $item;
                });

            // Jika tidak ada pengumuman yang ditemukan, menampilkan pesan error
            if ($allPengumuman->isEmpty()) {
                return view('user.pengumuman.index')->with('error', 'Pengumuman tidak ditemukan');
            }
        } else {
            // Jika tidak terdapat query pencarian, menampilkan semua pengumuman yang berstatus 'Publikasi'
            $allPengumuman = PengumumanModel::with('user')
                ->where('status_pengumuman', 'Publikasi')
                ->orderBy('created_at', 'desc')
                ->get()
                ->map(function ($item) {
                    // Menghapus tag <p> dari deskripsi pengumuman
                    $item->deskripsi = strip_tags(preg_replace('#<p>(.*?)</p>#', '$1', $item->deskripsi), '<p>');
                    return $item;
                });

            // Jika tidak ada pengumuman yang ditemukan, menampilkan pesan error
            if ($allPengumuman->isEmpty()) {
                return view('user.pengumuman.index')->with('error', 'Tidak ada pengumuman tersedia');
            }
        }

        // Mengembalikan tampilan halaman pengumuman dengan data yang diperoleh
        return view('user.pengumuman.index', compact('topPengumuman', 'allPengumuman'));
    }

    // Fungsi untuk menampilkan detail pengumuman
    public function show($id)
    {
        // Menemukan pengumuman berdasarkan ID, hanya menampilkan yang berstatus 'Publikasi'
        $pengumuman = PengumumanModel::where('status_pengumuman', 'Publikasi')
            ->findOrFail($id);
        // Menambah jumlah views pengumuman
        $pengumuman->increment('views');

        // Mengembalikan tampilan detail pengumuman
        return view('user.pengumuman.show', compact('pengumuman'));
    }
}
