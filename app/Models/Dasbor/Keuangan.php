<?php

namespace App\Models\Dasbor;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Keuangan extends Authenticatable
{
    protected $table = 'pengguna_keuangan';
    protected $guard = 'keuangan';
    protected $fillable = [
        'nidn',
        'nama',
        'email',
        'nomor_telepon',
        'alamat',
        'password'
    ];
}
