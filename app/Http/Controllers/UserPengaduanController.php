<?php

namespace App\Http\Controllers;

use App\Models\PendudukModel;
use Illuminate\Http\Request;

class UserPengaduanController extends Controller
{
    public function index()
    {
        return view('user.pengaduan.index');
    }

    public function verifyDataDiri(Request $request)
    {
        $request->validate([
            'nama_penduduk' => 'required|string|max:255',
            'nik' => 'required|numeric|digits:16',
        ]);

        $nama_penduduk = $request->nama_penduduk;
        $nik = $request->nik;

        // mencari data penduduk di database
        $penduduk = PendudukModel::where('nik', $nik)
        ->where('nama', $nama_penduduk)
        ->first();

        // mengecek data penduduk ada atau tidak
        if($penduduk){
            return redirect()->route('user/pengaduan')->with('success_verifikasi', 'Data ditemukan');
        } else {
            return redirect()->route('user/pengaduan')->with('error_verifikasi', 'Data tidak anda ditemukan');
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            ''
        ]);
    }
}
