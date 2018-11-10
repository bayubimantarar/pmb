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
    private $token;
    private $tanggalMulaiUjian;
    private $tanggalSelesaiUjian;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(
        $nama, $kode, $password, $kodeSoal, $token, $tanggalMulaiUjian, $tanggalSelesaiUjian
    ) {
        $this->nama = $nama;
        $this->kode = $kode;
        $this->password = $password;
        $this->kodeSoal = $kodeSoal;
        $this->token = $token;
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
                'kodeSoal' => $this->kodeSoal,
                'token' => $this->token,
                'tanggalMulaiUjian' => $this->tanggalMulaiUjian,
                'tanggalSelesaiUjian' => $this->tanggalSelesaiUjian
            ]);
    }
}
