<?php

namespace App\Models\PMB;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class CalonMahasiswa extends Authenticatable
{
    protected $table = 'pmb_calon_mahasiswa';
    protected $guard = 'calon_mahasiswa';
    protected $fillable = [
        'kode',
        'kode_jurusan',
        'kode_kelas',
        'kode_gelombang',
        'kode_potongan',
        'status_pendaftaran',
        'password'
    ];
}
