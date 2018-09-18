<?php

namespace App\Repositories;

use App\Soal;
use App\JenisUjian;
use App\Pertanyaan;

class PertanyaanRepository
{
    public function getAllData($kodesoal)
    {
        $getPertanyaan = 
            Pertanyaan::join(
                'soal', 'pertanyaan.kode_soal', '=', 'soal.kode'
            )
            ->select(
                'pertanyaan.*'
            )
            ->where('soal.kode', '=', $kodesoal)
            ->get();
        
        return $getPertanyaan;
    }

    public function getAllDataWithPagination()
    {
        $getMataKuliah = MataKuliah::orderBy('created_at', 'DESC')
            ->simplePaginate(5);
        
        return $getMataKuliah;
    }

    public function getSingleData($id)
    {
        $getPertanyaan = Pertanyaan::findOrFail($id);
        
        return $getPertanyaan;
    }

    public function getSingleDataForBlogDetail($slug)
    {
        $getMataKuliah = MataKuliah::where('slug', '=', $slug)
            ->firstOrFail();

        return $getMataKuliah;
    }

    public function storePertanyaanData($data)
    {
        $storePertanyaanData = Pertanyaan::create($data);
        
        return $storePertanyaanData;
    }

    public function updatePertanyaanData($data, $id)
    {
        $updatePertanyaan = Pertanyaan::where('id', $id)
            ->update($data);

        return $updatePertanyaan;
    }

    public function destroyPertanyaanData($id)
    {
        $destroyPertanyaan = Pertanyaan::destroy($id);

        return $destroyPertanyaan;
    }

}
