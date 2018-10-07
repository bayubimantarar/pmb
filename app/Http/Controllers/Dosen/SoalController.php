<?php

namespace App\Http\Controllers\Dosen;

use Auth;
use Keygen;
use App\Soal;
use DataTables;
use Carbon\Carbon;
use App\Http\Requests\Dosen\SoalRequest;
use App\Services\PertanyaanService;
use App\Repositories\SoalRepository;
use App\Http\Controllers\Controller;
use App\Repositories\TokenRepository;
use App\Repositories\KelasRepository;
use App\Repositories\DosenRepository;
use App\Repositories\HasilRepository;
use App\Repositories\JawabanRepository;
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
    private $hasilRepo;
    private $jawabanRepo;
    private $jenisujianRepo;
    private $matakuliahRepo;
    private $pertanyaanRepo;
    private $pertanyaanServe;
    private $tahunajaranRepo;

    public function __construct(
        SoalRepository $soalRepository,
        HasilRepository $hasilRepository,
        TokenRepository $tokenRepository,
        DosenRepository $dosenRepository,
        KelasRepository $kelasRepository,
        JawabanRepository $jawabanRepository,
        PertanyaanService $pertanyaanService,
        JenisUjianRepository $jenisujianRepository,
        MataKuliahRepository $matakuliahRepository,
        PertanyaanRepository $pertanyaanRepository,
        TahunAjaranRepository $tahunajaranRepository
    ) {
        $this->soalRepo         = $soalRepository;
        $this->tokenRepo        = $tokenRepository;
        $this->kelasRepo        = $kelasRepository;
        $this->dosenRepo        = $dosenRepository;
        $this->hasilRepo        = $hasilRepository;
        $this->jawabanRepo      = $jawabanRepository;
        $this->pertanyaanServe  = $pertanyaanService;
        $this->jenisujianRepo   = $jenisujianRepository;
        $this->matakuliahRepo   = $matakuliahRepository;
        $this->pertanyaanRepo   = $pertanyaanRepository;
        $this->tahunajaranRepo  = $tahunajaranRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function data()
    {
        $nip = Auth::guard('dosen')->user()->nip;

        $soal = $this
            ->soalRepo
            ->getAllData($nip);

        // return DataTables::of($soal)
        //     ->addColumn('action', function($soal){
        //         return '<center><a href="/dosen/soal/form-ubah/'.$soal->id.'" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i></a> <a href="#hapus" onclick="destroy('.$soal->id.')" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a></center>';
        //     })
        //     ->rawColumns(['action'])
        //     ->make(true);

        return DataTables::of($soal)
            ->addColumn('action', function($soal){
                if($soal->status == 1){
                    return '<center><a href="#status" onclick="aktifkan('.$soal->id.','.$soal->status.')" class="btn btn-xs btn-success"><i class="fa fa-list-alt"></i></a> <a href="/dosen/soal/form-ubah/'.$soal->id.'" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i></a> <a href="#hapus" onclick="destroy('.$soal->id.')" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a></center>';
                }else{
                    return '<center><a href="#status" onclick="aktifkan('.$soal->id.','.$soal->status.')" class="btn btn-xs btn-success"><i class="fa fa-list-alt"></i></a> <a href="/dosen/soal/form-ubah/'.$soal->id.'" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i></a> <a href="#hapus" onclick="destroy('.$soal->id.')" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a></center>';
                }
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
                    return 'SOAL BELUM DIAKTIFKAN';
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
        return view('dosen.soal.soal');
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

        return view('dosen.soal.form_tambah', compact(
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
        $kodetahunajaran        = $soalReq->kode_tahun_ajaran;
        $kodekelas              = $soalReq->kode_kelas;
        $kodejenisujian         = $soalReq->kode_jenis_ujian;
        $kodematakuliah         = $soalReq->kode_mata_kuliah;
        $kodesoal               = $soalReq->kode;
        $nip                    = Auth::guard('dosen')->user()->nip;
        $sifatujian             = $soalReq->sifat_ujian;
        $tanggalmulaiujian      = Carbon::parse($soalReq->tanggal_mulai_ujian);
        $tanggalselesaiujian    = Carbon::parse($soalReq->tanggal_selesai_ujian);
        $durasiujian            = $soalReq->durasi_ujian;
        $jumlahpertanyaan       = $soalReq->jumlah_pertanyaan;
        $token                  = Keygen::numeric(5)->generate();

        $data = [
            'kode'                  => $kodesoal,
            'kode_tahun_ajaran'     => $kodetahunajaran,
            'kode_kelas'            => $kodekelas,
            'kode_jenis_ujian'      => $kodejenisujian,
            'kode_mata_kuliah'      => $kodematakuliah,
            'nip'                   => $nip,
            'sifat_ujian'           => $sifatujian,
            'tanggal_mulai_ujian'   => $tanggalmulaiujian,
            'tanggal_selesai_ujian' => $tanggalselesaiujian,
            'durasi_ujian'          => $durasiujian,
            'jumlah_pertanyaan'     => $jumlahpertanyaan
        ];

        $dataForToken = [
            'kode_soal' => $kodesoal,
            'token' => $token,
            'status' => 0
        ];

        $store = $this
            ->soalRepo
            ->storeSoalData($data);

        $storeForToken = $this
            ->tokenRepo
            ->storeTokenData($dataForToken);

        return redirect('/dosen/soal');
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

        $tanggalmulaiujian      = $soal
            ->tanggal_mulai_ujian
            ->format('d-m-Y h:i:s');

        $tanggalselesaiujian    = $soal
            ->tanggal_selesai_ujian
            ->format('d-m-Y h:i:s');
        
        return view('dosen.soal.form_ubah', compact(
            'soal',
            'tanggalmulaiujian',
            'tanggalselesaiujian',
            'durasiujian',
            'jenisujian',
            'matakuliah',
            'dosen',
            'kelas',
            'tahunajaran'
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
        $getOldKodeSoal = $this
            ->soalRepo
            ->getSingleDataForEdit($id);

        $oldkodesoal            = $getOldKodeSoal->kode;
        $kodetahunajaran        = $soalReq->kode_tahun_ajaran;
        $kodekelas              = $soalReq->kode_kelas;
        $kodejenisujian         = $soalReq->kode_jenis_ujian;
        $kodematakuliah         = $soalReq->kode_mata_kuliah;
        $kode                   = $soalReq->kode;
        $nip                    = Auth::guard('dosen')->user()->nip;
        $sifatujian             = $soalReq->sifat_ujian;
        $tanggalmulaiujian      = Carbon::parse($soalReq->tanggal_mulai_ujian);
        $tanggalselesaiujian    = Carbon::parse($soalReq->tanggal_selesai_ujian);
        $durasiujian            = $soalReq->durasi_ujian;
        $jumlahpertanyaan       = $soalReq->jumlah_pertanyaan;

        $checkPertanyaan = $this
            ->pertanyaanRepo
            ->getAllData($kode);

        if(empty($checkPertanyaan)){
            $data = [
                'kode'                  => $kode,
                'kode_tahun_ajaran'     => $kodetahunajaran,
                'kode_kelas'            => $kodekelas,
                'kode_jenis_ujian'      => $kodejenisujian,
                'kode_mata_kuliah'      => $kodematakuliah,
                'nip'                   => $nip,
                'sifat_ujian'           => $sifatujian,
                'tanggal_mulai_ujian'   => $tanggalmulaiujian,
                'tanggal_selesai_ujian' => $tanggalselesaiujian,
                'durasi_ujian'          => $durasiujian,
                'jumlah_pertanyaan'     => $jumlahpertanyaan
            ];

            $dataPertanyaan = [
                'kode_soal' => $kode
            ];

            // $dataToken = [
            //     'kode_soal' => $kode
            // ];

            $update = $this
                ->soalRepo
                ->updateSoalData($data, $id);

            // $updateToken = $this
            //     ->tokenRepo
            //     ->updateFromSoalData($dataToken, $oldkodesoal);

            $updatePertanyaan = $this
                ->pertanyaanRepo
                ->updatePertanyaanBySoalData($dataPertanyaan, $oldkodesoal);

            return redirect('/dosen/soal');
        }else{
            $data = [
                'kode'                  => $kode,
                'kode_tahun_ajaran'     => $kodetahunajaran,
                'kode_kelas'            => $kodekelas,
                'kode_jenis_ujian'      => $kodejenisujian,
                'kode_mata_kuliah'      => $kodematakuliah,
                'nip'                   => $nip,
                'sifat_ujian'           => $sifatujian,
                'tanggal_mulai_ujian'   => $tanggalmulaiujian,
                'tanggal_selesai_ujian' => $tanggalselesaiujian,
                'durasi_ujian'          => $durasiujian,
                'jumlah_pertanyaan'     => $jumlahpertanyaan
            ];

            $dataToken = [
                'kode_soal' => $kode
            ];

            $dataPertanyaan = [
                'kode_soal' => $kode
            ];

            $update = $this
                ->soalRepo
                ->updateSoalData($data, $id);

            $updateToken = $this
                ->tokenRepo
                ->updateFromSoalData($dataToken, $oldkodesoal);
            
            $updatePertanyaan = $this
                ->pertanyaanRepo
                ->updatePertanyaanBySoalData($dataPertanyaan, $oldkodesoal);

            return redirect('/dosen/soal');
        }
    }

    public function activateToken($id)
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

    public function nonactivateToken($id)
    {
        $dataToken = $this
            ->soalRepo
            ->getSingleTokenData($id);

        $token = $dataToken->token;

        $data = [
            'status' => 0
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

        $destroyJawaban = $this
            ->jawabanRepo
            ->destroyJawabanData($kodeSoal);

        $destroyHasil = $this
            ->hasilRepo
            ->destroyHasilData($kodeSoal);

        return response()
            ->json([
                'destroyed' => TRUE
            ], 200);
    }
}
