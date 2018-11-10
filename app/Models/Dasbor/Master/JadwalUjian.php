<?php

namespace App\Models\Dasbor\Master;

use Illuminate\Database\Eloquent\Model;

class JadwalUjian extends Model
{
    protected $table = 'master_jadwal_ujian';
    protected $dates = [
        'jadwal_ujian'
    ];
    protected $fillable = [
        'tanggal_ujian'
    ];
}
