<?php

namespace App\Repositories\Prodi\PMB;

use App\Models\PMB\Pertanyaan;

class PertanyaanRepository
{
    public function getAllData($kodesoal)
    {
        $getPertanyaan = 
            Pertanyaan::join(
                'pmb_soal', 'pmb_pertanyaan.kode_soal', '=', 'pmb_soal.kode'
            )
            ->select(
                'pmb_pertanyaan.*'
            )
            ->where('pmb_soal.kode', '=', $kodesoal)
            ->orderBy('pmb_pertanyaan.id', 'ASC')
            ->get();
        
        return $getPertanyaan;
    }

    public function getAllDataBySoal($kodeSoal)
    {
        $getPertanyaan = 
            Pertanyaan::join(
                'pmb_soal', 
                'pmb_pertanyaan.kode_soal', '=', 'pmb_soal.kode'
            )
            ->select(
                'pmb_pertanyaan.*', 
                'pmb_soal.nidn', 
                'pmb_soal.kode AS kode_soal',
                'pmb_soal.jumlah_pertanyaan'
            )
            ->where('pmb_soal.kode', '=', $kodeSoal)
            ->get();
        
        return $getPertanyaan;
    }

    public function getSingleDataForDeleteBySoal($kodeSoal)
    {
        $getPertanyaan = Pertanyaan::where('kode_soal', '=', $kodeSoal)->get();

        return $getPertanyaan;
    }

    public function getSingleData($id)
    {
        $getPertanyaan = Pertanyaan::findOrFail($id);
        
        return $getPertanyaan;
    }

    public function getSingleDataForChecking($kodesoal)
    {
        $getPertanyaan = Pertanyaan::where('kode_soal', '=', $kodesoal)
            ->get();
        
        return $getPertanyaan;
    }

    public function storePertanyaanData($data)
    {
        $storePertanyaanData = Pertanyaan::insert($data);
        
        return $storePertanyaanData;
    }

    public function updatePertanyaanData($data, $id)
    {
        $updatePertanyaan = Pertanyaan::where('id', $id)
            ->update($data);

        return $updatePertanyaan;
    }

    public function updatePertanyaanBySoalData($data, $kodesoal)
    {
        $updatePertanyaan = Pertanyaan::where('kode_soal', $kodesoal)
            ->update($data);

        return $updatePertanyaan;
    }

    public function destroyPertanyaanData($id)
    {
        $destroyPertanyaan = Pertanyaan::destroy($id);

        return $destroyPertanyaan;
    }

    public function destroyPertanyaanBySoalData($kodeSoal)
    {
        $destroyPertanyaan = Pertanyaan::where('kode_soal', '=', $kodeSoal)
            ->delete();

        return $destroyPertanyaan;
    }
}
