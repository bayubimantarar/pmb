<?php

namespace App\Mail\PMB;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class KeteranganLulus extends Mailable
{
    use Queueable, SerializesModels;

    private $file, $namaFile, $filePdfBiaya, $namaFilePdfBiaya, $keteranganLulus;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(
        $realFile,
        $namaFile,
        $realFilePdfBiaya,
        $fileNamePdfBiaya, 
        $keteranganLulus
    ) {
        $this->file = $realFile;
        $this->namaFile = $namaFile;
        $this->filePdfBiaya = $realFilePdfBiaya;
        $this->fileNamePdfBiaya = $fileNamePdfBiaya;
        $this->keteranganLulus = $keteranganLulus;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if($this->keteranganLulus == "Lulus")
            return $this->markdown('emails.keterangan_lulus')
                ->attach($this->file, [
                    'as' => $this->namaFile,
                    'mime' => 'application/pdf',
                ])
                ->attach($this->filePdfBiaya, [
                    'as' => $this->fileNamePdfBiaya,
                    'mime' => 'application/pdf',
                ]);
        else{
            return $this->markdown('emails.keterangan_lulus')
                ->attach($this->file, [
                    'as' => $this->namaFile,
                    'mime' => 'application/pdf',
                ]);
        }
    }
}
