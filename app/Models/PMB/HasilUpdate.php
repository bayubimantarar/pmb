<?php

namespace App\Models\PMB;

use Illuminate\Database\Eloquent\Model;

class HasilUpdate extends Model
{
    protected $table = 'pmb_hasil_update';
    protected $fillable = [
        'kode_jadwal_ujian',
        'kode_pendaftaran',
        'kode_gelombang',
        'kode_jurusan',
        'kode_soal',
        'kode_kelas',
        'nilai_angka'
    ];
}
