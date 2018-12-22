<?php

namespace App\Repositories\PMB;

use App\Models\PMB\CalonMahasiswa;
use App\Models\PMB\CalonMahasiswaStatus;
use App\Models\PMB\CalonMahasiswaBiodata;
use App\Models\PMB\CalonMahasiswaKelengkapan;
use App\Models\PMB\CalonMahasiswaBiodataOrangTuaWali;

class CalonMahasiswaRepository
{
    public function getAllData()
    {
        $getCalonMahasiswa = CalonMahasiswa::All();

        return $getCalonMahasiswa;
    }

    public function getSingleData($id)
    {
        $getCalonMahasiswaData = CalonMahasiswa::findOrFail($id);

        return $getCalonMahasiswaData;
    }

    public function getSingleDataForKeteranganLulus($kodePendaftaran)
    {
        $getCalonMahasiswaData = CalonMahasiswa::join(
            'pmb_calon_mahasiswa_biodata', 'pmb_calon_mahasiswa.kode', '=', 'pmb_calon_mahasiswa_biodata.kode_pendaftaran'
        )
        ->join('pmb_calon_mahasiswa_status', 'pmb_calon_mahasiswa.kode', '=', 'pmb_calon_mahasiswa_status.kode_pendaftaran')
        ->select('pmb_calon_mahasiswa.*', 'pmb_calon_mahasiswa_biodata.nama', 'pmb_calon_mahasiswa_biodata.kota_lahir', 'pmb_calon_mahasiswa_biodata.tanggal', 'pmb_calon_mahasiswa_biodata.bulan', 'pmb_calon_mahasiswa_biodata.tahun', 'pmb_calon_mahasiswa_status.asal_sekolah', 'pmb_calon_mahasiswa_status.jurusan_pilihan')
        ->where('pmb_calon_mahasiswa.kode', '=', $kodePendaftaran)
        ->get();

        return $getCalonMahasiswaData;
    }

    public function getSingleDataByEmail($kode)
    {
        $getCalonMahasiswaData = CalonMahasiswa::join('pmb_calon_mahasiswa_biodata', 'pmb_calon_mahasiswa.kode', '=', 'pmb_calon_mahasiswa_biodata.kode_pendaftaran')
            ->join('pmb_calon_mahasiswa_status', 'pmb_calon_mahasiswa.kode', '=', 'pmb_calon_mahasiswa_status.kode_pendaftaran')
            ->where('pmb_calon_mahasiswa.kode', '=', $kode)
            ->select('pmb_calon_mahasiswa.*', 'pmb_calon_mahasiswa_biodata.nama', 'pmb_calon_mahasiswa_biodata.email', 'pmb_calon_mahasiswa_biodata.kota_lahir', 'pmb_calon_mahasiswa_biodata.tanggal', 'pmb_calon_mahasiswa_biodata.bulan', 'pmb_calon_mahasiswa_biodata.tahun', 'pmb_calon_mahasiswa_status.asal_sekolah', 'pmb_calon_mahasiswa_status.asal_jurusan')
            ->get();

        return $getCalonMahasiswaData;
    }

    public function getAllDataByIF()
    {
        $getCalonMahasiswaData = CalonMahasiswa::where('kode_jurusan', '=', 'IF')->count();

        return $getCalonMahasiswaData;
    }

    public function getAllDataBySI()
    {
        $getCalonMahasiswaData = CalonMahasiswa::where('kode_jurusan', '=', 'SI')->count();

        return $getCalonMahasiswaData;
    }

    public function getAllDayaForJadwalUjian($kodeJurusan, $kodeGelombang, $statusPendaftaran)
    {
        $getCalonMahasiswa = CalonMahasiswa::join('pmb_calon_mahasiswa_biodata', 'pmb_calon_mahasiswa.kode', '=', 'pmb_calon_mahasiswa_biodata.kode_pendaftaran')
            ->select('pmb_calon_mahasiswa.*', 'pmb_calon_mahasiswa_biodata.nama')
            ->where('pmb_calon_mahasiswa.kode_jurusan', '=', $kodeJurusan)
            ->where('pmb_calon_mahasiswa.kode_gelombang', '=', $kodeGelombang)
            ->where('pmb_calon_mahasiswa.status_pendaftaran', '=', $statusPendaftaran)
            ->where('pmb_calon_mahasiswa.status_jadwal_ujian', '=', 0)
            ->get();

        return $getCalonMahasiswa;
    }

    public function getAllDayaForJadwalUjianForEdit($kodeJurusan, $kodeGelombang, $statusPendaftaran)
    {
        $getCalonMahasiswa = CalonMahasiswa::join('pmb_calon_mahasiswa_biodata', 'pmb_calon_mahasiswa.kode', '=', 'pmb_calon_mahasiswa_biodata.kode_pendaftaran')
            ->select('pmb_calon_mahasiswa.*', 'pmb_calon_mahasiswa_biodata.nama')
            ->where('pmb_calon_mahasiswa.kode_jurusan', '=', $kodeJurusan)
            ->where('pmb_calon_mahasiswa.kode_gelombang', '=', $kodeGelombang)
            ->where('pmb_calon_mahasiswa.status_pendaftaran', '=', $statusPendaftaran)
            ->get();

        return $getCalonMahasiswa;
    }

    public function getAllDataByJadwalUjian(
        $kodeJurusan, $kodeGelombang, $statusPendaftaran
    ) {
        $getCalonMahasiswaData = CalonMahasiswa::join(
            'pmb_calon_mahasiswa_biodata',
            'pmb_calon_mahasiswa_biodata.kode_pendaftaran', '=', 'pmb_calon_mahasiswa.kode'
        )
        ->where(
            'kode_jurusan', '=', $kodeJurusan
        )
        ->where(
            'kode_gelombang', '=', $kodeGelombang
        )
        ->where(
            'status_pendaftaran', '=', $statusPendaftaran
        )
        ->select('pmb_calon_mahasiswa.*', 'pmb_calon_mahasiswa.password', 'pmb_calon_mahasiswa_biodata.email', 'pmb_calon_mahasiswa_biodata.nama')
        ->get();

        return $getCalonMahasiswaData;
    }

    public function storeCalonMahasiswaData(
        $dataCalonMahasiswa,
        $dataCalonMahasiswaStatus,
        $dataCalonMahasiswaBiodata,
        $dataCalonMahasiswaKelengkapan,
        $dataCalonMahasiswaBiodataOrangTuaWali
    ) {
        $storeCalonMahasiswa = CalonMahasiswa::create($dataCalonMahasiswa);
        $storeCalonMahasiswaStatus = CalonMahasiswaStatus::create($dataCalonMahasiswaStatus);
        $storeCalonMahasiswaBiodata = CalonMahasiswaBiodata::create($dataCalonMahasiswaBiodata);
        $storeCalonMahasiswaBiodataOrangTuaWali = CalonMahasiswaBiodataOrangTuaWali::create($dataCalonMahasiswaBiodataOrangTuaWali);
        $storeCalonMahasiswaKelengkapan = CalonMahasiswaKelengkapan::create($dataCalonMahasiswaKelengkapan);

        return $storeCalonMahasiswa;
    }

    public function storeCalonMahasiswaDataForJadwalUjian(
        $dataCalonMahasiswa,
        $dataCalonMahasiswaStatus,
        $dataCalonMahasiswaBiodata,
        $dataCalonMahasiswaKelengkapan
    ) {
        $storeCalonMahasiswa = CalonMahasiswa::insert($dataCalonMahasiswa);
        $storeCalonMahasiswaStatus = CalonMahasiswaStatus::insert($dataCalonMahasiswaStatus);
        $storeCalonMahasiswaBiodata = CalonMahasiswaBiodata::insert($dataCalonMahasiswaBiodata);
        $storeCalonMahasiswaKelengkapan = CalonMahasiswaKelengkapan::insert($dataCalonMahasiswaKelengkapan);

        return $storeCalonMahasiswa;
    }

    public function updateCalonMahasiswaData($data, $id)
    {
        $updateCalonMahasiswaData = CalonMahasiswa::where('id', $id)
            ->update($data);

        return $updateCalonMahasiswaData;
    }

    public function updateCalonMahasiswaDataBySendEmailJadwal($data, $kodePendaftaran)
    {
        $updateCalonMahasiswaData = CalonMahasiswa::where('kode', $kodePendaftaran)
            ->update($data);

        return $updateCalonMahasiswaData;
    }

    public function updateCalonMahasiswaDataByJadwalUjian($dataCalonMahasiwa, $item)
    {
        $updateCalonMahasiswaData = CalonMahasiswa::where('kode', '=', $item)
            ->update($dataCalonMahasiwa);

        return $updateCalonMahasiswaData;
    }

    // public function updateCalonMahasiswaDataByJadwalUjianForDestroy($dataCalonMahasiwa, $kodePendaftaran)
    // {
    //     $updateCalonMahasiswaData = CalonMahasiswa::where('kode', '=', $item)
    //         ->update($dataCalonMahasiwa);

    //     return $updateCalonMahasiswaData;
    // }

    public function destroyCalonMahasiswaPMBData($id)
    {
        $destroyCalonMahasiswaData = CalonMahasiswa::destroy($id);

        return $destroyCalonMahasiswaData;
    }

}
