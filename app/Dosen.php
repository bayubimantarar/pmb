<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    protected $table = 'dosen';
    protected $guard = 'dosen';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nip', 'nama', 'jenis_kelamin', 'alamat', 'email', 'password'
    ];
}
