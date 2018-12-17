<?php

namespace App\Models\PMB;

use Illuminate\Database\Eloquent\Model;

class DetailBiayaPotongan extends Model
{
    protected $table = 'pmb_detail_biaya_potongan';
    protected $fillable = [
        'kode_biaya',
        'kode_potongan',
        'deskripsi',
        'jumlah'
    ];
}
