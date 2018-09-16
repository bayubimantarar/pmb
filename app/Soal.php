<?php

namespace App;

use App\JenisUjian;
use App\MataKuliah;
use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{
    protected $table = 'soal';
    protected $primaryKey = 'id';
    protected $fillable = [
        'kode', 
        'kode_jenis_ujian', 
        'kode_mata_kuliah', 
        'sifat_ujian',
        'tanggal_ujian',
        'durasi_ujian'
    ];

    public function scopeAllDataWithRelationship()
    {
        $getSoal = 
            Soal::join(
                'jenis_ujian', 'soal.kode_jenis_ujian', '=', 'jenis_ujian.kode'
            )
            ->join(
                'mata_kuliah', 'soal.kode_mata_kuliah', '=', 'mata_kuliah.kode'
            )
            ->select(
                'soal.*', 
                'jenis_ujian.nama AS nama_jenis_ujian',
                'jenis_ujian.kode AS kode_jenis_ujian',
                'mata_kuliah.nama AS nama_mata_kuliah'
            )
            ->get();
        
        return $getSoal;
    }
}
