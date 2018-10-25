<?php

namespace App\Models\PMB;

use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    protected $table = 'pmb_pendaftaran';
    protected $fillable = [
        'nama',
        'nomor_telepon',
        'email',
        'alamat',
        'status',
        'konfirmasi_pembayaran'
    ];
}
