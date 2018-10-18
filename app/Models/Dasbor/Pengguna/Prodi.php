<?php

namespace App\Models\Dasbor\Pengguna;

use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    protected $table = 'pengguna_prodi';
    protected $fillable = [
        'nidn',
        'kode_prodi',
        'nama',
        'email',
        'nomor_telepon',
        'alamat',
        'password'
    ];
}
