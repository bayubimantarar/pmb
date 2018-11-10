<?php

namespace App\Models\PMB;

use Illuminate\Database\Eloquent\Model;

class CalonMahasiswaStatus extends Model
{
    protected $table = 'pmb_calon_mahasiswa_status';
    protected $fillable = [
        'kode_pendaftaran',
        'status',
        'asal_sekolah',
        'asal_jurusan',
        'jurusan_pilihan',
        'semester'
    ];
}
