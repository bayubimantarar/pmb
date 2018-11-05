<?php

namespace App\Http\Controllers\Mahasiswa;

use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Services\PertanyaanService;
use App\Http\Controllers\Controller;
use App\Repositories\SoalRepository;
use App\Repositories\HasilRepository;
use App\Repositories\TokenRepository;
use App\Repositories\JawabanRepository;
use App\Repositories\PertanyaanRepository;
use App\Http\Requests\Mahasiswa\SoalRequest;
use App\Http\Requests\Mahasiswa\UjianRequest;

class SoalController extends Controller
{
    private $soalRepo;
    private $tokenRepo;
    private $hasilRepo;
    private $jawabanRepo;
    private $pertanyaanRepo;
    private $pertanyaanServe;

    public function __construct(
        SoalRepository $soalRepository,
        TokenRepository $tokenRepo,
        PertanyaanRepository $pertanyaanRepo,
        JawabanRepository $jawabanRepository,
        HasilRepository $hasilRepository,
        PertanyaanService $pertanyaanService
    ) {
        $this->soalRepo         = $soalRepository;
        $this->tokenRepo        = $tokenRepo;
        $this->pertanyaanRepo   = $pertanyaanRepo;
        $this->jawabanRepo      = $jawabanRepository;
        $this->hasilRepo        = $hasilRepository;
        $this->pertanyaanServe  = $pertanyaanService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('mahasiswa.ujian.cari_soal');
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
    public function store(UjianRequest $request)
    {
        $totalPertanyaan = $request->total_pertanyaan;

        for($i=0; $i<$totalPertanyaan; $i++){
            $nim = $request->nim;
            $kodesoal = $request->kode_soal;

            $jenispertanyaan    = $request->jenis_pertanyaan[$i];
            $nomorpertanyaan    = $request->nomor_pertanyaan[$i];
            $jawabanessay       = $request->jawaban_essay;
            $jawabanpilihan     = $request->jawaban_pilihan;
            $createdAt          = Carbon::now();
            $filegambar  = $request->gambar;

            if(!empty($filegambar[$i])){
                $namagambar  = $request
                    ->gambar[$i]
                    ->getClientOriginalName();

                $namagambarfull = $kodesoal.''.$nim.''.$nomorpertanyaan.''.$namagambar;

                $filegambar  = $request->gambar[$i];

                $uploadGambar = $this
                    ->pertanyaanServe
                    ->handleUploadGambar($filegambar, $namagambarfull);
                    
                if($jenispertanyaan == 'essay'){
                    if(!empty($jawabanessay[$i])){
                        $data[] = [
                            'kode_soal' => $kodesoal,
                            'nomor_pertanyaan' => $nomorpertanyaan,
                            'nim' => $nim,
                            'jawaban_essay' => $jawabanessay[$i],
                            'jawaban_pilihan' => NULL,
                            'gambar' => $namagambarfull,
                            'created_at' => $createdAt,
                            'updated_at' => $createdAt
                        ];
                    }else{
                        $data[] = [
                            'kode_soal' => $kodesoal,
                            'nomor_pertanyaan' => $nomorpertanyaan,
                            'nim' => $nim,
                            'jawaban_essay' => NULL,
                            'jawaban_pilihan' => NULL,
                            'gambar' => $namagambarfull,
                            'created_at' => $createdAt,
                            'updated_at' => $createdAt
                        ];
                    }
                }else{
                    if(!empty($jawabanpilihan[$i])){
                        $data[] = [
                            'kode_soal' => $kodesoal,
                            'nomor_pertanyaan' => $nomorpertanyaan,
                            'nim' => $nim,
                            'jawaban_essay' => NULL,
                            'jawaban_pilihan' => $jawabanpilihan[$i],
                            'gambar' => $namagambarfull,
                            'created_at' => $createdAt,
                            'updated_at' => $createdAt
                        ];
                    }else{
                        $data[] = [
                            'kode_soal' => $kodesoal,
                            'nomor_pertanyaan' => $nomorpertanyaan,
                            'nim' => $nim,
                            'jawaban_essay' => NULL,
                            'jawaban_pilihan' => NULL,
                            'gambar' => $namagambarfull,
                            'created_at' => $createdAt,
                            'updated_at' => $createdAt
                        ];
                    }
                }
            }else{
                if($jenispertanyaan == 'essay'){
                    if(!empty($jawabanessay[$i])){
                        $data[] = [
                            'kode_soal' => $kodesoal,
                            'nomor_pertanyaan' => $nomorpertanyaan,
                            'nim' => $nim,
                            'jawaban_essay' => $jawabanessay[$i],
                            'jawaban_pilihan' => NULL,
                            'gambar' => NULL,
                            'created_at' => $createdAt,
                            'updated_at' => $createdAt
                        ];
                    }else{
                        $data[] = [
                            'kode_soal' => $kodesoal,
                            'nomor_pertanyaan' => $nomorpertanyaan,
                            'nim' => $nim,
                            'jawaban_essay' => NULL,
                            'jawaban_pilihan' => NULL,
                            'gambar' => NULL,
                            'created_at' => $createdAt,
                            'updated_at' => $createdAt
                        ];
                    }
                }else{
                    if(!empty($jawabanpilihan[$i])){
                        $data[] = [
                            'kode_soal' => $kodesoal,
                            'nomor_pertanyaan' => $nomorpertanyaan,
                            'nim' => $nim,
                            'jawaban_essay' => NULL,
                            'jawaban_pilihan' => $jawabanpilihan[$i],
                            'gambar' => NULL,
                            'created_at' => $createdAt,
                            'updated_at' => $createdAt
                        ];
                    }else{
                        $data[] = [
                            'kode_soal' => $kodesoal,
                            'nomor_pertanyaan' => $nomorpertanyaan,
                            'nim' => $nim,
                            'jawaban_essay' => NULL,
                            'jawaban_pilihan' => NULL,
                            'gambar' => NULL,
                            'created_at' => $createdAt,
                            'updated_at' => $createdAt
                        ];
                    }
                }
            }
        }

        $dataHasil = [
            'kode_soal' => $kodesoal,
            'nim'       => $nim,
            'status'    => 0
        ];
        
        $store = $this
            ->jawabanRepo
            ->storeJawabanData($data);
        
        $storeHasil = $this
            ->hasilRepo
            ->storeHasilData($dataHasil);

        return redirect('/mahasiswa');
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function find(SoalRequest $soalReq)
    // {
    //     $token = $soalReq->token;

    //     $dataSoal = $this
    //         ->tokenRepo
    //         ->getSingleDataForSoal($token);

    //     $kodeSoal = $dataSoal->kode_soal;

    //     $dataPertanyaan = $this
    //         ->pertanyaanRepo
    //         ->getAllDataBySoal($kodeSoal);

    //     $i = 1;

    //     return view('mahasiswa.ujian.form_soal', compact(
    //         'dataPertanyaan', 'i'
    //     ));
    // }
    
    public function find()
    {
        $kodesoal = \Request::get('kode_soal');

        $dataPertanyaan = $this
            ->pertanyaanRepo
            ->getAllDataBySoal($kodesoal);

        $detailSoal = $this
            ->pertanyaanRepo
            ->getAllDataBySoal($kodesoal)
            ->first();

        $kodesoal       = $detailSoal->kode_soal; 
        $semester       = $detailSoal->semester;
        $tahun          = $detailSoal->tahun;
        $nip            = $detailSoal->nip;
        $kelas          = $detailSoal->nama_kelas;
        $matakuliah     = $detailSoal->nama_mata_kuliah;
        $dosen          = $detailSoal->nama_dosen;
        $jenisujian     = $detailSoal->nama_jenis_ujian;
        $tanggalmulaiujian      = $detailSoal->tanggal_mulai_ujian->formatLocalized('%A'.', '.'%d %B %Y');
        $tanggalselesaiujian    = $detailSoal->tanggal_selesai_ujian->formatLocalized('%A'.', '.'%d %B %Y');
        $durasi                 = $detailSoal->durasi_ujian;
        $nim = Auth::Guard('mahasiswa')->User()->nim;
        $tanggalsekarang = Carbon::now();

        $totalPertanyaan = $dataPertanyaan
            ->count();

        $checkMahasiswaHasExam = $this
            ->jawabanRepo
            ->checkMahasiswaHasExam($nim, $kodesoal);

        if(
            $tanggalsekarang >= $detailSoal->tanggal_mulai_ujian && 
            $tanggalsekarang <= $detailSoal->tanggal_selesai_ujian &&
            empty($checkMahasiswaHasExam)
        ) {
            $hasExam    = 1;
            $examDate   = 1;
                
            return view('mahasiswa.ujian.soal', compact(
                'hasExam',
                'examDate',
                'kodesoal',
                'matakuliah',
                'token'
            ));
        }else{
            $hasExam    = 0;
            $examDate   = 0;

            return view('mahasiswa.ujian.soal', compact(
                'hasExam',
                'examDate',
                'kodesoal',
                'matakuliah',
                'token'
            ));
        }
    }

    public function checkToken($token)
    {
        $checkSoal = $this
            ->tokenRepo
            ->getSingleDataForSoal($token);

        if(!empty($checkSoal)){
            $status     = $checkSoal->status;
            $kodesoal   = $checkSoal->kode_soal;
            $token      = $checkSoal->token;
            if($status == 1){
                return response()->json([
                    'active' => true,
                    'data' => [
                        'kode_soal' => $kodesoal,
                        'token'     => $token
                    ]
                ], 200);
            }else{
                return response()->json([
                    'active' => false
                ], 200);
            }
        }else{
            return response()->json([
                'active' => false
            ], 200);
        }
    }

    public function startExam($kodeSoal, $token)
    {
        $dataSoal = $this
            ->tokenRepo
            ->getSingleDataForSoal($token);

        $kodeSoal   = $dataSoal->kode_soal;

        $dataPertanyaan = $this
            ->pertanyaanRepo
            ->getAllDataBySoal($kodeSoal);

        $detailSoal = $this
            ->pertanyaanRepo
            ->getAllDataBySoal($kodeSoal)
            ->first();

        $kodesoal               = $detailSoal->kode_soal; 
        $jenispertanyaan        = $detailSoal->jenis_pertanyaan;
        $semester               = $detailSoal->semester;
        $tahun                  = $detailSoal->tahun;
        $nip                    = $detailSoal->nip;
        $kelas                  = $detailSoal->nama_kelas;
        $matakuliah             = $detailSoal->nama_mata_kuliah;
        $dosen                  = $detailSoal->nama_dosen;
        $jenisujian             = $detailSoal->nama_jenis_ujian;
        $tanggalujian           = $detailSoal->tanggal_mulai_ujian->formatLocalized('%A'.', '.'%d %B %Y');
        $tanggalselesaiujian    = $detailSoal->tanggal_selesai_ujian;
        $durasi                 = $detailSoal->durasi_ujian;

        $tanggal_sekarang = Carbon::now();

        $totalPertanyaan = $dataPertanyaan->count();

        $nim = Auth::Guard('mahasiswa')->User()->nim;

        $checkMahasiswaHasExam = $this
            ->jawabanRepo
            ->checkMahasiswaHasExam($nim, $kodesoal);

        if(!empty($checkMahasiswaHasExam)){
            abort(404);
        }else{
            if($dataSoal->status == 0){
                abort(404);
            }else{
                $nomorsoal = 1;
                $i = 0;
                $hasExam = true;

                return view('mahasiswa.ujian.form_soal', compact(
                    'dataPertanyaan',
                    'totalPertanyaan', 
                    'jenispertanyaan',
                    'i', 
                    'hasExam',
                    'nomorsoal',
                    'nip',
                    'jenisujian',
                    'tanggalselesaiujian',
                    'durasiujian',
                    'tanggalujian',
                    'durasiujian',
                    'durasi',
                    'kodesoal',
                    'tahun',
                    'semester',
                    'kelas',
                    'matakuliah',
                    'dosen'
                ));
            }
        }
    }
}
