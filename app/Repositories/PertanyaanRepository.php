<?php

namespace App\Repositories;

use App\Soal;
use App\JenisUjian;
use App\Pertanyaan;

class PertanyaanRepository
{
    public function getAllData()
    {
        $getPertanyaan = 
            Pertanyaan::join(
                'soal', 'pertanyaan.kode_soal', '=', 'soal.kode'
            )
            ->join(
                'mata_kuliah', 'soal.kode_mata_kuliah', '=', 'mata_kuliah.kode'
            )
            ->join(
                'jenis_ujian', 'soal.kode_jenis_ujian', '=', 'jenis_ujian.kode'
            )
            ->select(
                'pertanyaan.*',
                'soal.kode as kode_soal',
                'jenis_ujian.nama AS nama_jenis_ujian',  
                'mata_kuliah.nama AS nama_mata_kuliah'
            )
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
        $getMataKuliah = MataKuliah::where('id', '=', $id)
            ->firstOrFail();

        return $getMataKuliah;
    }

    public function getSingleDataForBlogDetail($slug)
    {
        $getMataKuliah = MataKuliah::where('slug', '=', $slug)
            ->firstOrFail();

        return $getMataKuliah;
    }

    public function storeMataKuliahData($data)
    {
        $storeMataKuliah = MataKuliah::create($data);
        
        return $storeMataKuliah;
    }

    public function updateMataKuliahData($data, $id)
    {
        $updateMataKuliah = MataKuliah::where('id', $id)
            ->update($data);

        return $updateMataKuliah;
    }

    public function destroyMataKuliahData($id)
    {
        $destroyMataKuliah = MataKuliah::destroy($id);

        return $destroyMataKuliah;
    }

}
