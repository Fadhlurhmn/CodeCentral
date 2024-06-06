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
    protected $fillable = ['id_user', 'nama_surat', 'deskripsi', 'path_berkas'];

    public function pengurus(): BelongsTo
    {
        return $this->belongsTo(UserModel::class, 'id_user', 'id_user');
    }
}
