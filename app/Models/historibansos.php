<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class historibansos extends Model
{
    use HasFactory;

    protected $table = 'histori_penerimaan_bansos';

    protected $fillable = ['nomor_keluarga', 'nama_kepala_keluarga', 'alamat', 'tanggal_pemberian', 'id_keluarga', 'id_bansos', 'nama_bansos'];
}
