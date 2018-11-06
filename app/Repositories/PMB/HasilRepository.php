<?php

namespace App\Repositories\PMB;

use App\Soal;
use App\TahunAjaran;
use App\JenisUjian;
use App\MataKuliah;
use App\Models\PMB\Hasil;

class HasilRepository
{
    public function checkHasilDataBySoal($kodeSoal)
    {
        $getHasil = Hasil::where('kode_soal', '=', $kodeSoal)
            ->get();

        return $getHasil;
    }

    public function getAllHasilData()
    {
        $getHasil = Hasil::All();
        
        return $getHasil;
    }

    public function getAllHasilDataByFilter(
        $kodeJurusan, 
        $kodeGelombang, 
        $kodeKelas,
        $tahun
    ) {
        $getHasil = Hasil::where('kode_jurusan', '=', $kodeJurusan)
            ->where('kode_gelombang', '=', $kodeGelombang)
            ->where('kode_kelas', '=', $kodeKelas)
            ->whereYear('created_at', $tahun)
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

    public function destroyHasilData($kodeSoal)
    {
        $destroyHasil = Hasil::where('kode_soal', '=', $kodeSoal)
            ->delete();

        return $destroyHasil;
    }
}
