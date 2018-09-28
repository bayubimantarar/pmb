<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jawaban extends Model
{
    protected $table    = 'jawaban';
    protected $fillable = [
        'kode_soal',
        'nomor_pertanyaan',
        'nim',
        'jawaban_essay',
        'jawaban_pilihan'
    ];
}
