<?php

namespace App\Http\Controllers;

use App\Models\KeluargaModel;
use App\Models\PendudukModel;
use Illuminate\Http\Request;

class UserBansosController extends Controller
{
    public function list()
    {
        return view('user.bansos.list');
    }

    public function pengajuan()
    {
        return view('user.bansos.pengajuan');
    }

    public function verifyDataDiri(Request $request)
    {
        $request->validate([
            'nama_kk' => 'required|string|max:255',
            'no_kk' => 'required|numeric|digits:16',
        ]);

        $nama_kk = $request->nama_kk;
        $no_kk = $request->no_kk;

        $penduduk = KeluargaModel::where('nomor_keluarga', $no_kk)
        ->whereHas('detail_keluarga', function($query) use ($nama_kk) {
            $query->join('penduduk', 'detail_keluarga.id_penduduk', '=', 'penduduk.id_penduduk')
                ->where('penduduk.nama', $nama_kk);
        })
        ->first();

        if($penduduk){
            return redirect()->route('user/bansos/pengajuan')->with('success', 'Data ditemukan');
        } else {
            return redirect()->route('user/bansos/pengajuan')->with('error', 'Data tidak ditemukan atau Anda telah mengisi form bansos');
        }
    }

    public function submitSurvey(Request $request)
    {
        // Handle the submission of the Survey form
    }

}
