<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class KonfirmasiPembayaran extends Mailable
{
    use Queueable, SerializesModels;

    protected $nama;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nama)
    {
        $this->nama = $nama;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->markdown('emails.konfirmasi')
            ->with('nama', $this->nama);
    }
}
