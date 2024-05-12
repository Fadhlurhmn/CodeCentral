<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PromosiModel extends Model
{
    use HasFactory;
    protected $table = 'umkm';
    protected $primaryKey = 'id_umkm';
    protected $fillable = ['nama_usaha', 'gambar', 'deskripsi', 'status_pengajuan', 'alamat', 'countdown', 'id_keluarga'];

    public function keluarga(): BelongsTo
    {
        return $this->belongsTo(KeluargaModel::class, 'id_keluarga', 'id_keluarga');
    }
}
