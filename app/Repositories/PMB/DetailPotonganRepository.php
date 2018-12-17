<?php

namespace App\Repositories\PMB;

use App\Models\PMB\DetailPotongan;

class DetailPotonganRepository
{
    public function getAllData()
    {
        $getDetailPotongan = DetailPotongan::all();

        return $getDetailPotongan;
    }

    public function getSingleData($id)
    {
        $getDetailPotonganData = DetailPotongan::findOrFail($id);

        return $getDetailPotonganData;
    }

    public function getSingleDataForDetailPotongan($kodePotongan)
    {
        $getDetailPotonganData = DetailPotongan::where('kode_Potongan', '=', $kodePotongan)
            ->get();

        return $getDetailPotonganData;
    }

    public function storeDetailPotonganData($data)
    {
        $storeDetailPotonganData = DetailPotongan::create($data);

        return $storeDetailPotonganData;
    }

    public function updateDetailPotonganData($data, $id)
    {
        $updateDetailPotonganData = DetailPotongan::where('id', $id)
            ->update($data);

        return $updateDetailPotonganData;
    }

    public function destroyDetailPotonganData($id)
    {
        $destroyDetailPotonganData = DetailPotongan::destroy($id);

        return $destroyDetailPotonganData;
    }

}
