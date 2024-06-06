<?php

namespace App\Http\Controllers;

use App\Models\SuratModel;
use Illuminate\Http\Request;

class UserSuratController extends Controller
{
    // Fungsi untuk menampilkan halaman utama surat
    public function index(Request $request)
    {
        // Mengambil query pencarian dari input pengguna
        $query = $request->input('query');

        // Jika terdapat query pencarian, melakukan pencarian berdasarkan nama surat
        if ($query) {
            $surat = SuratModel::where('nama_surat', 'like', "%$query%")->get();
        } else {
            // Jika tidak terdapat query pencarian, menampilkan semua surat
            $surat = SuratModel::all();
        }

        // Menampilkan view dengan data surat yang ditemukan
        return view('user.surat.index', ['surat' => $surat]);
    }

    // Fungsi untuk mengunduh file
    public function download($id)
    {
        // Mencari surat berdasarkan id, jika tidak ditemukan akan melempar 404 error
        $surat = SuratModel::findOrFail($id);

        // Menyusun path berkas surat yang akan diunduh
        $path = public_path('storage/' . $surat->path_berkas);

        // Memeriksa apakah berkas ada di path yang ditentukan
        if (file_exists($path)) {
            // Mengunduh berkas jika ditemukan
            return response()->download($path);
        } else {
            // Mengembalikan respons error jika berkas tidak ditemukan
            return response()->json(['error' => 'File tidak ditemukan.'], 404);
        }
    }
}
