<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hasil extends Model
{
    protected $table = 'hasil';
    protected $primaryKey = 'id';
    protected $fillable = [
        'kode_soal',
        'nim',
        'nilai_angka',
        'nilai_huruf',
        'status'
    ];
}
