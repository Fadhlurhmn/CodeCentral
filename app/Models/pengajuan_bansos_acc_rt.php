<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pengajuan_bansos_acc_rt extends Model
{
    use HasFactory;
    protected $table = 'pengajuan_bansos_acc_rt';
    protected $fillable = ['nomor_keluarga', 'nama_kepala_keluarga', 'alamat', 'tanggal_pemberian', 'id_keluarga', 'id_bansos', 'nama_bansos'];
}
