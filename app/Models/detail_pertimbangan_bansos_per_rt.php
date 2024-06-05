<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detail_pertimbangan_bansos_per_rt extends Model
{
    use HasFactory;

    protected $table = 'detail_pertimbangan_bansos_per_rt';
    protected $fillable = ['id_bansos', 'id_keluarga', 'nomor_keluarga', 'nama_kepala_keluarga', 'rt', 'id_kriteria', 'nama_kriteria', 'nilai_kriteria'];
}
