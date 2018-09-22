<?php

namespace App\Repositories;

use App\Soal;

class SoalRepository
{
    public function getAllData()
    {
        $getSoal = 
            Soal::join(
                'jenis_ujian', 'soal.kode_jenis_ujian', '=', 'jenis_ujian.kode'
            )
            ->join(
                'mata_kuliah', 'soal.kode_mata_kuliah', '=', 'mata_kuliah.kode'
            )
            ->join(
                'token', 'soal.kode', '=', 'token.kode_soal'
            )
            ->select(
                'soal.*', 
                'token.status',
                'token.token',
                'jenis_ujian.nama AS nama_jenis_ujian',
                'mata_kuliah.nama AS nama_mata_kuliah'
            )
            ->get();
        
        return $getSoal;
    }

    public function getSingleData($kodesoal)
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
                'mata_kuliah.nama AS nama_mata_kuliah'
            )
            ->where('soal.kode', '=', $kodesoal)
            ->get();

        return $getSoal;
    }

    public function getSingleDataForEdit($id)
    {
        $getSoal = Soal::where('id', '=', $id)
            ->firstOrFail();

        return $getSoal;
    }

    public function getSingleTokenData($id)
    {
        $getSoal = 
            Soal::join(
                'token', 'soal.kode', '=', 'token.kode_soal'
            )
            ->select('token.token')
            ->where('soal.id', '=', $id)
            ->get()
            ->first();

        return $getSoal;
    }

    public function getSingleKodeSoalData($id)
    {
        $getSoal = Soal::findOrFail($id);

        return $getSoal;
    }

    public function storeSoalData($data)
    {
        $storeSoal = Soal::create($data);
        
        return $storeSoal;
    }

    public function updateSoalData($data, $id)
    {
        $updateSoal = Soal::where('id', $id)
            ->update($data);

        return $updateSoal;
    }

    public function destroySoalData($id)
    {
        $destroySoal = Soal::destroy($id);

        return $destroySoal;
    }

}
