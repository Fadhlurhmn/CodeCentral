<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jadwal_keamanan extends Model
{
    use HasFactory;
    protected $table = 'jadwal_keamanan';
    protected $fillable = ['id_jadwal_keamanan', 'hari'];

    public function jadwal_keamanan()
    {
        return $this->hasMany(detail_jadwal_keamanan::class, 'id_jadwal_keamanan', 'id_jadwal_keamanan');
    }
}
