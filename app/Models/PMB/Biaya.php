<?php

namespace App\Models\PMB;

use Illuminate\Database\Eloquent\Model;

class Biaya extends Model
{
    protected $table = 'pmb_biaya';
    protected $fillable = [
        'kelas',
        'biaya_pendaftaran',
        'biaya_jaket_kemeja',
        'biaya_pspt',
        'biaya_pengembangan_institusi',
        'biaya_kuliah',
        'biaya_kemahasiswaan',
        'keterangan',
    ];
}
