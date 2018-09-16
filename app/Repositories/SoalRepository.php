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
            ->select(
                'soal.*', 
                'jenis_ujian.nama AS nama_jenis_ujian', 
                'mata_kuliah.nama AS nama_mata_kuliah'
            )
            ->get();
        
        return $getSoal;
    }

    public function getAllDataWithPagination()
    {
        $getSoal = MataKuliah::orderBy('created_at', 'DESC')
            ->simplePaginate(5);
        
        return $getSoal;
    }

    public function getSingleData($id)
    {
        $getSoal = Soal::where('id', '=', $id)
            ->firstOrFail();

        return $getSoal;
    }

    public function getSingleDataForBlogDetail($slug)
    {
        $getSoal = MataKuliah::where('slug', '=', $slug)
            ->firstOrFail();

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
