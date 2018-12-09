<?php

namespace App\Models\PMB;

use Illuminate\Database\Eloquent\Model;

class JadwalUjian extends Model
{
    protected $table = 'pmb_jadwal_ujian';
    protected $fillable = [
        'kode',
        'kode_gelombang',
        'kode_soal',
        'kode_jurusan',
        'status_pendaftaran',
        'tahun',
        'tanggal_mulai_ujian',
        'tanggal_selesai_ujian',
        'ruangan',
        'status'
    ];
    protected $dates = [
        'tanggal_mulai_ujian',
        'tanggal_selesai_ujian'
    ];
}
