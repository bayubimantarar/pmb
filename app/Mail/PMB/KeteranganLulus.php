<?php

namespace App\Mail\PMB;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class KeteranganLulus extends Mailable
{
    use Queueable, SerializesModels;

    private $nama;
    private $kodePendaftaran;
    private $KeteranganLulus;
    private $kotaLahir;
    private $tanggal;
    private $bulan;
    private $tahun;
    private $sekolahAsal;
    private $jurusanPilihan;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(
        $nama, 
        $kodePendaftaran, 
        $KeteranganLulus,
        $kotaLahir,
        $tanggal,
        $bulan,
        $tahun,
        $sekolahAsal,
        $jurusanPilihan
    ) {
        $this->nama = $nama;
        $this->kodePendaftaran = $kodePendaftaran;
        $this->KeteranganLulus = $KeteranganLulus;
        $this->kotaLahir = $kotaLahir;
        $this->tanggal = $tanggal;
        $this->bulan = $bulan;
        $this->tahun = $tahun;
        $this->sekolahAsal = $sekolahAsal;
        $this->jurusanPilihan = $jurusanPilihan;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->markdown('emails.keterangan_lulus')
            ->with([
                    'nama' => $this->nama,
                    'kodePendaftaran' => $this->kodePendaftaran,
                    'KeteranganLulus' => $this->KeteranganLulus,
                    'kotaLahir' => $this->kotaLahir,
                    'tanggal' => $this->tanggal,
                    'bulan' => $this->bulan,
                    'tahun' => $this->tahun,
                    'sekolahAsal' => $this->sekolahAsal,
                    'jurusanPilihan' => $this->jurusanPilihan
                ]);
    }
}
