<?php

namespace App\Services;

use App\Post;

class PertanyaanService
{
    public function handleUploadGambar($fileGambar, $namaGambar)
    {
        $uploadGambar = $fileGambar
            ->move(public_path('/uploads/pertanyaan/gambar'), $namaGambar);
    }

    public function handleDeleteGambar($namaGambar)
    {
        $deleteFileGambar = unlink(public_path('/uploads/pertanyaan/gambar/'.$namaGambar));
    }
}
