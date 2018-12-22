<?php

namespace App\Models\PMB;

use Illuminate\Database\Eloquent\Model;

class BiayaHeregistrasi extends Model
{
    protected $table = 'pmb_biaya_heregistrasi';
    protected $fillable = [
        'jumlah'
    ];
}
