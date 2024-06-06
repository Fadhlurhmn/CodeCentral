<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PendudukModel;

class UserPromosiController extends Controller
{
    public function index()
    {
        return view('user.promosi.index');
    }

    public function create()
    {
        return view('user.promosi.create');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'pengirim_promosi' => 'required',
            'nama_usaha' => 'required',
            'deskripsi_usaha' => 'required',
            'jenis_usaha' => 'required',
            'berkas_usaha' => 'nullable',
        ]);

        // lanjutin
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
            $id_penduduk = $penduduk->id_penduduk;
            return redirect()->route('user.promosi.create')->with(['success_verifikasi' => 'Data ditemukan', 'pengirim_promosi' => $id_penduduk]);
        } else {
            return redirect()->route('user.promosi.create')->with('error_verifikasi', 'Data tidak anda ditemukan');
        }
    }
}
