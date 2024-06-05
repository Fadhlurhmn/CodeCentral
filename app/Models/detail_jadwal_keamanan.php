<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detail_jadwal_keamanan extends Model
{
    use HasFactory;
    protected $table = 'detail_jadwal_keamanan';
    protected $primaryKey = 'id_jadwal';
    protected $fillable = ['id_jadwal_keamanan', 'id_satpam', 'waktu'];
}
