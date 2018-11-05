<?php

namespace App\Repositories\Prodi\PMB;

use App\Soal;
use App\Hasil;
use App\Models\PMB\Jawaban;
use App\Mahasiswa;

class JawabanRepository
{
    public function storeJawabanData($data)
    {
        $storeJawaban = Jawaban::insert($data);
        
        return $storeJawaban;
    }

    public function checkJawabanDataBySoal($kodeSoal)
    {
        $getJawaban = Jawaban::where('kode_soal', '=', $kodeSoal)
            ->get();

        return $getJawaban;
    }

    public function checkMahasiswaHasExam($kodePendaftaran, $kodeSoal)
    {
        $getJawaban = Jawaban::where([
            ['kode_pendaftaran', '=', $kodePendaftaran],
            ['kode_soal', '=', $kodeSoal]
        ])->first();

        return $getJawaban;
    }

    public function getSingleDataByDosenForPeriksa($kodesoal)
    {
        $getJawaban = Jawaban::join('mahasiswa', 'jawaban.nim', '=', 'mahasiswa.nim')
        ->join('soal', 'jawaban.kode_soal', '=', 'soal.kode')
        ->join('hasil', 'jawaban.nim', '=', 'hasil.nim')
        ->select('jawaban.*','soal.kode', 'mahasiswa.nim', 'mahasiswa.nama AS nama_mahasiswa', 'hasil.status', 'hasil.kode_soal')
        ->where('soal.kode', '=', $kodesoal)
        ->where('hasil.kode_soal', '=', $kodesoal)
        ->groupBy('mahasiswa.nim')
        ->get();

        return $getJawaban;
    }

    public function getSingleDataByDosenForNilai($kodesoal)
    {
        $getJawaban = Jawaban::join('mahasiswa', 'jawaban.nim', '=', 'mahasiswa.nim')
        ->join('soal', 'jawaban.kode_soal', '=', 'soal.kode')
        ->join('hasil', 'jawaban.nim', '=', 'hasil.nim')
        ->select('jawaban.*','soal.kode', 'mahasiswa.nim', 'mahasiswa.nama AS nama_mahasiswa', 'hasil.status', 'hasil.kode_soal', 'hasil.nilai_angka', 'hasil.nilai_huruf')
        ->where('soal.kode', '=', $kodesoal)
        ->where('hasil.kode_soal', '=', $kodesoal)
        ->groupBy('mahasiswa.nim')
        ->get();

        return $getJawaban;
    }

    public function getSingleDataByDosenForPeriksaJawaban($nim, $kodesoal)
    {
        $getJawaban = Jawaban::join('mahasiswa', 'jawaban.nim', '=', 'mahasiswa.nim')
            ->join('soal', 'jawaban.kode_soal', '=', 'soal.kode')
            ->join('pertanyaan', 'jawaban.nomor_pertanyaan', '=', 'pertanyaan.id')
            ->select('jawaban.*', 'soal.kode', 'pertanyaan.pertanyaan', 'pertanyaan.gambar AS gambar_pertanyaan', 'pertanyaan.pilihan_a', 'pertanyaan.pilihan_b', 'pertanyaan.pilihan_c', 'pertanyaan.pilihan_d', 'pertanyaan.pilihan_e','pertanyaan.jenis_pertanyaan', 'pertanyaan.jawaban_pilihan AS jawaban_pilihan_pertanyaan')
            ->where('jawaban.nim', '=', $nim)
            ->where('jawaban.kode_soal', '=', $kodesoal)
            ->get();

        return $getJawaban;
    }

    public function destroyJawabanData($kodesoal)
    {
        $destroyJawaban = Jawaban::where('kode_soal', '=', $kodesoal)
            ->delete();

        return $destroyJawaban;
    }
}
