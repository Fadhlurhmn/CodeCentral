<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class alternatif_per_rt extends Model
{
    use HasFactory;
    protected $table = 'alternatif_per_rt';
    protected $fillable = ['id_bansos', 'rt', 'id_keluarga', 'id_penduduk'];
}
