<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rekomendasi_per_rt extends Model
{
    use HasFactory;
    protected $table = 'rekomendasi_per_rt';
    protected $fillable = ['id_bansos', 'rt', 'id_keluarga', 'rank', 'nama_kepala_keluarga', 'nomor_keluarga', 'alamat'];
}
