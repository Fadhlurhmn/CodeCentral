<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PendudukModel extends Model
{
    use HasFactory;

    protected $table = 'penduduk';
    protected $primaryKey = 'id_penduduk';
    protected $fillable = ['nama', 'nik', 'alamat_ktp','jenis_kelamin', 'no_telp', 'tempat_lahir', 'tanggal_lahir', 'agama', 'pekerjaan', 'gol_darah', 'foto_ktp', 'status_data', 'rt', 'rw', 'status_penduduk', 'alamat_domisili'];

    public function detail_keluarga()
    {
        return $this->hasMany(detail_keluarga_model::class, 'id_penduduk', 'id_penduduk');
    }

    public function buat_surat(): HasMany
    {
        return $this->hasMany(SuratModel::class);
    }

    public function users(): HasMany
    {
        return $this->hasMany(UserModel::class);
    }
}
