<?php

namespace App\Models\Dasbor\Master;

use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    protected $table = 'master_prodi';
    protected $fillable = [
        'kode',
        'nama'
    ];
}
