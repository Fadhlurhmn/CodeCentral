<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SuratModel extends Model
{
    use HasFactory;
    protected $table = 'surat';
    protected $primaryKey = 'id_surat';
    protected $fillable = ['id_user', 'nama_surat'];

    public function pengurus(): BelongsTo
    {
        return $this->belongsTo(PendudukModel::class, 'id_penduduk', 'id_penduduk');
    }
}
