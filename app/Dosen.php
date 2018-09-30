<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Dosen extends Authenticatable
{
    protected $table = 'dosen';
    protected $guard = 'dosen';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nip', 'nama', 'jenis_kelamin', 'alamat', 'email', 'password'
    ];
}
