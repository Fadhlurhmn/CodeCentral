<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;

class UserModel extends Model implements Authenticatable
{
    use HasFactory, AuthenticatableTrait;

    protected $table = 'user';
    protected $primaryKey = 'id_user';
    protected $fillable = ['id_level', 'id_penduduk', 'username', 'password', 'status_user'];

    // Definisikan relasi dengan LevelModel
    public function level(): BelongsTo
    {
        return $this->belongsTo(LevelModel::class, 'id_level', 'id_level');
    }

    // Definisikan relasi dengan PendudukModel
    public function penduduk(): BelongsTo
    {
        return $this->belongsTo(PendudukModel::class, 'id_penduduk', 'id_penduduk');
    }
}
