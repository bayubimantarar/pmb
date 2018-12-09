<?php

namespace App\Models\Dasbor\Master;

use Illuminate\Database\Eloquent\Model;

class TahunAjaran extends Model
{
    protected $table = 'master_tahun_ajaran';
    protected $fillable = [
        'tahun'
    ];
}
