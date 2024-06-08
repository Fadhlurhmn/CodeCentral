<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PromosiModel;
use App\Models\PendudukModel;
use Carbon\Carbon;

class UserPromosiController extends Controller
{
    public function index(Request $request)
    {
        $kategori = $request->get('kategori', 'Semua');
        $search = $request->get('search', '');

        $query = PromosiModel::query()
            ->where('status_pengajuan', 'Terima')
            ->where('countdown', '>', Carbon::now());

        if ($kategori != 'Semua') {
            $query->where('kategori', $kategori);
        }

        if (!empty($search)) {
            $query->where('nama_usaha', 'like', '%' . $search . '%');
        }

        $promosis = $query->get();

        return view('user.promosi.index', compact('promosis', 'kategori', 'search'));
    }

    public function create()
    {
        return view('user.promosi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'pengirim_promosi' => 'required',
            'nama_usaha' => 'required|max:100',
            'deskripsi' => 'required',
            'kategori' => 'required',
            'gambar' => 'required|image',
            'alamat' => 'required|max:100',
            'no_telp' => 'required|max:15',
        ]);

        // Menyimpan file thumbnail yang diupload
        $thumbnail = $request->file('thumbnail');
        $nama_file = time() . "_" . $thumbnail->getClientOriginalName();
        $tujuan_upload = 'promosi_thumbnail';
        $thumbnail->move($tujuan_upload, $nama_file);

        PromosiModel::create([
            'nama_usaha' => $request->nama_usaha,
            'gambar' => $nama_file,
            'deskripsi' => $request->deskripsi,
            'kategori' => $request->kategori,
            'status_pengajuan' => 'Menunggu',
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
            'countdown' => Carbon::now(),
            'id_penduduk' => $request->pengirim_promosi,
        ]);

        return redirect()->route('user.promosi.create')->with('success', 'Promosi berhasil ditambahkan');
    }

    public function verifyDataDiri(Request $request)
    {
        $request->validate([
            'nama_penduduk' => 'required|string|max:255',
            'nik' => 'required|numeric|digits:16',
        ]);

        $nama_penduduk = $request->nama_penduduk;
        $nik = $request->nik;

        $penduduk = PendudukModel::where('nik', $nik)
            ->where('nama', $nama_penduduk)
            ->first();

        if ($penduduk) {
            $promosiDiterima = PromosiModel::where('id_penduduk', $penduduk->id_penduduk)
                ->where('status_pengajuan', 'Terima')
                ->first();

            if ($promosiDiterima) {
                $now = Carbon::now();
                $countdown = Carbon::parse($promosiDiterima->countdown);
                $daysRemaining = $countdown->diffInDays($now);

                return redirect()->route('user.promosi.create')->with('error_verifikasi', 'Warga sudah mengajukan promosi. Tunggu ' . $daysRemaining . ' hari lagi');
            } else {
                $id_penduduk = $penduduk->id_penduduk;
                return redirect()->route('user.promosi.create')->with(['success_verifikasi' => 'Data ditemukan', 'pengirim_promosi' => $id_penduduk]);
            }
        } else {
            return redirect()->route('user.promosi.create')->with('error_verifikasi', 'Data tidak ditemukan');
        }
    }
}
