<?php

namespace App\Http\Controllers\Dasbor;

use App\Soal;
use Keygen;
use DataTables;
use App\Http\Requests\SoalRequest;
use App\Services\PertanyaanService;
use App\Repositories\SoalRepository;
use App\Http\Controllers\Controller;
use App\Repositories\TokenRepository;
use App\Repositories\KelasRepository;
use App\Repositories\DosenRepository;
use App\Repositories\JenisUjianRepository;
use App\Repositories\MataKuliahRepository;
use App\Repositories\PertanyaanRepository;
use App\Repositories\TahunAjaranRepository;

class SoalController extends Controller
{
    private $soalRepo;
    private $tokenRepo;
    private $dosenRepo;
    private $kelasRepo;
    private $jenisujianRepo;
    private $matakuliahRepo;
    private $pertanyaanRepo;
    private $pertanyaanServe;
    private $tahunajaranRepo;

    public function __construct(
        SoalRepository $soalRepository,
        JenisUjianRepository $jenisujianRepository,
        MataKuliahRepository $matakuliahRepository,
        PertanyaanRepository $pertanyaanRepository,
        TokenRepository $tokenRepository,
        PertanyaanService $pertanyaanService,
        DosenRepository $dosenRepository,
        KelasRepository $kelasRepository,
        TahunAjaranRepository $tahunajaranRepository
    ) {
        $this->soalRepo         = $soalRepository;
        $this->tokenRepo        = $tokenRepository;
        $this->kelasRepo        = $kelasRepository;
        $this->jenisujianRepo   = $jenisujianRepository;
        $this->matakuliahRepo   = $matakuliahRepository;
        $this->pertanyaanRepo   = $pertanyaanRepository;
        $this->pertanyaanServe  = $pertanyaanService;
        $this->dosenRepo        = $dosenRepository;
        $this->tahunajaranRepo  = $tahunajaranRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function data()
    {
        $soal = $this
            ->soalRepo
            ->getAllData();

        return DataTables::of($soal)
            ->addColumn('action', function($soal){
                return '<center><a href="#aktifkan" onclick="aktifkan('.$soal->id.')" class="btn btn-xs btn-success"><i class="fa fa-check"></i></a> <a href="/dasbor/soal/form-ubah/'.$soal->id.'" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i></a> <a href="#hapus" onclick="destroy('.$soal->id.')" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a></center>';
            })
            ->editColumn('status', function($soal){
                if($soal->status == 1){
                    return '<center><span class="label label-success">Sudah diaktifkan</span></center>';
                }else{
                    return '<center><span class="label label-danger">Belum diaktifkan</span></center>';
                }
            })
            ->editColumn('token', function($soal){
                if($soal->status == 1){
                    return $soal->token;
                }else{
                    return '';
                }
            })
            ->rawColumns(['action', 'status', 'token'])
            ->make(true);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dasbor.soal.soal');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jenisujian = $this
            ->jenisujianRepo
            ->getAllData();

        $matakuliah = $this
            ->matakuliahRepo
            ->getAllData();

        $dosen = $this
            ->dosenRepo
            ->getAllData();

        $kelas = $this
            ->kelasRepo
            ->getAllData();

        $tahunajaran = $this
            ->tahunajaranRepo
            ->getAllData();

        return view('dasbor.soal.form_tambah', compact(
            'jenisujian',
            'matakuliah',
            'dosen',
            'kelas',
            'tahunajaran'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SoalRequest $soalReq)
    {
        $kodetahunajaran    = $soalReq->kode_tahun_ajaran;
        $kodekelas          = $soalReq->kode_kelas;
        $kodejenisujian     = $soalReq->kode_jenis_ujian;
        $kodematakuliah     = $soalReq->kode_mata_kuliah;
        $nip                = $soalReq->nip;
        $sifatujian         = $soalReq->sifat_ujian;
        $tanggalujian       = $soalReq->tanggal_ujian;
        $durasiujian        = $soalReq->durasi_ujian;

        dd($soalReq->all());

        // $token = Keygen::numeric(5)
        //     ->generate();

        // $data = [
        //     'kode' => $soalReq->kode,
        //     'kode_jenis_ujian' => $soalReq->kode_jenis_ujian,
        //     'kode_mata_kuliah' => $soalReq->kode_mata_kuliah,
        //     'sifat_ujian' => $soalReq->sifat_ujian,
        //     'durasi_ujian' => $soalReq->durasi_ujian,
        // ];

        // $dataForToken = [
        //     'kode_soal' => $soalReq->kode,
        //     'token' => $token,
        //     'status' => 0
        // ];

        // $store = $this
        //     ->soalRepo
        //     ->storeSoalData($data);

        // $storeForToken = $this
        //     ->tokenRepo
        //     ->storeTokenData($dataForToken);

        // return redirect('/dasbor/soal');
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
        $soal = $this
            ->soalRepo
            ->getSingleDataForEdit($id);

        $tempsoal = $soal;
        
        $jenisujian = $this
            ->jenisujianRepo
            ->getAllData();

        $matakuliah = $this
            ->matakuliahRepo
            ->getAllData();

        return view('dasbor.soal.form_ubah', compact(
            'tempsoal',
            'jenisujian',
            'matakuliah'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SoalRequest $soalReq, $id)
    {
        $data = [
            'kode' => $soalReq->kode,
            'kode_jenis_ujian' => $soalReq->kode_jenis_ujian,
            'kode_mata_kuliah' => $soalReq->kode_mata_kuliah,
            'sifat_ujian' => $soalReq->sifat_ujian,
            'durasi_ujian' => $soalReq->durasi_ujian,
        ];

        $update = $this
            ->soalRepo
            ->updateSoalData($data, $id);

        return redirect('/dasbor/soal');
    }

    public function updateToken($id)
    {
        $dataToken = $this
            ->soalRepo
            ->getSingleTokenData($id);

        $token = $dataToken->token;

        $data = [
            'status' => 1
        ];
        
        $updateToken = $this
            ->tokenRepo
            ->updateOnlyStatus($data, $token);

        return response()
            ->json([
                'updated' => $updateToken
            ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dataToken = $this
            ->soalRepo
            ->getSingleTokenData($id);

        $token = $dataToken->token;

        $dataPertanyaan = $this
            ->soalRepo
            ->getSingleKodeSoalData($id);

        $kodeSoal = $dataPertanyaan->kode;

        $allDataPertanyaanForimage = $this
            ->pertanyaanRepo
            ->getAllDataBySoal($kodeSoal);

        if(!empty($allDataPertanyaanForimage)){
            foreach ($allDataPertanyaanForimage as $item) {
                if($item->gambar != null){
                    $deleteFileGambar = $this
                            ->pertanyaanServe
                            ->handleDeleteGambar($item->gambar);
                }
            }
        }

        $destroy = $this
            ->soalRepo
            ->destroySoalData($id);
        
        $destroyPertanyaanSoal = $this
            ->pertanyaanRepo
            ->destroyPertanyaanBySoalData($kodeSoal);

        $destroyToken = $this
            ->tokenRepo
            ->destroyTokenData($token);

        return response()
            ->json([
                'destroyed' => true
            ], 200);
    }
}
