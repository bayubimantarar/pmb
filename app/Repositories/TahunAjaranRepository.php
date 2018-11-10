<?php

namespace App\Repositories;

use App\TahunAjaran;

class TahunAjaranRepository
{
    public function getAllData()
    {
        $getTahunAjaran = TahunAjaran::All();
        
        return $getTahunAjaran;
    }

    public function getSingleData($id)
    {
        $getTahunAjaran = TahunAjaran::findOrFail($id);

        return $getTahunAjaran;
    }

    public function storeTahunAjaranData($data)
    {
        $storeTahunAjaran = TahunAjaran::create($data);
        
        return $storeTahunAjaran;
    }

    public function updateTahunAjaranData($data, $id)
    {
        $updateTahunAjaran = TahunAjaran::where('id', $id)
            ->update($data);

        return $updateTahunAjaran;
    }

    public function destroyTahunAjaranData($id)
    {
        $destroyTahunAjaran = TahunAjaran::destroy($id);

        return $destroyTahunAjaran;
    }

}
