<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengumumanModel extends Model
{
    protected $table = 'pengumuman';
    protected $primaryKey = 'id_pengumuman';
    protected $fillable = ['id_user', 'judul_pengumuman', 'deskripsi', 'gambar'];

    // public function user(): BelongsTo
    // {
    //     return $this->belongsTo(UserModel::class, 'id_user', 'id_user');
    // }

    // public function landing()
    // {
    //     return $this::orderBy('updated_at', 'desc')->take(4)->get();
    // }
}
