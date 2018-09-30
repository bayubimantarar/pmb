<?php

namespace App\Repositories;

use App\Soal;
use App\TahunAjaran;
use App\JenisUjian;
use App\MataKuliah;
use App\Hasil;

class HasilRepository
{
    public function getAllHasilData($nim)
    {
        $getHasil = Hasil::join('soal', 'hasil.kode_soal', '=', 'soal.kode')
            ->join('mata_kuliah', 'soal.kode_mata_kuliah', '=', 'mata_kuliah.kode')
            ->join('tahun_ajaran', 'soal.kode_tahun_ajaran', '=', 'tahun_ajaran.kode')
            ->join('jenis_ujian', 'soal.kode_jenis_ujian', '=', 'jenis_ujian.kode')
            ->select('hasil.kode_soal', 'mata_kuliah.nama AS nama_mata_kuliah', 'tahun_ajaran.tahun AS tahun_ajaran', 'tahun_ajaran.semester AS semester', 'jenis_ujian.nama AS nama_jenis_ujian', 'hasil.nilai_angka')
            ->where('hasil.nim', '=', $nim)
            ->get();
        
        return $getHasil;
    }

    public function storeHasilData($data)
    {
        $storeHasil = Hasil::create($data);
        
        return $storeHasil;
    }

    public function updateHasilData($nim, $kodesoal, $data)
    {
        $updateHasil = Hasil::where('nim', '=', $nim)
        ->where('kode_soal', '=', $kodesoal)
        ->update($data);
        
        return $updateHasil;
    }    
}
