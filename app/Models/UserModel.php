<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserModel extends Authenticatable
{
    use HasFactory;

    protected $table = 'user';
    protected $primaryKey = 'id_user';
    protected $fillable = ['username', 'id_penduduk', 'password', 'id_level', 'status_akun'];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function penduduk()
    {
        return $this->belongsTo(PendudukModel::class, 'id_penduduk', 'id_penduduk');
    }

    public function level()
    {
        return $this->belongsTo(LevelModel::class, 'id_level', 'id_level');
    }

    public function pengumuman()
    {
        return $this->hasMany(PengumumanModel::class, 'id_pengumuman', 'id_pengumuman');
    }
}
