<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CalonMahasiswaBiodata extends Model
{
    protected $table = 'calon_mahasiswa_biodata';
    protected $fillable = [
        'kode_pendaftaran',
        'nama',
        'jenis_kelamin',
        'rt_rw',
        'kelurahan',
        'kecamatan',
        'kode_pos',
        'kota_kabupaten',
        'provinsi',
        'kota_lahir',
        'tanggal',
        'bulan',
        'tahun',
        'pekerjaan',
        'nomor_telepon_rumah',
        'nomor_telepon',
        'email',
        'website',
        'mengenal_stmik'
    ]
}
