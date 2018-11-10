<?php

namespace App\Repositories\PMB;

use App\Models\PMB\Pendaftaran;

class PendaftaranRepository
{
    public function getAllData()
    {
        $getPendaftaran = Pendaftaran::All();
        
        return $getPendaftaran;
    }

    public function getSingleData($id)
    {
        $getPendaftaranData = Pendaftaran::findOrFail($id);

        return $getPendaftaranData;
    }

    public function storePendaftaranData($data)
    {
        $storePendaftaranData = Pendaftaran::create($data);
        
        return $storePendaftaranData;
    }

    public function updatePendaftaranData($data, $id)
    {
        $updatePendaftaranData = Pendaftaran::where('id', $id)
            ->update($data);

        return $updatePendaftaranData;
    }

    public function destroyPendaftaranPMBData($id)
    {
        $destroyPendaftaranData = Pendaftaran::destroy($id);

        return $destroyPendaftaranData;
    }

}
