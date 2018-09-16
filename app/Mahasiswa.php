<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswa';
    protected $guard = 'mahasiswa';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nim', 'nama', 'jenis_kelamin', 'alamat', 'email', 'password'
    ];
}
