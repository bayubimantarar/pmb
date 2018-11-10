<?php

namespace App\Services;

class KonfirmasiPembayaranService
{
    public function handleUploadGambar($fileGambar, $namaGambar)
    {
        $uploadGambar = $fileGambar
            ->move(public_path('/uploads/pmb/pembayaran'), $namaGambar);
    }

    public function handleDeleteGambar($namaGambar)
    {
        $deleteFileGambar = unlink(public_path('/uploads/pmb/pembayaran/'.$namaGambar));
    }
}
