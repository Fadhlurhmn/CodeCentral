<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class list_rekomendasi_bansos extends Model
{
    use HasFactory;

    protected $table = 'rekomendasi';
    protected $fillable = ['id_bansos', 'nomor_keluarga', 'id_keluarga', 'nama_kepala_keluarga', 'alamat', 'rank'];
}
