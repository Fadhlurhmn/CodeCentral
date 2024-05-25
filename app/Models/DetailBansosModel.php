<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetailBansosModel extends Model
{
    use HasFactory;
    protected $table = 'detail_bansos';

    protected $fillable = ['id_keluarga', 'status', 'id_bansos', 'id_kriteria', 'nilai_kriteria'];

    public function keluarga(): BelongsTo
    {
        return $this->belongsTo(KeluargaModel::class, 'id_keluarga', 'id_keluarga');
    }

    public function bansos(): BelongsTo
    {
        return $this->belongsTo(BansosModel::class, 'id_bansos', 'id_bansos');
    }
}
