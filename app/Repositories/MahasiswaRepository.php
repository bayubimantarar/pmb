<?php

namespace App\Repositories;

use App\Mahasiswa;

class MahasiswaRepository
{
    public function getAllData()
    {
        $getMahasiswa = Mahasiswa::All();
        
        return $getMahasiswa;
    }

    public function getSingleData($id)
    {
        $getMahasiswa = Mahasiswa::findOrFail($id);
        
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
