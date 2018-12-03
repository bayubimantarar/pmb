<?php

namespace App\Repositories\PMB;

use App\Models\PMB\Potongan;

class PotonganRepository
{
    public function getAllData()
    {
        $getPotongan = Potongan::All();

        return $getPotongan;
    }

    public function getSingleData($id)
    {
        $getPotonganData = Potongan::findOrFail($id);

        return $getPotonganData;
    }

    public function getSingleDataForPotongan($kodeKelas)
    {
        $getPotonganData = Potongan::where('id', '=', $kodeKelas)
            ->get()
            ->first();

        return $getPotonganData;
    }

    public function storePotonganData($data)
    {
        $storePotonganData = Potongan::create($data);

        return $storePotonganData;
    }

    public function updatePotonganData($data, $id)
    {
        $updatePotonganData = Potongan::where('id', $id)
            ->update($data);

        return $updatePotonganData;
    }

    public function destroyPotonganData($id)
    {
        $destroyPotonganData = Potongan::destroy($id);

        return $destroyPotonganData;
    }

}
