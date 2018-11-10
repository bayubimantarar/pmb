<?php

namespace App\Models\PMB;

use Illuminate\Database\Eloquent\Model;

class Gelombang extends Model
{
    protected $table = 'pmb_gelombang';
    protected $fillable = [
        'kode',
        'nama',
        'dari_tanggal',
        'sampai_tanggal',
        'jumlah_potongan'
    ];
    protected $dates = [
        'dari_tanggal',
        'sampai_tanggal'
    ];
}
