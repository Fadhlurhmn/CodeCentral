<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KriteriaKeluargaModel extends Model
{
    use HasFactory;
    protected $table = 'kriteria_keluarga';

    protected $fillable = ['id_keluarga', 'id_kriteria', 'nilai_kriteria'];

    public function kriteria_keluarga(): BelongsTo
    {
        return $this->belongsTo(KeluargaModel::class, 'id_keluarga', 'id_keluarga');
    }

    public function nilai_kriteria(): BelongsTo
    {
        return $this->belongsTo(KriteriaBansosModel::class, 'id_kriteria', 'id_kriteria');
    }
}