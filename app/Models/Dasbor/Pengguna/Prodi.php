<?php

namespace App\Models\Dasbor\Pengguna;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Prodi extends Authenticatable
{
    protected $table = 'pengguna_prodi';
    protected $guard = 'prodi';
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
