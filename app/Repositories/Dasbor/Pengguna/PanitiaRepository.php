<?php

namespace App\Repositories\Dasbor\Pengguna;

use App\Models\Dasbor\Pengguna\Panitia;

class PanitiaRepository
{
    public function getAllData()
    {
        $getPanitia = Panitia::All();

        return $getPanitia;
    }

    public function getSingleData($id)
    {
        $getPanitia = Panitia::findOrFail($id);

        return $getPanitia;
    }

    public function storePanitiaData($data)
    {
        $storePanitia = Panitia::create($data);

        return $storePanitia;
    }

    public function updatePanitiaData($data, $id)
    {
        $updatePanitia = Panitia::where('id', $id)
            ->update($data);

        return $updatePanitia;
    }

    public function destroyPanitiaData($id)
    {
        $destroyPanitia = Panitia::destroy($id);

        return $destroyPanitia;
    }

    public function getSingleDataForKehadiran($nidn)
    {
        $getPanitia = Panitia::where('nidn', '=', $nidn)
            ->count();

        return $getPanitia;
    }
}
