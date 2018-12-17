<?php

namespace App\Models\PMB;

use Illuminate\Database\Eloquent\Model;

class DetailBiaya extends Model
{
    protected $table = 'pmb_detail_biaya';
    protected $fillable = [
        'kode_biaya',
        'deskripsi',
        'jumlah'
    ];
}
