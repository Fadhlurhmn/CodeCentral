<?php

namespace App\Http\Controllers;

use App\Models\BansosModel;
use Illuminate\Http\Request;
use App\Models\KeluargaModel;
use App\Models\DetailBansosModel;
use Illuminate\Support\Facades\DB;
use App\Models\KriteriaBansosModel;
use App\Models\histori_penerimaan_bansos;
use App\Models\kategori_bansos;
use Database\Seeders\kategoriBansos;

class UserBansosController extends Controller
{
    public function list($id)
    {
        // $histori = histori_penerimaan_bansos::all();
        // dd($histori);
        // return view('user.bansos.list', ['histori' => $histori]);

        $histori = histori_penerimaan_bansos::where('id', $id)->with('detail_bansos')->get();
    
        $data = $histori->map(function($bansos) {
            return $bansos->penerimaans->map(function($penerimaan) {
                return [
                    'nama_kepala_keluarga' => $penerimaan->nama_kepala_keluarga,
                    'alamat' => $penerimaan->alamat
                ];
            });
        })->flatten()->toArray();

        return response()->json($data);
        
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
            'jenis_bansos' => 'required'
        ]);

        $nama_kk = $request->nama_kk;
        $no_kk = $request->no_kk;
        $id_keluarga = KeluargaModel::where('nomor_keluarga', $no_kk)->value('id_keluarga');
        $jenis_bansos = $request->jenis_bansos;
        $kategori = BansosModel::where('id_bansos', $jenis_bansos)->value('id_kategori_bansos'); 

        // mencari data penduduk di database
        $penduduk = KeluargaModel::where('nomor_keluarga', $no_kk)
            ->whereHas('detail_keluarga', function ($query) use ($nama_kk) {
                $query->join('penduduk', 'detail_keluarga.id_penduduk', '=', 'penduduk.id_penduduk')
                    ->where('penduduk.nama', $nama_kk);
            })
            ->first();

        // mengecek data penduduk ada atau tidak
        if ($penduduk) {

            // mengecek apabila no_kk tersebut sudah mengisi atau belum
            $status_pengisian = DetailBansosModel::join('keluarga_penduduk', 'detail_bansos.id_keluarga', '=', 'keluarga_penduduk.id_keluarga')
            ->where('keluarga_penduduk.nomor_keluarga', $no_kk)
            ->where('id_bansos', $jenis_bansos)
            ->exists();

            // mengecek apabila no_kk tersebut sudah mengisi atau belum
            if ($status_pengisian) {
                return redirect()->route('user.bansos.pengajuan')->withInput()->with('error_verifikasi', 'Anda telah mengisi form pengajuan bansos ini');
            } else {
                // mengambil data kategori bansos yang telah diterima user
                $cek_kesamaan_kategori = DetailBansosModel::join('bansos', 'detail_bansos.id_bansos', '=', 'bansos.id_bansos')
                ->where('id_keluarga', $id_keluarga)->distinct()->pluck('id_kategori_bansos')->toArray();
                
                // mengecek apakah kategori bansos yang diambil user ada yang sama
                if (in_array($kategori, array_values($cek_kesamaan_kategori))) {
                    
                    // mengambil semua tanggal input form yang telah dilakukan user
                    $bulan_tahun_bansos = DetailBansosModel::join('bansos', 'detail_bansos.id_bansos', '=', 'bansos.id_bansos')
                    ->where('id_keluarga', $id_keluarga)->distinct()->pluck('bansos.created_at')->toArray();

                    // konversi menjadi nilai month dan year
                    $month_in_bansos = [];
                    $years_in_bansos = [];
                    foreach ($bulan_tahun_bansos as $tanggal) {
                        $years_in_bansos[] = date('Y', strtotime($tanggal));
                        $month_in_bansos[] = date('M', strtotime($tanggal));
                    }

                    // konversi menjadi nilai month dan year untuk bansos yang dipilih user
                    $tanggal_bansos_dibuat = BansosModel::where('id_bansos', $jenis_bansos)->value('updated_at'); 
                    $bansos_month = date('M', strtotime($tanggal_bansos_dibuat));
                    $bansos_years = date('Y', strtotime($tanggal_bansos_dibuat));

                    // mengecek apabila bansos yang dipilih user sama Bulannya dengan bansos yang telah diterima user
                    if(in_array($bansos_month, $month_in_bansos)){

                        // mengecek apabila bansos yang dipilih user sama Tahunnya dengan bansos yang telah diterima user
                        if(in_array($bansos_years, $years_in_bansos)){
                            return redirect()->route('user.bansos.pengajuan')->withInput()->with('error_verifikasi', 'Anda telah mangajukan bansos, silahkan tunggu jadwal pengajuan selanjutnya');
                        } else {
                            return redirect()->route('user.bansos.pengajuan')->with(['success_verifikasi' => 'Silahkan mengisi survey kriteria', 'data_pengaju' => $penduduk->id_keluarga, 'jenis_bansos' => $request->jenis_bansos]);
                        }
                    } else {
                        return redirect()->route('user.bansos.pengajuan')->with(['success_verifikasi' => 'Silahkan mengisi survey kriteria', 'data_pengaju' => $penduduk->id_keluarga, 'jenis_bansos' => $request->jenis_bansos]);
                    }
                } else {
                    // mengambil semua tanggal input form yang telah dilakukan user
                    $bulan_tahun_bansos = DetailBansosModel::join('bansos', 'detail_bansos.id_bansos', '=', 'bansos.id_bansos')
                    ->where('id_keluarga', $id_keluarga)->distinct()->pluck('bansos.created_at')->toArray();

                    // konversi menjadi nilai month dan year
                    $month_in_bansos = [];
                    $years_in_bansos = [];
                    foreach ($bulan_tahun_bansos as $tanggal) {
                        $years_in_bansos[] = date('Y', strtotime($tanggal));
                        $month_in_bansos[] = date('M', strtotime($tanggal));
                    }

                    // konversi menjadi nilai month dan year untuk bansos yang dipilih user
                    $tanggal_bansos_dibuat = BansosModel::where('id_bansos', $jenis_bansos)->value('updated_at'); 
                    $bansos_month = date('M', strtotime($tanggal_bansos_dibuat));
                    $bansos_years = date('Y', strtotime($tanggal_bansos_dibuat));

                    // mengecek apabila bansos yang dipilih user sama Bulannya dengan bansos yang telah diterima user
                    if(in_array($bansos_month, $month_in_bansos)){
                        // mengecek apabila bansos yang dipilih user sama Tahunnya dengan bansos yang telah diterima user
                        if(in_array($bansos_years, $years_in_bansos)){
                            return redirect()->route('user.bansos.pengajuan')->withInput()->with('error_verifikasi', 'Anda telah mangajukan bansos lain, silahkan tunggu jadwal pengajuan selanjutnya');
                        } else {
                            return redirect()->route('user.bansos.pengajuan')->with(['success_verifikasi' => 'Silahkan mengisi survey kriteria', 'data_pengaju' => $penduduk->id_keluarga, 'jenis_bansos' => $request->jenis_bansos]);
                        }
                        
                    } else {
                        return redirect()->route('user.bansos.pengajuan')->with(['success_verifikasi' => 'Silahkan mengisi survey kriteria', 'data_pengaju' => $penduduk->id_keluarga, 'jenis_bansos' => $request->jenis_bansos]);
                    }
                }
            }
        } else {
            return redirect()->route('user.bansos.pengajuan')->withInput()->with('error_verifikasi', 'Data tidak anda ditemukan');
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
