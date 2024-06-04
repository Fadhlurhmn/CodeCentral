<?php

namespace App\Http\Controllers;

use App\Models\PendudukModel;
use App\Models\PengaduanModel;
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
            $id_penduduk = $penduduk->id_penduduk;
            return redirect()->route('user.pengaduan')->with(['success_verifikasi' => 'Data ditemukan', 'pengirim' => $id_penduduk]);
        } else {
            return redirect()->route('user.pengaduan')->with('error_verifikasi', 'Data tidak anda ditemukan');
        }
    }

    public function pengaduan(Request $request)
    {
        $request->validate([
            'pengirim' => 'required',
            'isi_pengaduan' => 'required',
            'tanggal_pengaduan' => 'required',
            'penerima_aduan' => 'required',
        ]);

        $nomor_wa = '0';
        switch($request->penerima_aduan){
            case 'RW': 
                $nomor_wa = '6285850210097';
            case 'RT1': 
                $nomor_wa = '6281234567890';
            case 'RT2': 
                $nomor_wa = '6281234567890';
            case 'RT3': 
                $nomor_wa = '6281234567890';
            case 'RT4': 
                $nomor_wa = '6281234567890';
        }

        $text = $request->isi_pengaduan;
        $tanggal = $request->tanggal_pengaduan;

        PengaduanModel::create([
            'id_penduduk' => $request->pengirim,
            'tanggal_pengaduan' => $tanggal,
            'deskripsi' => '('.$request->penerima_aduan.' sebagai penerima aduan) '.$text,
        ]);

        return redirect('https://wa.me/'.$nomor_wa.'?text='.$text.'%0A(Kejadian terjadi pada tanggal '.$tanggal.')');
    }
}
