<?php

namespace App\Models\PMB;

use Illuminate\Database\Eloquent\Model;

class CalonMahasiswaKelengkapan extends Model
{
    protected $table = 'pmb_calon_mahasiswa_kelengkapan';
    protected $fillable = [
        'kode_pendaftaran',
        'fotocopy_raport_kelas_xii',
        'fotocopy_ijazah_sma',
        'foto_3x4',
        'foto_4x6',
        'surat_keterangan_pindah',
        'fotocopy_transkrip_nilai',
        'fotocopy_ijazah_perguruan_tinggi_asal'
    ];
}
