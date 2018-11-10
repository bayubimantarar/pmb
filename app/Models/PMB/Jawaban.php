<?php

namespace App\Models\PMB;

use Illuminate\Database\Eloquent\Model;

class Jawaban extends Model
{
    protected $table = 'pmb_jawaban';
    protected $fillable = [
        'kode_jadwal_ujian',
        'kode_pendaftaran',
        'kode_soal',
        'nomor_pertanyaan',
        'jenis_pertanyaan',
        'jawaban_pilihan',
        'jawaban_benar_salah'
    ];
}
