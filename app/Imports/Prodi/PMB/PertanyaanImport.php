<?php

namespace App\Imports\Prodi\PMB;

use Illuminate\Support\Collection;
use App\Models\PMB\Pertanyaan;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithMappedCells;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PertanyaanImport implements ToModel, WithHeadingRow
{
    protected $kode_soal;

    function __construct($kode_soal)
    {
        $this->kode_soal = $kode_soal;
    }

    public function model(array $row)
    {
        return new Pertanyaan([
            'kode_soal'             => $this->kode_soal,
            'jenis_pertanyaan'      => $row['jenis_pertanyaan'],
            'pertanyaan'            => $row['pertanyaan'],
            'gambar'                => NULL,
            'pilihan_a'             => $row['pilihan_a'],
            'pilihan_b'             => $row['pilihan_b'],
            'pilihan_c'             => $row['pilihan_c'],
            'pilihan_d'             => $row['pilihan_d'],
            'pilihan_e'             => $row['pilihan_e'],
            'jawaban_pilihan'       => $row['jawaban_pilihan_ganda'],
            'jawaban_benar_salah'   => $row['jawaban_benar_salah'],
            'bobot'                 => 10
        ]);
    }

    public function headingRow(): int
    {
        return 7;
    }
    // public function collection(Collection $rows)
    // {
    //     foreach ($rows as $row){
    //         $data[] = [
    //             'data' => [
    //                 'pertanyaan' => $row[0]
    //             ]
    //         ];
    //     }

    //     return $data;
    // }
    // 
    // public function mapping(): array
    // {
    //     return [
    //         'pertanyaan'  => 'B1',
    //     ];
    // }
    
    // public function model(array $row)
    // {
    //     return new Pertanyaan([
    //         'pertanyaan' => $row['pertanyaan'],
    //     ]);
    // }
}
