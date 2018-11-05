<?php

namespace App\Repositories\PMB;

use App\Models\PMB\NilaiLulus;

class NilaiLulusRepository
{
    public function getAllData()
    {
        $getNilaiLulus = NilaiLulus::All();
        
        return $getNilaiLulus;
    }

    public function getSingleData($id)
    {
        $getNilaiLulusData = NilaiLulus::findOrFail($id);

        return $getNilaiLulusData;
    }

    public function storeNilaiLulusData($data)
    {
        $storeNilaiLulusData = NilaiLulus::create($data);
        
        return $storeNilaiLulusData;
    }

    public function updateNilaiLulusData($data, $id)
    {
        $updateNilaiLulusData = NilaiLulus::where('id', $id)
            ->update($data);

        return $updateNilaiLulusData;
    }

    public function destroyNilaiLulusData($id)
    {
        $destroyNilaiLulusData = NilaiLulus::destroy($id);

        return $destroyNilaiLulusData;
    }

}
