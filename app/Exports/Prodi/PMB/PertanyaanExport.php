<?php

namespace App\Exports\Prodi\PMB;

use App\Models\PMB\Hasil;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PertanyaanExport implements FromView, ShouldAutoSize, WithEvents
{
    protected $tahun;
    protected $temp;
    protected $borderForNomor;
    protected $borderForJumlahPertanyaan;

    public function __construct($tahun)
    {
        $this->tahun = $tahun;
    }

    /**
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $cellRange = 'A7:W7'; // All headers
                $event->sheet->styleCells(
                    'A7:J7',
                    [
                        'borders' => [
                            'outline' => [
                                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                                'color' => ['argb' => '00000000'],
                            ],
                        ]
                    ]
                );
                $event->sheet->styleCells(
                    'A7:A'.$this->borderForNomor,
                    [
                        'borders' => [
                            'outline' => [
                                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                                'color' => ['argb' => '00000000'],
                            ],
                        ]
                    ]
                );
                $event->sheet->styleCells(
                    'B7:B'.$this->borderForNomor,
                    [
                        'borders' => [
                            'outline' => [
                                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                                'color' => ['argb' => '00000000'],
                            ],
                        ]
                    ]
                );
                $event->sheet->styleCells(
                    'B7:B'.$this->borderForNomor,
                    [
                        'borders' => [
                            'outline' => [
                                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                                'color' => ['argb' => '00000000'],
                            ],
                        ]
                    ]
                );
                $event->sheet->styleCells(
                    'C7:C'.$this->borderForNomor,
                    [
                        'borders' => [
                            'outline' => [
                                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                                'color' => ['argb' => '00000000'],
                            ],
                        ]
                    ]
                );
                $event->sheet->styleCells(
                    'D7:D'.$this->borderForNomor,
                    [
                        'borders' => [
                            'outline' => [
                                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                                'color' => ['argb' => '00000000'],
                            ],
                        ]
                    ]
                );
                $event->sheet->styleCells(
                    'E7:E'.$this->borderForNomor,
                    [
                        'borders' => [
                            'outline' => [
                                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                                'color' => ['argb' => '00000000'],
                            ],
                        ]
                    ]
                );
                $event->sheet->styleCells(
                    'F7:F'.$this->borderForNomor,
                    [
                        'borders' => [
                            'outline' => [
                                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                                'color' => ['argb' => '00000000'],
                            ],
                        ]
                    ]
                );
                $event->sheet->styleCells(
                    'G7:G'.$this->borderForNomor,
                    [
                        'borders' => [
                            'outline' => [
                                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                                'color' => ['argb' => '00000000'],
                            ],
                        ]
                    ]
                );
                $event->sheet->styleCells(
                    'H7:H'.$this->borderForNomor,
                    [
                        'borders' => [
                            'outline' => [
                                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                                'color' => ['argb' => '00000000'],
                            ],
                        ]
                    ]
                );
                $event->sheet->styleCells(
                    'I7:I'.$this->borderForNomor,
                    [
                        'borders' => [
                            'outline' => [
                                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                                'color' => ['argb' => '00000000'],
                            ],
                        ]
                    ]
                );
                $event->sheet->styleCells(
                    'J7:J'.$this->borderForNomor,
                    [
                        'borders' => [
                            'outline' => [
                                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                                'color' => ['argb' => '00000000'],
                            ],
                        ]
                    ]
                );
                for ($i=1; $i<=$this->borderForJumlahPertanyaan; $i++) {
                    $this->temp = 7+$i;
                    $event->sheet->styleCells(
                        'A'.$this->temp.':J'.$this->temp,
                        [
                            'borders' => [
                                'outline' => [
                                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                                    'color' => ['argb' => '00000000'],
                                ],
                            ]
                        ]
                    );
                }
            },
        ];
    }

    public function view(): View
    {
        $hasil = Hasil::whereYear('created_at', '=', $this->tahun)
            ->get();

        $jumlahPertanyan   = $hasil->count();

        $this->borderForNomor = 7+$jumlahPertanyaan;
        $this->borderForJumlahPertanyaan = $jumlahPertanyaan;

        $data = [
            'kode_soal'         => $kodeSoal,
            'jumlah_pertanyaan' => $jumlahPertanyaan
        ];

        return view('prodi.pmb.soal.export', [
            'data' => $data
        ]);
    }
}
