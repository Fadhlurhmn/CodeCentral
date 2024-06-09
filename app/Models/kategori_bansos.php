<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kategori_bansos extends Model
{
    use HasFactory;
    protected $table = 'kategori_bansos';
    protected $primaryKey = 'id_kategori_bansos';
    protected $fillable = ['pengirim', 'bentuk_pemberian', 'nama_kategori'];

    public function detail_kategori()
    {
        return $this->hasMany(BansosModel::class, 'id_kategori_bansos', 'id_kategori_bansos');
    }
}
