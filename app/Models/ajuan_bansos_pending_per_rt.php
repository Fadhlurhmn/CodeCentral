<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ajuan_bansos_pending_per_rt extends Model
{
    use HasFactory;
    protected $table = 'ajuan_bansos_pending_per_rt';
    protected $fillable = ['id_bansos', 'id_keluarga', 'status', 'rt'];
}
