<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PendudukModel extends Model
{
    use HasFactory;

    protected $table = 'penduduk';
    protected $primaryKey = 'id_penduduk';
    protected $fillable = ['nama', 'nik', 'alamat', 'no_telp', 'tempat_lahir', 'tanggal_lahir', 'agama', 'pekerjaan', 'gol_darah', 'id_keluarga', 'status_data', 'rt', 'rw', 'status_penduduk'];

    public function keluarga(): BelongsTo
    {
        return $this->belongsTo(KeluargaModel::class, 'id_keluarga', 'id_keluarga');
    }
}
