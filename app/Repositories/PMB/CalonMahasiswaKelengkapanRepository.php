<?php

namespace App\Repositories\PMB;

use App\Models\PMB\CalonMahasiswa;
use App\Models\PMB\CalonMahasiswaStatus;
use App\Models\PMB\CalonMahasiswaBiodata;
use App\Models\PMB\CalonMahasiswaKelengkapan;
use App\Models\PMB\CalonMahasiswaBiodataOrangTuaWali;

class CalonMahasiswaKelengkapanRepository
{
    public function getAllData()
    {
        $getCalonMahasiswa = CalonMahasiswa::All();
        
        return $getCalonMahasiswa;
    }

    public function getSingleDataForDownload($kodePendaftaran)
    {
        $getCalonMahasiswaData = CalonMahasiswaKelengkapan::where('kode_pendaftaran', '=', $kodePendaftaran)->get();

        return $getCalonMahasiswaData;
    }

}
