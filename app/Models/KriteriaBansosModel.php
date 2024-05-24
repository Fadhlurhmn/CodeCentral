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

    protected $fillable = ['id_bansos', 'nama_kriteria', 'bobot'];

    public function Bansos(): BelongsTo
    {
        return $this->belongsTo(BansosModel::class, 'id_bansos', 'id_bansos');
    }

    public function kriteria_keluarga(): HasMany
    {
        return $this->hasMany(DetailBansosModel::class);
    }
}
