<?php

namespace App\Http\Controllers;

use App\Models\PendudukModel;
use App\Models\PengaduanModel;
use App\Models\UserModel;
use Illuminate\Http\Request;

class UserPengaduanController extends Controller
{
    public function index()
    {
        $data_pengurus = UserModel::join('level', 'user.id_level', '=', 'level.id_level')
        ->where('kode_level', '!=', 'ADM')->get();
        return view('user.pengaduan.index', ['list_pengurus' => $data_pengurus]);
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

        $nomor_wa = PendudukModel::where('id_penduduk', $request->penerima_aduan)->first()->no_telp;

        $text = $request->isi_pengaduan;
        $tanggal = $request->tanggal_pengaduan;
        $nama_pengirim = PendudukModel::where('id_penduduk', $request->pengirim)->value('nama');

        PengaduanModel::create([
            'id_penduduk' => $request->pengirim,
            'tanggal_pengaduan' => $tanggal,
            'deskripsi' => '('.$request->penerima_aduan.' sebagai penerima aduan) '.$text,
        ]);

        return redirect('https://wa.me/'.$nomor_wa.'?text=Pengirim: '.$nama_pengirim.'%0A%0A(Kejadian terjadi pada tanggal '.$tanggal.')%0A%0A'.$text);
    }
}
