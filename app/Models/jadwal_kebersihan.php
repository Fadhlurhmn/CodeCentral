<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jadwal_kebersihan extends Model
{
    use HasFactory;
    protected $table = 'jadwal_kebersihan';

    protected $primaryKey = 'id_jadwal_kebersihan'; // Tambahkan primaryKey
    protected $fillable = ['hari', 'waktu'];
}
