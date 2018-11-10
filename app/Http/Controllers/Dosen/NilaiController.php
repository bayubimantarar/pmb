<?php

namespace App\Http\Controllers\Dosen;

use Request;
use App\Hasil;
use DataTables;
use App\Http\Controllers\Controller;
use App\Repositories\JawabanRepository;
use App\Repositories\HasilRepository;
use App\Repositories\PertanyaanRepository;
use App\Http\Requests\Dosen\PeriksaRequest;

class NilaiController extends Controller
{
    private $hasilRepo;
    private $jawabanRepo;
    private $pertanyaanRepo;

    public function __construct(
        JawabanRepository $jawabanRepository,
        PertanyaanRepository $pertanyaanRepository,
        HasilRepository $hasilRepository
    ) {
        $this->jawabanRepo      = $jawabanRepository;
        $this->pertanyaanRepo   = $pertanyaanRepository;
        $this->hasilRepo        = $hasilRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function data()
    {
        $kodesoal = Request::segment(3);

        $jawaban = $this
            ->jawabanRepo
            ->getSingleDataByDosenForNilai($kodesoal);

        return DataTables::of($jawaban)
            ->editColumn('nilai_angka', function($jawaban){
                if($jawaban->nilai_angka == NULL){
                    return '<center><span class="label label-danger">Belum diperiksa</span></center>';
                }else{
                    return $jawaban->nilai_angka;
                }
            })
            ->editColumn('nilai_huruf', function($jawaban){
                if($jawaban->nilai_angka == NULL){
                    return '<center><span class="label label-danger">Belum diperiksa</span></center>';
                }else{
                    return $jawaban->nilai_huruf;
                }
            })
            ->rawColumns(['nilai_angka', 'nilai_huruf'])
            ->make(true);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($kodesoal)
    {
        return view('dosen.nilai.nilai', compact(
            'kodesoal'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkAnswer()
    {
        $kodesoal   = Request::segment(3);
        $nim        = Request::segment(4);
        $i          = 0;
        $nomorsoal  = 1;
        $nomorsoalpertanyaan = 1;

        $dataPertanyaan = $this
            ->pertanyaanRepo
            ->getAllDataBySoal($kodesoal);

        $jumlahpertanyaan = $dataPertanyaan->first()->jumlah_pertanyaan;

        $dataJawaban = $this
            ->jawabanRepo
            ->getSingleDataByDosenForPeriksaJawaban($nim, $kodesoal);

        return view('dosen.periksa.form_periksa', compact(
            'nim',
            'kodesoal',
            'nomorsoal',
            'nomorsoalpertanyaan',
            'jumlahpertanyaan',
            'dataPertanyaan',
            'dataJawaban'
        ));
    }    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PeriksaRequest $periksaReq)
    {
        $jumlahpertanyaan = $periksaReq->jumlah_pertanyaan;
        $nim = $periksaReq->nim;
        $kodesoal = $periksaReq->kode_soal;

        for ($i=0; $i<$jumlahpertanyaan; $i++) {
            $bobotessay         = $periksaReq->bobot_essay;
            $bobotpilihan       = $periksaReq->bobot_pilihan;
            $bobot              = $periksaReq->bobot;
            $jenispertanyaan    = $periksaReq->jenis_pertanyaan[$i];

            if($jenispertanyaan == 'essay'){
                if(!empty($bobot[$i])){
                    $data[] = [
                        'bobot' => $bobot[$i]
                    ];
                }else{
                    $data[] = [
                        'bobot' => 0
                    ];
                }
            }else{
                if(!empty($bobot[$i])){
                    $data[] = [
                        'bobot' => $bobot[$i]
                    ];
                }else{
                    $data[] = [
                        'bobot' => 0
                    ];
                }
            }
        }

        $totalbobot = array_sum(array_column($data, 'bobot'));

        $nilai = ($totalbobot/$jumlahpertanyaan)*10;

        if($nilai>=85 && $nilai<=100){
            $dataHasil = [
                'nilai_angka' => $nilai,
                'nilai_huruf' => 'A',
                'status' => 1
            ];

            $update = $this
                ->hasilRepo
                ->updateHasilData($nim, $kodesoal, $dataHasil);

            return redirect('/dosen');
        }elseif($nilai>=70 && $nilai<=85){
            $dataHasil = [
                'nilai_angka' => $nilai,
                'nilai_huruf' => 'B',
                'status' => 1
            ];

            $update = $this
                ->hasilRepo
                ->updateHasilData($nim, $kodesoal, $dataHasil);

            return redirect('/dosen');
        }elseif($nilai>=55 && $nilai<=70){
            $dataHasil = [
                'nilai_angka' => $nilai,
                'nilai_huruf' => 'C',
                'status' => 1
            ];

            $update = $this
                ->hasilRepo
                ->updateHasilData($nim, $kodesoal, $dataHasil);

            return redirect('/dosen');
        }elseif($nilai>=40 && $nilai<=55){
            $dataHasil = [
                'nilai_angka' => $nilai,
                'nilai_huruf' => 'D',
                'status' => 1
            ];

            $update = $this
                ->hasilRepo
                ->updateHasilData($nim, $kodesoal, $dataHasil);

            return redirect('/dosen');
        }else{
            $dataHasil = [
                'nilai_angka' => $nilai,
                'nilai_huruf' => 'E',
                'status' => 1
            ];

            $update = $this
                ->hasilRepo
                ->updateHasilData($nim, $kodesoal, $dataHasil);

            return redirect('/dosen');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
