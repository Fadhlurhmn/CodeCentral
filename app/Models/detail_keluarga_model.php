<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class detail_keluarga_model extends Model
{
    use HasFactory;

    protected $table = 'detail_keluarga';
    protected $fillable = ['id_keluarga', 'id_penduduk', 'peran_keluarga'];

    public function penduduk(): BelongsTo
    {
        return $this->belongsTo(PendudukModel::class, 'id_penduduk', 'id_penduduk');
    }

    public function keluarga(): BelongsTo
    {
        return $this->belongsTo(KeluargaModel::class, 'id_keluarga', 'id_keluarga');
    }
}
