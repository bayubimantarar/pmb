<?php

namespace App\Mail\PMB;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class JadwalUjian extends Mailable
{
    use Queueable, SerializesModels;

    private $nama;
    private $kode;
    private $password;
    private $kodeSoal;
    private $fileNameKartuUjian;
    private $realFileKartuUjian;
    private $tanggalMulaiUjian;
    private $tanggalSelesaiUjian;
    private $durasi;
    private $kodeJadwalUjian;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(
        $nama, $kode, $password, $tanggalMulaiUjian, $tanggalSelesaiUjian, $realFileKartuUjian, $fileNameKartuUjian, $durasi, $kodeJadwalUjian
    ) {
        $this->nama = $nama;
        $this->kode = $kode;
        $this->kodeJadwalUjian = $kodeJadwalUjian;
        $this->durasi = $durasi;
        $this->password = $password;
        $this->realFileKartuUjian = $realFileKartuUjian;
        $this->fileNameKartuUjian = $fileNameKartuUjian;
        $this->tanggalMulaiUjian = $tanggalMulaiUjian;
        $this->tanggalSelesaiUjian = $tanggalSelesaiUjian;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->markdown('emails.jadwal_ujian')
            ->with([
                'nama' => $this->nama,
                'kode' => $this->kode,
                'password' => $this->password,
                'tanggalMulaiUjian' => $this->tanggalMulaiUjian,
                'tanggalSelesaiUjian' => $this->tanggalSelesaiUjian,
                'durasi' => $this->durasi,
                'kodeJadwalUjian' => $this->kodeJadwalUjian
            ])
            ->attach($this->realFileKartuUjian, [
                'as' => $this->fileNameKartuUjian,
                'mime' => 'application/pdf'
            ]);
    }
}
