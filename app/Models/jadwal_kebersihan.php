<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jadwal_kebersihan extends Model
{
    use HasFactory;
    protected $table = 'jadwal_kebersihan';
    protected $fillable = ['id_jadwal_kebersihan', 'hari', 'waktu'];
}
