<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Mahasiswa extends Authenticatable
{
    protected $table = 'mahasiswa';
    protected $guard = 'mahasiswa';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nim', 'nama', 'jenis_kelamin', 'alamat', 'email', 'password'
    ];
}
