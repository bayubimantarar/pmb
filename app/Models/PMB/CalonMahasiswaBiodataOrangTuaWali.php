<?php

namespace App\Models\PMB;

use Illuminate\Database\Eloquent\Model;

class CalonMahasiswaBiodataOrangTuaWali extends Model
{
    protected $table = 'pmb_calon_mahasiswa_biodata_orang_tua_wali';
    protected $fillable = [
        'kode_pendaftaran',
        'nama_ayah',
        'nama_ibu',
        'pekerjaan_ayah',
        'pekerjaan_ibu',
        'alamat',
        'rt_rw',
        'kelurahan',
        'kecamatan',
        'kode_pos',
        'kota_kabupaten',
        'provinsi',
        'nomor_telepon_rumah',
        'nomor_telepon'
    ];
}
