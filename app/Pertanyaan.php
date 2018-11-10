<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pertanyaan extends Model
{
    protected $table = 'pertanyaan';
    protected $primaryKey = 'id';
    protected $fillable = [
        'kode_soal',
        'pertanyaan',
        'jenis_pertanyaan',
        'gambar',
        'pilihan_a',
        'pilihan_b',
        'pilihan_c',
        'pilihan_d',
        'pilihan_e',
        'jawaban_essay',
        'jawaban_pilihan',
        'bobot'
    ];
    protected $dates = [
        'tanggal_mulai_ujian',
        'tanggal_selesai_ujian'
    ];
}
