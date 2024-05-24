<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetailBansosModel extends Model
{
    use HasFactory;
    protected $table = 'detail_bansos';

    protected $fillable = ['id_keluarga', 'id_kriteria', 'nilai_kriteria', 'status'];

    public function value_kriteria(): BelongsTo
    {
        return $this->belongsTo(KriteriaBansosModel::class, 'id_kriterai', 'id_kriteria');
    }
}
