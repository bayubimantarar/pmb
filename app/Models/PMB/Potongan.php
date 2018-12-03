<?php

namespace App\Models\PMB;

use Illuminate\Database\Eloquent\Model;

class Potongan extends Model
{
    protected $table = 'pmb_potongan';
    protected $fillable = [
        'deskripsi',
        'jumlah_potongan'
    ];
}
