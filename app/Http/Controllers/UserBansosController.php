<?php

namespace App\Http\Controllers;

use App\Models\BansosModel;
use App\Models\DetailBansosModel;
use App\Models\histori_penerimaan_bansos;
use Illuminate\Http\Request;
use App\Models\KeluargaModel;
use App\Models\KriteriaBansosModel;
use Illuminate\Support\Facades\DB;

class UserBansosController extends Controller
{
    public function list()
    {
        $histori = histori_penerimaan_bansos::all();
        // dd($histori);
        return view('user.bansos.list', ['histori' => $histori]);
    }

    public function pengajuan()
    {
        // mengambil data bansos yang berstatus 'open' form
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

        // mencari data penduduk di database
        $penduduk = KeluargaModel::where('nomor_keluarga', $no_kk)
            ->whereHas('detail_keluarga', function ($query) use ($nama_kk) {
                $query->join('penduduk', 'detail_keluarga.id_penduduk', '=', 'penduduk.id_penduduk')
                    ->where('penduduk.nama', $nama_kk);
            })
            ->first();

        // mengecek apabila no_kk tersebut sudah mengisi atau belum
        $status_pengisian = DetailBansosModel::join('keluarga_penduduk', 'detail_bansos.id_keluarga', '=', 'keluarga_penduduk.id_keluarga')
            ->where('keluarga_penduduk.nomor_keluarga', $no_kk)
            ->exists();

        // mengecek data penduduk ada atau tidak
        if ($penduduk) {

            // mengecek apabila no_kk tersebut sudah mengisi atau belum
            if ($status_pengisian) {
                return redirect()->route('user.bansos.pengajuan')->with('error_verifikasi', 'Anda telah mengisi form bansos');
            } else {
                return redirect()->route('user.bansos.pengajuan')->with(['success_verifikasi' => 'Data ditemukan', 'data_pengaju' => $penduduk->id_keluarga]);
            }
        } else {
            return redirect()->route('user.bansos.pengajuan')->with('error_verifikasi', 'Data tidak anda ditemukan');
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

        // List kriteria yang ada
        $kriteria = [
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

        // opsi dinamis, saran ditambahkan nama kode kriteria
        // $kriteria = KriteriaBansosModel::pluck('nama_kriteria', 'id_kriteria');

        // mengambil jenis bansos
        $id_bansos = $request->jenis_bansos;

        // mengambil id_kk dari verifikasi (session('data_pengaju'))
        $id_keluarga = $request->id_kk;

        // seharusnya di database di set default 'pending'
        $status = 'pending';

        // memasukkan semua data ke tabel detail_bansos
        foreach ($kriteria as $id_kriteria => $key) {
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

        return redirect()->route('user.bansos.pengajuan')->with('success_submit', 'Data formulir bansos berhasil disimpan');
    }
}
