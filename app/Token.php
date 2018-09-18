<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    protected $table = 'token';
    protected $primaryKey = 'id';
    protected $fillable = [
        'kode_soal', 'token', 'status'
    ];
}
