<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BansosModel extends Model
{
    use HasFactory;
    protected $table = 'bansos';
    protected $primaryKey = 'id_bansos';

    protected $fillable = ['tanggal_pemberian', 'pengirim', 'bentuk_pemberian', 'jumlah_penerima', 'nama'];

    public function kriteria_bansos(): HasMany
    {
        return $this->hasMany(KriteriaBansosModel::class);
    }

    public function detail_bansos(): HasMany
    {
        return $this->hasMany(DetailBansosModel::class, 'id_bansos', 'id_bansos');
    }
}
