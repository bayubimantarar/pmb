<?php

namespace App\Repositories\PMB;

use App\Models\PMB\Sesi;

class SesiRepository
{
    public function getAllData()
    {
        $getSesi = Sesi::join('pmb_soal', 'pmb_jadwal_ujian.kode_soal', '=', 'pmb_soal.kode')
            ->join('pmb_gelombang', 'pmb_jadwal_ujian.kode_gelombang', '=', 'pmb_gelombang.kode')
            ->join('master_prodi', 'pmb_jadwal_ujian.kode_jurusan', '=', 'master_prodi.kode')
            ->join('pmb_calon_mahasiswa_biodata', 'pmb_sesi.kode_pendaftaran', '=', 'pmb_calon_mahasiswa_biodata.kode_pendaftaran')
            ->select('pmb_jadwal_ujian.*', 'pmb_soal.kode AS kode_soal', 'pmb_gelombang.kode AS kode_gelombang', 'pmb_gelombang.nama AS nama_gelombang', 'master_prodi.nama AS nama_jurusan', 'master_prodi.kode AS kode_jurusan', 'pmb_jadwal_ujian.tahun', 'pmb_jadwal_ujian.tanggal_mulai_ujian', 'pmb_jadwal_ujian.tanggal_selesai_ujian', 'pmb_calon_mahasiswa_biodata.nama')
            ->get();

        return $getSesi;
    }

    public function getAllDataByJadwalUjian($kodeJadwalUjian)
    {
        $getSesi = Sesi::join('pmb_calon_mahasiswa_biodata', 'pmb_sesi.kode_pendaftaran', '=', 'pmb_calon_mahasiswa_biodata.kode_pendaftaran')
            ->select('pmb_sesi.*', 'pmb_calon_mahasiswa_biodata.nama')
            ->where('pmb_sesi.kode_jadwal_ujian', '=', $kodeJadwalUjian)
            ->get();

        return $getSesi;
    }

    public function getAllDataByJadwalUjianForDestroy($kodeJadwalUjian)
    {
        $getSesi = Sesi::where('kode_jadwal_ujian', '=', $kodeJadwalUjian)
            ->get();

        return $getSesi;
    }

    public function getSingleData($id)
    {
        $getSesiData = Sesi::findOrFail($id);

        return $getSesiData;
    }

    public function getSingleDataForEmail($kodePendaftaran)
    {
        $getSesiData = Sesi::join('pmb_calon_mahasiswa_biodata', 'pmb_sesi.kode_pendaftaran', '=', 'pmb_calon_mahasiswa_biodata.kode_pendaftaran')
            ->join('pmb_jadwal_ujian', 'pmb_sesi.kode_jadwal_ujian', '=', 'pmb_jadwal_ujian.kode')
            ->join('pmb_calon_mahasiswa_kelengkapan', 'pmb_sesi.kode_pendaftaran', '=', 'pmb_calon_mahasiswa_kelengkapan.kode_pendaftaran')
            ->select('pmb_sesi.*', 'pmb_calon_mahasiswa_biodata.nama', 'pmb_calon_mahasiswa_biodata.email', 'pmb_calon_mahasiswa_biodata.kota_lahir', 'pmb_calon_mahasiswa_biodata.tanggal', 'pmb_calon_mahasiswa_biodata.bulan', 'pmb_calon_mahasiswa_biodata.tahun', 'pmb_jadwal_ujian.tanggal_mulai_ujian', 'pmb_jadwal_ujian.tanggal_selesai_ujian', 'pmb_jadwal_ujian.kode_soal', 'pmb_jadwal_ujian.ruangan', 'pmb_calon_mahasiswa_kelengkapan.foto_4x6')
            ->where('pmb_sesi.kode_pendaftaran', '=', $kodePendaftaran)
            ->first();

        return $getSesiData;
    }

    public function getSingleDataForKelulusan($kodePendaftaran)
    {
        $getSesiData = Sesi::join('pmb_calon_mahasiswa_biodata', 'pmb_sesi.kode_pendaftaran', '=', 'pmb_calon_mahasiswa_biodata.kode_pendaftaran')
            ->join('pmb_jadwal_ujian', 'pmb_sesi.kode_jadwal_ujian', '=', 'pmb_jadwal_ujian.kode')
            ->join('pmb_calon_mahasiswa_kelengkapan', 'pmb_sesi.kode_pendaftaran', '=', 'pmb_calon_mahasiswa_kelengkapan.kode_pendaftaran')
            ->join('pmb_hasil_update', 'pmb_sesi.kode_pendaftaran', '=', 'pmb_hasil_update.kode_pendaftaran')
            ->select('pmb_sesi.*', 'pmb_calon_mahasiswa_biodata.nama', 'pmb_calon_mahasiswa_biodata.email', 'pmb_calon_mahasiswa_biodata.kota_lahir', 'pmb_calon_mahasiswa_biodata.tanggal', 'pmb_calon_mahasiswa_biodata.bulan', 'pmb_calon_mahasiswa_biodata.tahun', 'pmb_jadwal_ujian.tanggal_mulai_ujian', 'pmb_jadwal_ujian.tanggal_selesai_ujian', 'pmb_jadwal_ujian.kode_soal', 'pmb_jadwal_ujian.ruangan', 'pmb_calon_mahasiswa_kelengkapan.foto_4x6', 'pmb_hasil_update.nilai_angka')
            ->where('pmb_sesi.kode_pendaftaran', '=', $kodePendaftaran)
            ->first();

        return $getSesiData;
    }

    public function getAllDataForSesi($kodeJadwalUjian)
    {
        $getSesiData = Sesi::where('kode_jadwal_ujian', '=', $kodeJadwalUjian)
            ->get();

        return $getSesiData;
    }

    public function getAllDataForEmail($kode)
    {
        $getSesiData = Sesi::join('pmb_jadwal_ujian', 'pmb_sesi.kode_jadwal_ujian', '=', 'pmb_jadwal_ujian.kode')
            ->join('pmb_calon_mahasiswa', 'pmb_sesi.kode_pendaftaran', '=', 'pmb_calon_mahasiswa.kode')
            ->join('pmb_calon_mahasiswa_biodata', 'pmb_calon_mahasiswa.kode', '=', 'pmb_calon_mahasiswa_biodata.kode_pendaftaran')
            ->join('pmb_calon_mahasiswa_kelengkapan', 'pmb_calon_mahasiswa.kode', '=', 'pmb_calon_mahasiswa_kelengkapan.kode_pendaftaran')
            ->select('pmb_sesi.*', 'pmb_jadwal_ujian.kode_soal', 'pmb_jadwal_ujian.id AS jadwal_ujian_id', 'pmb_jadwal_ujian.tanggal_mulai_ujian', 'pmb_jadwal_ujian.tanggal_selesai_ujian', 'pmb_calon_mahasiswa.id AS calon_mahasiswa_id', 'pmb_calon_mahasiswa_biodata.nama', 'pmb_calon_mahasiswa_biodata.email', 'pmb_calon_mahasiswa_biodata.kota_lahir', 'pmb_calon_mahasiswa_biodata.bulan', 'pmb_calon_mahasiswa_biodata.tanggal', 'pmb_calon_mahasiswa_biodata.tahun', 'pmb_calon_mahasiswa_kelengkapan.foto_4x6')
            ->where('kode_jadwal_ujian', '=', $kode)
            ->get();

        return $getSesiData;
    }

    public function getAllDataForEmailBroadcast($kodeJadwalUjian)
    {
        $getSesiData = Sesi::join('pmb_jadwal_ujian', 'pmb_sesi.kode_jadwal_ujian', '=', 'pmb_jadwal_ujian.kode')
            ->join('pmb_calon_mahasiswa', 'pmb_sesi.kode_pendaftaran', '=', 'pmb_calon_mahasiswa.kode')
            ->join('pmb_calon_mahasiswa_biodata', 'pmb_calon_mahasiswa.kode', '=', 'pmb_calon_mahasiswa_biodata.kode_pendaftaran')
            ->join('pmb_calon_mahasiswa_kelengkapan', 'pmb_calon_mahasiswa.kode', '=', 'pmb_calon_mahasiswa_kelengkapan.kode_pendaftaran')
            ->select('pmb_sesi.*', 'pmb_jadwal_ujian.kode_soal', 'pmb_jadwal_ujian.id AS jadwal_ujian_id', 'pmb_jadwal_ujian.tanggal_mulai_ujian', 'pmb_jadwal_ujian.tanggal_selesai_ujian', 'pmb_calon_mahasiswa.id AS calon_mahasiswa_id', 'pmb_calon_mahasiswa_biodata.nama', 'pmb_calon_mahasiswa_biodata.email', 'pmb_calon_mahasiswa_biodata.kota_lahir', 'pmb_calon_mahasiswa_biodata.bulan', 'pmb_calon_mahasiswa_biodata.tanggal', 'pmb_calon_mahasiswa_biodata.tahun', 'pmb_calon_mahasiswa_kelengkapan.foto_4x6')
            ->where('kode_jadwal_ujian', '=', $kodeJadwalUjian)
            ->get();

        return $getSesiData;
    }

    public function getSingleDataByExam($kodeSoal)
    {
        $getSesiData = Sesi::where('kode', '=', $kodeSoal)
            ->get();

        return $getSesiData;
    }

    public function storeSesiData($data)
    {
        $storeSesiData = Sesi::insert($data);

        return $storeSesiData;
    }

    public function updateSesiData($data, $id)
    {
        $updateSesiData = Sesi::where('id', $id)
            ->update($data);

        return $updateSesiData;
    }

    public function destroySesiData($id)
    {
        $destroySesiData = Sesi::destroy($id);

        return $destroySesiData;
    }

    public function destroySesiDataByJadwalUjian($kodeJadwalUjian)
    {
        $destroySesiData = Sesi::where('kode_jadwal_ujian', '=', $kodeJadwalUjian)
            ->delete();

        return $destroySesiData;
    }
}
