<?php

namespace App\Models\PMB;

use Illuminate\Database\Eloquent\Model;

class Kehadiran extends Model
{
    protected $table = 'pmb_kehadiran';
    protected $fillable = [
        'kode_pendaftaran'
    ];
}
