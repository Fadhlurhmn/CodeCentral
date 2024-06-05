<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PromosiModel extends Model
{
    use HasFactory;
    protected $table = 'promosi';
    protected $primaryKey = 'id_promosi';
    protected $fillable = ['nama_usaha', 'gambar', 'deskripsi','kategori', 'status_pengajuan', 'alamat', 'countdown', 'id_penduduk'];

    public function penduduk(): BelongsTo
    {
        return $this->belongsTo(PendudukModel::class, 'id_penduduk', 'id_penduduk');
    }
}
