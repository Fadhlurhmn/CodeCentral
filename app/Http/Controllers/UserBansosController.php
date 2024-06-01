<?php

namespace App\Http\Controllers;

use App\Models\BansosModel;
use App\Models\DetailBansosModel;
use Illuminate\Http\Request;
use App\Models\KeluargaModel;
use Illuminate\Support\Facades\DB;

class UserBansosController extends Controller
{
    public function list()
    {
        return view('user.bansos.list');
    }

    public function pengajuan()
    {
        $jenis_bansos = BansosModel::where('status', 'open')->get();
        return view('user.bansos.pengajuan', ['jenis_bansos' => $jenis_bansos]);
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

        $status_pengisian = DetailBansosModel::join('keluarga_penduduk', 'detail_bansos.id_keluarga', '=', 'keluarga_penduduk.id_keluarga')
            ->where('keluarga_penduduk.nomor_keluarga', $no_kk)
        ->exists();

        if($status_pengisian){
            return redirect()->route('user/bansos/pengajuan')->with('error_verifikasi', 'Data tidak ditemukan atau Anda telah mengisi form bansos');
        } 
       
        if($penduduk){
            return redirect()->route('user/bansos/pengajuan')->with(['success_verifikasi' => 'Data ditemukan', 'data_pengaju' => $penduduk->id_keluarga]);
        } else {
            return redirect()->route('user/bansos/pengajuan')->with('error_verifikasi', 'Data tidak ditemukan atau Anda telah mengisi form bansos');
        }
        
    }

    public function submitSurvey(Request $request)
    {
        $validatedData = $request->validate([
            'kk_keluarga' => 'required',
            'anggota_keluarga' => 'required',
            'pendidikan_kk' => 'required',
            'pendidikan_anggota' => 'required',
            'pengeluaran' => 'required',
            'penghasilan' => 'required',
            'status_rumah' => 'required',
            'sumber_air' => 'required',
            'penerangan' => 'required',
            'transportasi' => 'required',
        ]);
    
        // Define the criteria and their corresponding keys
        $criteria = [
            1 => 'kk_keluarga',
            2 => 'anggota_keluarga',
            3 => 'pendidikan_kk',
            4 => 'pendidikan_anggota',
            5 => 'pengeluaran',
            6 => 'penghasilan',
            7 => 'status_rumah',
            8 => 'sumber_air',
            9 => 'penerangan',
            10 => 'transportasi',
        ];
        
        // Assuming you have the `id_bansos` and `id_keluarga` available
        $id_bansos = $request->jenis_bansos; // Set this to the appropriate value
        // $id_keluarga = KeluargaModel::where('nomor_keluarga', $request->no_kk)->get('id_keluarga'); 
        $id_keluarga = $request->id_kk; // Set this to the appropriate value
        $status = 'pending'; // Set this to the appropriate value
    
        foreach ($criteria as $id_kriteria => $key) {
            DB::table('detail_bansos')->insert([
                'id_bansos' => $id_bansos,
                'id_keluarga' => $id_keluarga,
                'status' => $status,
                'id_kriteria' => $id_kriteria,
                'nilai_kriteria' => $validatedData[$key],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return redirect()->route('user/bansos/pengajuan')->with('success_submit', 'Data formulir bansos berhasil disimpan');
    }

}