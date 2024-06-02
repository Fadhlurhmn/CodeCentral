<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rangkuman_keluarga extends Model
{
    use HasFactory;
    protected $table = 'rangkuman_keluarga';
    protected $fillable = ['id_keluarga', 'nomor_keluarga', 'id_penduduk', 'nama_kepala_keluarga', 'alamat', 'rt', 'jumlah_anggota_dalam_KK', 'jumlah_kendaraan'];
}
