<?php

namespace App\Http\Controllers\Dosen;

use Request;
use DataTables;
use App\Pertanyaan;
use App\Services\PertanyaanService;
use App\Http\Controllers\Controller;
use App\Repositories\SoalRepository;
use App\Http\Requests\PertanyaanRequest;
use App\Repositories\PertanyaanRepository;

class PertanyaanController extends Controller
{
    private $kodesoalpertanyaan;
    private $pertanyaanServe;
    private $pertanyaanRepo;
    private $soalRepo;

    public function __construct(
        PertanyaanRepository $pertanyaanRepository,
        SoalRepository $soalRepository,
        PertanyaanService $pertanyaanService
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
        $kodesoal = Request::segment(3);

        $pertanyaan = $this
            ->pertanyaanRepo
            ->getAllData($kodesoal);

        return DataTables::of($pertanyaan)
            ->addColumn('action', function($pertanyaan){
                return '<center><a href="/dosen/pertanyaan/'.$pertanyaan->kode_soal.'/form-ubah/'.$pertanyaan->id.'" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i></a> <a href="#hapus" onclick="destroy('.$pertanyaan->id.')" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a></center>';
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
        
        return view('dosen.pertanyaan.pertanyaan', compact(
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
        $kodesoal = Request::segment(3);

        $checkPertanyaan = $this
            ->pertanyaanRepo
            ->getSingleDataForChecking($kodesoal)
            ->count();

        $totalPertanyaanSigned = $checkPertanyaan;

        $soal = $this
            ->soalRepo
            ->getSingleData($kodesoal)
            ->first();

        $namaMataKuliah     = $soal->nama_mata_kuliah;
        $namaJenisUjian     = $soal->nama_jenis_ujian;
        $jumlahpertanyaan   = $soal->jumlah_pertanyaan;

        $sisapertanyaan = $jumlahpertanyaan - $totalPertanyaanSigned;

        return view('dosen.pertanyaan.form_tambah', compact(
            'soal', 
            'kodesoal', 
            'namaMataKuliah', 
            'namaJenisUjian', 
            'sisapertanyaan'
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
        $jumlahpertanyaan = $pertanyaanReq->jumlah_pertanyaan;
        
        for ($i=0; $i<$jumlahpertanyaan; $i++){;
            $kodesoal = $pertanyaanReq->kode_soal;
            $pertanyaan = $pertanyaanReq->pertanyaan[$i];
            $jenispertanyaan = $pertanyaanReq->jenis_pertanyaan[$i];
            $pilihanA = $pertanyaanReq->pilihan_a[$i];
            $pilihanB = $pertanyaanReq->pilihan_b[$i];
            $pilihanC = $pertanyaanReq->pilihan_c[$i];
            $pilihanD = $pertanyaanReq->pilihan_d[$i];
            $pilihanE = $pertanyaanReq->pilihan_e[$i];
            $jawabanessay = $pertanyaanReq->jawaban_essay[$i];
            $jawabanpilihan = $pertanyaanReq->jawaban_pilihan[$i];
            $bobot = $pertanyaanReq->bobot[$i];
            $jenispertanyaan = $pertanyaanReq->jenis_pertanyaan[$i];
            $filegambar  = $pertanyaanReq->gambar;

            if($jenispertanyaan == 'essay'){
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
                        'jawaban_essay' => $jawabanessay,
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
                        'jawaban_essay' => $jawabanessay,
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
                        'jawaban_essay' => NULL,
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
                        'jawaban_essay' => NULL,
                        'bobot' => $bobot,
                    ];
                }
            }
        }
        
        $store = $this
            ->pertanyaanRepo
            ->storePertanyaanData($data);

        return redirect('/dosen/pertanyaan/'.$kodesoal);
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

        $soal = $this
            ->soalRepo
            ->getSingleData($kodesoal)
            ->first();

        $namaMataKuliah = $soal->nama_mata_kuliah;
        $namaJenisUjian = $soal->nama_jenis_ujian;

        return view('dosen.pertanyaan.form_ubah', compact(
            'kodesoal', 'pertanyaan', 'namaMataKuliah', 'namaJenisUjian'
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
        $jawabanEssay = $pertanyaanReq->jawaban_essay;
        $jawabanPilihan = $pertanyaanReq->jawaban_pilihan;
        $bobot = $pertanyaanReq->bobot;
        $jenisPertanyaan = $pertanyaanReq->jenis_pertanyaan;
        //image *upload file*
        $fileGambar  = $pertanyaanReq->file('gambar');

        //check if jenis pertanyaan essay or pilihan
        if($jenisPertanyaan == 'essay'){
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
                    'jawaban_essay' => $jawabanEssay,
                    'jawaban_pilihan' => NULL,
                    'bobot' => $bobot,
                ];

                $store = $this
                    ->pertanyaanRepo
                    ->updatePertanyaanData($data, $id);

                return redirect('/dosen/pertanyaan/'.$kodeSoal);
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
                        'jawaban_essay' => $jawabanEssay,
                        'jawaban_pilihan' => NULL,
                        'bobot' => $bobot,
                        'gambar' => $namaGambar
                    ];

                    $update = $this
                        ->pertanyaanRepo
                        ->updatePertanyaanData($data, $id);

                    $uploadFileGambar = $this
                        ->pertanyaanServe
                        ->handleUploadGambar($fileGambar, $namaGambar);

                    return redirect('/dosen/pertanyaan/'.$kodeSoal);
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
                        'jawaban_essay' => $jawabanEssay,
                        'jawaban_pilihan' => NULL,
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

                    return redirect('/dosen/pertanyaan/'.$kodeSoal);
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
                    'jawaban_essay' => NULL,
                    'jawaban_pilihan' => $jawabanPilihan,
                    'bobot' => $bobot,
                ];

                $update = $this
                    ->pertanyaanRepo
                    ->updatePertanyaanData($data, $id);

                return redirect('/dosen/pertanyaan/'.$kodeSoal);
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
                        'jawaban_essay' => NULL,
                        'jawaban_pilihan' => $jawabanPilihan,
                        'bobot' => $bobot,
                        'gambar' => $namaGambar
                    ];

                    $store = $this
                        ->pertanyaanRepo
                        ->updatePertanyaanData($data, $id);

                    $uploadGambar = $this
                        ->pertanyaanServe
                        ->handleUploadGambar($fileGambar, $namaGambar);
                        
                    return redirect('/dosen/pertanyaan/'.$kodeSoal);
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
                        'jawaban_essay' => NULL,
                        'jawaban_pilihan' => $jawabanPilihan,
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
                        
                    return redirect('/dosen/pertanyaan/'.$kodeSoal);
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
