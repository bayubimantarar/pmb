<?php

namespace App;

use App\JenisUjian;
use App\MataKuliah;
use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{
    protected $table = 'soal';
    protected $fillable = [
        'kode',
        'kode_tahun_ajaran',
        'kode_kelas',
        'kode_jenis_ujian', 
        'kode_mata_kuliah',
        'nip',
        'sifat_ujian',
        'tanggal_ujian',
        'durasi_ujian',
        'jumlah_pertanyaan'
    ];
    protected $dates = [
        'tanggal_ujian'
    ];

    public function scopeAllDataWithRelationship($query, $nip)
    {
        $getSoal = $query
            ->join('jenis_ujian', 'soal.kode_jenis_ujian', '=', 'jenis_ujian.kode')
            ->join('mata_kuliah', 'soal.kode_mata_kuliah', '=', 'mata_kuliah.kode')
            ->select(
                'soal.*',
                'jenis_ujian.nama AS nama_jenis_ujian',
                'jenis_ujian.kode AS kode_jenis_ujian',
                'mata_kuliah.nama AS nama_mata_kuliah'
            )
            ->where('soal.nip', '=', $nip)
            ->get();
        
        return $getSoal;
    }
}
