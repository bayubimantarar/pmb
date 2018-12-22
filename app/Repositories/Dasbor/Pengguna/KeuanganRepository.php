<?php

namespace App\Repositories\Dasbor\Pengguna;

use App\Models\Dasbor\Keuangan;

class KeuanganRepository
{
    public function getAllData()
    {
        $getKeuangan = Keuangan::All();

        return $getKeuangan;
    }

    public function getSingleData($id)
    {
        $getKeuangan = Keuangan::findOrFail($id);

        return $getKeuangan;
    }

    public function storeKeuanganData($data)
    {
        $storeKeuangan = Keuangan::create($data);

        return $storeKeuangan;
    }

    public function updateKeuanganData($data, $id)
    {
        $updateKeuangan = Keuangan::where('id', $id)
            ->update($data);

        return $updateKeuangan;
    }

    public function destroyKeuanganData($id)
    {
        $destroyKeuangan = Keuangan::destroy($id);

        return $destroyKeuangan;
    }

    public function getSingleDataForKehadiran($nidn)
    {
        $getKeuangan = Keuangan::where('nidn', '=', $nidn)
            ->count();

        return $getKeuangan;
    }
}
