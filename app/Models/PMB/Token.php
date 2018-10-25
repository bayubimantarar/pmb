<?php

namespace App\Models\PMB;

use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    protected $table = 'pmb_token';
    protected $fillable = [
        'kode_soal', 'token', 'status'
    ];
}
