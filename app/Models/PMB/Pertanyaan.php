<?php

namespace App\Models\PMB;

use Illuminate\Database\Eloquent\Model;

class Pertanyaan extends Model
{
    protected $table = 'pmb_pertanyaan';
    protected $fillable = [
        'kode_soal',
        'jenis_pertanyaan',
        'pertanyaan',
        'gambar',
        'pilihan_a',
        'pilihan_b',
        'pilihan_c',
        'pilihan_d',
        'pilihan_e',
        'jawaban_pilihan',
        'jawaban_benar_salah',
        'bobot'
    ];
}
