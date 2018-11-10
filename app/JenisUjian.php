<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisUjian extends Model
{
    protected $table = 'jenis_ujian';
    protected $primaryKey = 'id';
    protected $fillable = [
        'kode', 'nama'
    ];
}
