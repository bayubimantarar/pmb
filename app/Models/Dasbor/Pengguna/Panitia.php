<?php

namespace App\Models\Dasbor\Pengguna;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Panitia extends Authenticatable
{
    protected $table = 'pengguna_panitia';
    protected $fillable = [
        'nidn',
        'nama',
        'email',
        'nomor_telepon',
        'alamat',
        'password'
    ];
}
