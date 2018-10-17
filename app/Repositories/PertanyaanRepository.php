<?php

namespace App\Repositories;

use App\Soal;
use App\JenisUjian;
use App\Pertanyaan;

class PertanyaanRepository
{
    public function getAllData($kodesoal)
    {
        $getPertanyaan = 
            Pertanyaan::join(
                'soal', 'pertanyaan.kode_soal', '=', 'soal.kode'
            )
            ->select(
                'pertanyaan.*'
            )
            ->where('soal.kode', '=', $kodesoal)
            ->orderBy('pertanyaan.id', 'DESC')
            ->get();
        
        return $getPertanyaan;
    }

    public function getAllDataBySoal($kodesoal)
    {
        $getPertanyaan = 
            Pertanyaan::join(
                'soal', 'pertanyaan.kode_soal', '=', 'soal.kode'
            )
            ->join(
                'jenis_ujian', 'soal.kode_jenis_ujian', '=', 'jenis_ujian.kode'
            )
            ->join(
                'tahun_ajaran', 'soal.kode_tahun_ajaran', '=', 'tahun_ajaran.kode'
            )
            ->join(
                'kelas', 'soal.kode_kelas', '=', 'kelas.kode'
            )
            ->join(
                'mata_kuliah', 'soal.kode_mata_kuliah', '=', 'mata_kuliah.kode'
            )
            ->join(
                'dosen', 'soal.nip', '=', 'dosen.nip'
            )
            ->select(
                'pertanyaan.*', 
                'soal.nip', 
                'soal.kode AS kode_soal',
                'soal.tanggal_mulai_ujian',
                'soal.tanggal_selesai_ujian',
                'soal.durasi_ujian',
                'soal.jumlah_pertanyaan',
                'jenis_ujian.nama AS nama_jenis_ujian',
                'tahun_ajaran.semester',
                'tahun_ajaran.tahun',
                'kelas.nama AS nama_kelas',
                'mata_kuliah.nama AS nama_mata_kuliah',
                'dosen.nama AS nama_dosen'
            )
            ->where('soal.kode', '=', $kodesoal)
            ->get();
        
        return $getPertanyaan;
    }

    public function getSingleData($id)
    {
        $getPertanyaan = Pertanyaan::findOrFail($id);
        
        return $getPertanyaan;
    }

    public function getSingleDataForChecking($kodesoal)
    {
        $getPertanyaan = Pertanyaan::where('kode_soal', '=', $kodesoal)
            ->get();
        
        return $getPertanyaan;
    }

    public function storePertanyaanData($data)
    {
        $storePertanyaanData = Pertanyaan::insert($data);
        
        return $storePertanyaanData;
    }

    public function updatePertanyaanData($data, $id)
    {
        $updatePertanyaan = Pertanyaan::where('id', $id)
            ->update($data);

        return $updatePertanyaan;
    }

    public function updatePertanyaanBySoalData($data, $kodesoal)
    {
        $updatePertanyaan = Pertanyaan::where('kode_soal', $kodesoal)
            ->update($data);

        return $updatePertanyaan;
    }

    public function destroyPertanyaanData($id)
    {
        $destroyPertanyaan = Pertanyaan::destroy($id);

        return $destroyPertanyaan;
    }

    public function destroyPertanyaanBySoalData($kodeSoal)
    {
        $destroyPertanyaan = Pertanyaan::where('kode_soal', '=', $kodeSoal)
            ->delete();

        return $destroyPertanyaan;
    }

}
