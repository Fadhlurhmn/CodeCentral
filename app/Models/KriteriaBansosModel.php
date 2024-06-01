<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KriteriaBansosModel extends Model
{
    use HasFactory;
    protected $table = 'kriteria_bansos';
    protected $primaryKey = 'id_kriteria';

    protected $fillable = ['nama_kriteria', 'bobot'];

    public function kriteria_keluarga(): HasMany
    {
        return $this->hasMany(KriteriaKeluargaModel::class);
    }
}