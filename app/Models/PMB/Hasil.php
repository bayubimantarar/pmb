<?php

namespace App\Models\PMB;

use Illuminate\Database\Eloquent\Model;

class Hasil extends Model
{
    protected $table = 'pmb_hasil';
    protected $fillable = [
        'kode_pendaftaran',
        'kode_gelombang',
        'kode_jurusan',
        'kode_soal',
        'nilai_angka'
    ];
}
