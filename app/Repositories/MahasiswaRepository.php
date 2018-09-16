<?php

namespace App\Repositories;

use App\Mahasiswa;

class MahasiswaRepository
{
    public function getAllData()
    {
        $getMahasiswa = Mahasiswa::orderBy('created_at', 'DESC')
            ->get();
        
        return $getMahasiswa;
    }

    public function getAllDataWithPagination()
    {
        $getMahasiswa = Mahasiswa::orderBy('created_at', 'DESC')
            ->simplePaginate(5);
        
        return $getMahasiswa;
    }

    public function getSingleData($id)
    {
        $getMahasiswa = Mahasiswa::where('id', '=', $id)
            ->firstOrFail();

        return $getMahasiswa;
    }

    public function getSingleDataForBlogDetail($slug)
    {
        $getMahasiswa = Mahasiswa::where('slug', '=', $slug)
            ->firstOrFail();

        return $getMahasiswa;
    }

    public function storeMahasiswaData($data)
    {
        $storeMahasiswa = Mahasiswa::create($data);
        
        return $storeMahasiswa;
    }

    public function updateMahasiswaData($data, $id)
    {
        $updateMahasiswa = Mahasiswa::where('id', $id)
            ->update($data);

        return $updateMahasiswa;
    }

    public function destroyMahasiswaData($id)
    {
        $destroyMahasiswa = Mahasiswa::destroy($id);

        return $destroyMahasiswa;
    }

}
