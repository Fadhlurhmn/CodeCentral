<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rangkuman_jadwal_keamanan extends Model
{
    use HasFactory;
    protected $table = 'rangkuman_jadwal_keamanan';
    protected $fillable = ['id_jadwal_keamanan', 'id_satpam', 'hari', 'waktu', 'nama', 'nomor_telepon'];
}
