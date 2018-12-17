<?php

namespace App\Models\PMB;

use Illuminate\Database\Eloquent\Model;

class DetailPotongan extends Model
{
    protected $table = 'pmb_detail_potongan';
    protected $fillable = [
        'kode_potongan',
        'deskripsi',
        'jumlah'
    ];
}
