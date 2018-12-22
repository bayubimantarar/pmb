<?php

namespace App\Repositories\PMB;

use App\Models\PMB\Kehadiran;

class KehadiranRepository
{
    public function getAllData()
    {
        $getKehadiran = Kehadiran::all();

        return $getKehadiran;
    }

    public function getAllDataForPanitia()
    {
        $getKehadiran = Kehadiran::join('pmb_calon_mahasiswa', 'pmb_kehadiran.kode_pendaftaran', '=', 'pmb_calon_mahasiswa.kode')
            ->join('pmb_calon_mahasiswa_biodata', 'pmb_kehadiran.kode_pendaftaran', '=', 'pmb_calon_mahasiswa_biodata.kode_pendaftaran')
            ->join('pmb_sesi', 'pmb_calon_mahasiswa.kode', '=', 'pmb_sesi.kode_pendaftaran')
            ->select('pmb_calon_mahasiswa.*', 'pmb_kehadiran.kode_pendaftaran', 'pmb_sesi.kode_jadwal_ujian', 'pmb_calon_mahasiswa_biodata.nama')
            ->get();

        return $getKehadiran;
    }

    public function getSingleData($id)
    {
        $getKehadiranData = Kehadiran::findOrFail($id);

        return $getKehadiranData;
    }

    public function getSingleDataForKehadiran($kodePendaftaran)
    {
        $getKehadiranData = Kehadiran::where('kode_pendaftaran', '=', $kodePendaftaran)
            ->get()
            ->first();

        return $getKehadiranData;
    }

    public function storeKehadiranData($data)
    {
        $storeKehadiranData = Kehadiran::create($data);

        return $storeKehadiranData;
    }

    public function updateKehadiranData($data, $id)
    {
        $updateKehadiranData = Kehadiran::where('id', $id)
            ->update($data);

        return $updateKehadiranData;
    }

    public function destroyKehadiranData($id)
    {
        $destroyKehadiranData = Kehadiran::destroy($id);

        return $destroyKehadiranData;
    }

}
