<?php

namespace App\Models\PMB;

use Illuminate\Database\Eloquent\Model;

class Sesi extends Model
{
    protected $table = 'pmb_sesi';
    protected $fillable = [
        'kode_jadwal_ujian',
        'kode_pendaftaran',
        'status'
    ];
    protected $dates = [
        'tanggal_mulai_ujian',
        'tanggal_selesai_ujian'
    ];
}
