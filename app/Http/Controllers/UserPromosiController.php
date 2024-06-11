<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\PromosiModel;
use Illuminate\Http\Request;
use App\Models\PendudukModel;
use Illuminate\Validation\ValidationException;

class UserPromosiController extends Controller
{
    public function index(Request $request)
    {
        $kategori = $request->get('kategori', 'Semua');
        $search = $request->get('search', '');

        $query = PromosiModel::query()
            ->where('status_pengajuan', 'Terima')
            ->where('countdown', '>', Carbon::now())
            ->inRandomOrder();

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
        try {
            $request->validateWithBag('secondForm', [
                'pengirim_promosi' => 'required',
                'nama_usaha' => 'required|max:100',
                'deskripsi_usaha' => 'required|max:500',
                'jenis_usaha' => 'required',
                'gambar' => 'required|image|max:2048',
                'alamat' => 'required|max:100',
                'no_telp' => 'required|numeric|digits_between:1,20',
            ]);

            // Menyimpan file gambar yang diupload
            $gambar = $request->file('gambar')->store('promosi_thumbnail', 'public');

            PromosiModel::create([
                'nama_usaha' => $request->nama_usaha,
                'gambar' => $gambar,
                'deskripsi' => $request->deskripsi_usaha,
                'kategori' => $request->jenis_usaha,
                'status_pengajuan' => 'Menunggu',
                'alamat' => $request->alamat,
                'no_telp' => $request->no_telp,
                'countdown' => Carbon::now(),
                'id_penduduk' => $request->pengirim_promosi,
            ]);

            return redirect()->route('user.promosi.create')->with('success', 'Promosi berhasil diajukan');
        } catch (ValidationException $e) {
            return redirect()->route('user.promosi.create')->with('pengirim_promosi', $request->pengirim_promosi)->withErrors($e->errors(), 'secondForm')->withInput();
        }
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

    public function cekStatus()
    {
        return view('user.promosi.cek_status');
    }

    public function cekStatusPengajuan(Request $request)
    {
        $request->validate([
            'nik' => 'required|numeric|digits:16',
        ]);

        $nik = $request->nik;
        $penduduk = PendudukModel::where('nik', $nik)->first();

        if ($penduduk) {
            $promosi = PromosiModel::where('id_penduduk', $penduduk->id_penduduk)->orderBy('created_at', 'desc')->first();
            if ($promosi) {
                if ($promosi->status_pengajuan == 'Menunggu') {
                    $message = 'Promosi sedang diproses';
                } elseif ($promosi->status_pengajuan == 'Terima') {
                    $message = 'Promosi sudah terpublikasi';
                } elseif ($promosi->status_pengajuan == 'Tolak') {
                    $message = 'Promosi ditolak';
                } else {
                    $message = 'Status promosi tidak diketahui';
                }
            } else {
                $message = 'Tidak ada promosi yang diajukan oleh penduduk ini';
            }
        } else {
            $message = 'Data penduduk tidak ditemukan.';
        }

        return redirect()->route('user.cekStatus')->with(['status_pengajuan' => $message]);
    }
}
