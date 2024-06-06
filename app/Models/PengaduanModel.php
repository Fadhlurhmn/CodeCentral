<?php

namespace App\Models;

use App\Models\PendudukModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PengaduanModel extends Model
{
    use HasFactory;

    protected $table = 'pengaduan';
    protected $primaryKey = 'id_pengaduan';

    protected $fillable = ['id_penduduk', 'deskripsi', 'tanggal_pengaduan'];

    public function penduduk()
    {
        return $this->belongsTo(PendudukModel::class, 'id_penduduk', 'id_penduduk');
    }
}
