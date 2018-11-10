<?php

namespace App\Http\Controllers\Prodi\PMB\Pertanyaan;

use Excel;
use Request;
use DataTables;
use App\Services\PertanyaanService;
use App\Http\Controllers\Controller;
use App\Imports\Prodi\PMB\PertanyaanImport;
use App\Repositories\Prodi\PMB\SoalRepository;
use App\Http\Requests\Prodi\PMB\PertanyaanRequest;
use App\Repositories\Prodi\PMB\PertanyaanRepository;

class PertanyaanController extends Controller
{
    private $soalRepo;
    private $pertanyaanServe;
    private $pertanyaanRepo;

    public function __construct(
        SoalRepository $soalRepository,
        PertanyaanService $pertanyaanService,
        PertanyaanRepository $pertanyaanRepository
    ) {
        $this->soalRepo = $soalRepository;
        $this->pertanyaanServe = $pertanyaanService;
        $this->pertanyaanRepo = $pertanyaanRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function data()
    {
        $kodesoal = Request::segment(5);

        $pertanyaan = $this
            ->pertanyaanRepo
            ->getAllData($kodesoal);

        return DataTables::of($pertanyaan)
            ->addColumn('action', function($pertanyaan){
                return '<center><a href="/prodi/pmb/soal/pertanyaan/'.$pertanyaan->kode_soal.'/form-ubah/'.$pertanyaan->id.'" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i></a> <a href="#hapus" onclick="destroy('.$pertanyaan->id.')" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a></center>';
            })
            ->editColumn('pertanyaan', function($pertanyaan){
                return $pertanyaan->pertanyaan;
            })
            ->rawColumns(['action', 'pertanyaan'])
            ->make(true);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($kodesoal)
    {
        $tempkodesoal = $kodesoal;
        
        return view('prodi.pmb.soal.pertanyaan.pertanyaan', compact(
            'tempkodesoal'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kodesoal = Request::segment(5);

        $checkPertanyaan = $this
            ->pertanyaanRepo
            ->getSingleDataForChecking($kodesoal)
            ->count();

        $totalPertanyaanSigned = $checkPertanyaan;

        $soal = $this
            ->soalRepo
            ->getSingleData($kodesoal)
            ->first();

        $jumlahpertanyaan   = $soal->jumlah_pertanyaan;
        $nomor = 1;

        $sisapertanyaan = $jumlahpertanyaan - $totalPertanyaanSigned;

        return view('prodi.pmb.soal.pertanyaan.form_tambah', compact(
            'soal', 
            'kodesoal',
            'sisapertanyaan',
            'nomor'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PertanyaanRequest $pertanyaanReq)
    {
        $metode     = $pertanyaanReq->metode;
        $kode_soal  = $pertanyaanReq->kode_soal;
        $jumlahpertanyaan = $pertanyaanReq->jumlah_pertanyaan;

        if($metode == 'form'){
            for ($i=0; $i<$jumlahpertanyaan; $i++){;
                $kodesoal = $pertanyaanReq->kode_soal;
                $pertanyaan = $pertanyaanReq->pertanyaan[$i];
                $jenispertanyaan = $pertanyaanReq->jenis_pertanyaan[$i];
                $pilihanA = $pertanyaanReq->pilihan_a[$i];
                $pilihanB = $pertanyaanReq->pilihan_b[$i];
                $pilihanC = $pertanyaanReq->pilihan_c[$i];
                $pilihanD = $pertanyaanReq->pilihan_d[$i];
                $pilihanE = $pertanyaanReq->pilihan_e[$i];
                $jawabanBenarSalah = $pertanyaanReq->jawaban_benar_salah[$i];
                $jawabanpilihan = $pertanyaanReq->jawaban_pilihan[$i];
                $bobot = $pertanyaanReq->bobot[$i];
                $jenispertanyaan = $pertanyaanReq->jenis_pertanyaan[$i];
                $filegambar  = $pertanyaanReq->gambar;

                if($jenispertanyaan == 'Benar-Salah'){
                    if(!empty($filegambar[$i])){
                        $namagambar  = $pertanyaanReq
                            ->gambar[$i]
                            ->getClientOriginalName();

                        $filegambar  = $pertanyaanReq->gambar[$i];

                        $data[] = [
                            'kode_soal' => $kodesoal,
                            'pertanyaan' => $pertanyaan,
                            'jenis_pertanyaan' => $jenispertanyaan,
                            'gambar'    => $namagambar,
                            'pilihan_a' => NULL,
                            'pilihan_b' => NULL,
                            'pilihan_c' => NULL,
                            'pilihan_d' => NULL,
                            'pilihan_e' => NULL,
                            'jawaban_pilihan' => NULL,
                            'jawaban_benar_salah' => $jawabanBenarSalah,
                            'bobot' => $bobot,
                        ];

                        $uploadGambar = $this
                            ->pertanyaanServe
                            ->handleUploadGambar($filegambar, $namagambar);
                    }else{
                        $data[] = [
                            'kode_soal' => $kodesoal,
                            'pertanyaan' => $pertanyaan,
                            'jenis_pertanyaan' => $jenispertanyaan,
                            'gambar'    => NULL,
                            'pilihan_a' => NULL,
                            'pilihan_b' => NULL,
                            'pilihan_c' => NULL,
                            'pilihan_d' => NULL,
                            'pilihan_e' => NULL,
                            'jawaban_pilihan' => NULL,
                            'jawaban_benar_salah' => $jawabanBenarSalah,
                            'bobot' => $bobot,
                        ];
                    }
                }else{
                    if(!empty($filegambar[$i])){
                        $namagambar  = $pertanyaanReq
                            ->gambar[$i]
                            ->getClientOriginalName();

                        $filegambar  = $pertanyaanReq->gambar[$i];

                        $data[] = [
                            'kode_soal' => $kodesoal,
                            'pertanyaan' => $pertanyaan,
                            'jenis_pertanyaan' => $jenispertanyaan,
                            'gambar'    => $namagambar,
                            'pilihan_a' => $pilihanA,
                            'pilihan_b' => $pilihanB,
                            'pilihan_c' => $pilihanC,
                            'pilihan_d' => $pilihanD,
                            'pilihan_e' => $pilihanE,
                            'jawaban_pilihan' => $jawabanpilihan,
                            'jawaban_benar_salah' => NULL,
                            'bobot' => $bobot,
                        ];

                        $uploadGambar = $this
                            ->pertanyaanServe
                            ->handleUploadGambar($filegambar, $namagambar);
                    }else{
                        $data[] = [
                            'kode_soal' => $kodesoal,
                            'pertanyaan' => $pertanyaan,
                            'jenis_pertanyaan' => $jenispertanyaan,
                            'gambar'    => NULL,
                            'pilihan_a' => $pilihanA,
                            'pilihan_b' => $pilihanB,
                            'pilihan_c' => $pilihanC,
                            'pilihan_d' => $pilihanD,
                            'pilihan_e' => $pilihanE,
                            'jawaban_pilihan' => $jawabanpilihan,
                            'jawaban_benar_salah' => NULL,
                            'bobot' => $bobot,
                        ];
                    }
                }
            }
        
            $store = $this
                ->pertanyaanRepo
                ->storePertanyaanData($data);

            return redirect('/prodi/pmb/soal/pertanyaan/'.$kode_soal);
        }else{
            $file_spreadsheet = $pertanyaanReq->file('file_spreadsheet');
            $namaFile = $file_spreadsheet->getClientOriginalName();

            $upload = Excel::import(new PertanyaanImport($kode_soal), $file_spreadsheet);

            return redirect('/prodi/pmb/soal/pertanyaan/'.$kode_soal);
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
    public function edit($kodesoal, $id)
    {
        $pertanyaan = $this
                ->pertanyaanRepo
                ->getSingleData($id);

        return view('prodi.pmb.soal.pertanyaan.form_ubah', compact(
            'kodesoal', 'pertanyaan'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PertanyaanRequest $pertanyaanReq, $kodsoal, $id)
    {
        //define variables
        $kodeSoal = $pertanyaanReq->kode;
        $pertanyaan = $pertanyaanReq->pertanyaan;
        $jenisPertanyaan = $pertanyaanReq->jenis_pertanyaan;
        $pilihanA = $pertanyaanReq->pilihan_a;
        $pilihanB = $pertanyaanReq->pilihan_b;
        $pilihanC = $pertanyaanReq->pilihan_c;
        $pilihanD = $pertanyaanReq->pilihan_d;
        $pilihanE = $pertanyaanReq->pilihan_e;
        $jawabanPilihan = $pertanyaanReq->jawaban_pilihan;
        $jawabanBenarSalah = $pertanyaanReq->jawaban_benar_salah;
        $bobot = $pertanyaanReq->bobot;

        //image *upload file*
        $fileGambar  = $pertanyaanReq->file('gambar');

        if($jenisPertanyaan == 'benar_salah'){
            if($fileGambar == NULL){
                $data = [
                    'kode_soal' => $kodeSoal,
                    'pertanyaan' => $pertanyaan,
                    'jenis_pertanyaan' => $jenisPertanyaan,
                    'pilihan_a' => NULL,
                    'pilihan_b' => NULL,
                    'pilihan_c' => NULL,
                    'pilihan_d' => NULL,
                    'pilihan_e' => NULL,
                    'jawaban_pilihan' => NULL,
                    'jawaban_benar_salah' => $jawabanBenarSalah,
                    'bobot' => $bobot,
                ];

                $store = $this
                    ->pertanyaanRepo
                    ->updatePertanyaanData($data, $id);

                return redirect('/prodi/pmb/soal/pertanyaan/'.$kodeSoal);
            }else{
                $checkPertanyaan = $this
                    ->pertanyaanRepo
                    ->getSingleData($id);

                $fileGambarLama = $checkPertanyaan->gambar;
                $namaGambar = $fileGambar->getClientOriginalName();
                
                if($fileGambarLama == NULL){
                    $data = [
                        'kode_soal' => $kodeSoal,
                        'pertanyaan' => $pertanyaan,
                        'jenis_pertanyaan' => $jenisPertanyaan,
                        'pilihan_a' => NULL,
                        'pilihan_b' => NULL,
                        'pilihan_c' => NULL,
                        'pilihan_d' => NULL,
                        'pilihan_e' => NULL,
                        'jawaban_pilihan' => NULL,
                        'jawaban_benar_salah' => $jawabanBenarSalah,
                        'bobot' => $bobot,
                        'gambar' => $namaGambar
                    ];

                    $update = $this
                        ->pertanyaanRepo
                        ->updatePertanyaanData($data, $id);

                    $uploadFileGambar = $this
                        ->pertanyaanServe
                        ->handleUploadGambar($fileGambar, $namaGambar);

                    return redirect('/prodi/pmb/soal/pertanyaan/'.$kodeSoal);
                }else{
                    $data = [
                        'kode_soal' => $kodeSoal,
                        'pertanyaan' => $pertanyaan,
                        'jenis_pertanyaan' => $jenisPertanyaan,
                        'pilihan_a' => NULL,
                        'pilihan_b' => NULL,
                        'pilihan_c' => NULL,
                        'pilihan_d' => NULL,
                        'pilihan_e' => NULL,
                        'jawaban_benar_salah' => NULL,
                        'jawaban_pilihan' => $jawabanPilihan,
                        'bobot' => $bobot,
                        'gambar' => $namaGambar
                    ];
                    
                    $update = $this
                        ->pertanyaanRepo
                        ->updatePertanyaanData($data, $id);

                    $deleteFileGambar = $this
                        ->pertanyaanServe
                        ->handleDeleteGambar($fileGambarLama);

                    $uploadFileGambar = $this
                        ->pertanyaanServe
                        ->handleUploadGambar($fileGambar, $namaGambar);

                    return redirect('/prodi/pmb/soal/pertanyaan/'.$kodeSoal);
                }
            }
        }else{
            if($fileGambar == NULL){
                $data = [
                    'kode_soal' => $kodeSoal,
                    'pertanyaan' => $pertanyaan,
                    'jenis_pertanyaan' => $jenisPertanyaan,
                    'pilihan_a' => $pilihanA,
                    'pilihan_b' => $pilihanB,
                    'pilihan_c' => $pilihanC,
                    'pilihan_d' => $pilihanD,
                    'pilihan_e' => $pilihanE,
                    'jawaban_pilihan' => $jawabanPilihan,
                    'jawaban_benar_salah' => NULL,
                    'bobot' => $bobot,
                ];

                $update = $this
                    ->pertanyaanRepo
                    ->updatePertanyaanData($data, $id);

                return redirect('/prodi/pmb/soal/pertanyaan/'.$kodeSoal);
            }else{
                $checkPertanyaan = $this
                    ->pertanyaanRepo
                    ->getSingleData($id);

                $fileGambarLama = $checkPertanyaan->gambar;
                $namaGambar = $fileGambar->getClientOriginalName();

                if($fileGambarLama == NULL){
                    $data = [
                        'kode_soal' => $kodeSoal,
                        'pertanyaan' => $pertanyaan,
                        'jenis_pertanyaan' => $jenisPertanyaan,
                        'pilihan_a' => $pilihanA,
                        'pilihan_b' => $pilihanB,
                        'pilihan_c' => $pilihanC,
                        'pilihan_d' => $pilihanD,
                        'pilihan_e' => $pilihanE,
                        'jawaban_pilihan' => $jawabanPilihan,
                        'jawaban_benar_salah' => NULL,
                        'bobot' => $bobot,
                        'gambar' => $namaGambar
                    ];

                    $store = $this
                        ->pertanyaanRepo
                        ->updatePertanyaanData($data, $id);

                    $uploadGambar = $this
                        ->pertanyaanServe
                        ->handleUploadGambar($fileGambar, $namaGambar);
                        
                    return redirect('/prodi/pmb/soal/pertanyaan/'.$kodeSoal);
                }else{
                    $data = [
                        'kode_soal' => $kodeSoal,
                        'pertanyaan' => $pertanyaan,
                        'jenis_pertanyaan' => $jenisPertanyaan,
                        'pilihan_a' => $pilihanA,
                        'pilihan_b' => $pilihanB,
                        'pilihan_c' => $pilihanC,
                        'pilihan_d' => $pilihanD,
                        'pilihan_e' => $pilihanE,
                        'jawaban_pilihan' => $jawabanPilihan,
                        'jawaban_benar_salah' => NULL,
                        'bobot' => $bobot,
                        'gambar' => $namaGambar
                    ];

                    $store = $this
                        ->pertanyaanRepo
                        ->updatePertanyaanData($data, $id);

                    $deleteFileGambar = $this
                        ->pertanyaanServe
                        ->handleDeleteGambar($fileGambarLama);

                    $uploadGambar = $this
                        ->pertanyaanServe
                        ->handleUploadGambar($fileGambar, $namaGambar);
                        
                    return redirect('/prodi/pmb/soal/pertanyaan/'.$kodeSoal);
                }
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($kodesoal, $id)
    {
        $pertanyaan = $this
                ->pertanyaanRepo
                ->getSingleData($id);

        $namaGambar = $pertanyaan->gambar;

        if($namaGambar == null){
            $destroy = $this
                ->pertanyaanRepo
                ->destroyPertanyaanData($id);
        }else{
            $deleteFileGambar = $this
                ->pertanyaanServe
                ->handleDeleteGambar($namaGambar);

            $destroy = $this
                ->pertanyaanRepo
                ->destroyPertanyaanData($id);
        }

        return response()
            ->json([
                'gambar' => $destroy
            ], 200);
    }
}
