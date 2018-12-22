<?php

namespace App\Repositories\PMB;

use App\Models\PMB\JadwalUjian;

class JadwalUjianRepository
{
    public function getAllData()
    {
        $getJadwalUjian = JadwalUjian::join('pmb_soal', 'pmb_jadwal_ujian.kode_soal', '=', 'pmb_soal.kode')
            ->join('pmb_gelombang', 'pmb_jadwal_ujian.kode_gelombang', '=', 'pmb_gelombang.kode')
            ->join('master_prodi', 'pmb_jadwal_ujian.kode_jurusan', '=', 'master_prodi.kode')
            ->select('pmb_jadwal_ujian.*', 'pmb_soal.kode AS kode_soal', 'pmb_gelombang.kode AS kode_gelombang', 'pmb_gelombang.nama AS nama_gelombang', 'master_prodi.nama AS nama_jurusan', 'master_prodi.kode AS kode_jurusan', 'pmb_jadwal_ujian.tahun', 'pmb_jadwal_ujian.tanggal_mulai_ujian', 'pmb_jadwal_ujian.tanggal_selesai_ujian')
            ->get();

        return $getJadwalUjian;
    }

    public function getSingleDataForCount($tanggalMulaiUjian)
    {
        $getJadwalUjian = JadwalUjian::whereDate('created_at', '=', $tanggalMulaiUjian)
            ->count();

        return $getJadwalUjian;
    }

    public function getSingleDataForPeserta($kodeJadwalUjian)
    {
        $getJadwalUjian = JadwalUjian::join('pmb_gelombang', 'pmb_jadwal_ujian.kode_gelombang', '=', 'pmb_gelombang.kode')
            ->join('master_prodi', 'pmb_jadwal_ujian.kode_jurusan', '=', 'master_prodi.kode')
            ->where('pmb_jadwal_ujian.kode', '=', $kodeJadwalUjian)
            ->select('pmb_jadwal_ujian.*', 'pmb_gelombang.nama AS nama_gelombang', 'master_prodi.nama AS nama_jurusan')
            ->get();

        return $getJadwalUjian;
    }

    public function getSingleData($id)
    {
        $getJadwalUjianData = JadwalUjian::findOrFail($id);

        return $getJadwalUjianData;
    }

    public function getSingleDataByExam($kodeSoal)
    {
        $getJadwalUjianData = JadwalUjian::where('kode', '=', $kodeSoal)
            ->get();

        return $getJadwalUjianData;
    }

    public function storeJadwalUjianData($data)
    {
        $storeJadwalUjianData = JadwalUjian::create($data);

        return $storeJadwalUjianData;
    }

    public function updateJadwalUjianData($data, $id)
    {
        $updateJadwalUjianData = JadwalUjian::where('id', $id)
            ->update($data);

        return $updateJadwalUjianData;
    }

    public function destroyJadwalUjianData($id)
    {
        $destroyJadwalUjianData = JadwalUjian::destroy($id);

        return $destroyJadwalUjianData;
    }

}
