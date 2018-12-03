<?php

namespace App\Http\Controllers\Prodi\PMB;

use Auth;
use Excel;
use Keygen;
use DataTables;
use Carbon\Carbon;
use App\Services\PertanyaanService;
use App\Http\Controllers\Controller;
use App\Exports\Prodi\PMB\PertanyaanExport;
use App\Http\Requests\Prodi\PMB\SoalRequest;
use App\Repositories\Prodi\PMB\SoalRepository;
use App\Repositories\Prodi\PMB\TokenRepository;
use App\Repositories\Prodi\PMB\PertanyaanRepository;
use App\Repositories\Dasbor\Master\TahunAjaranRepository;

class SoalController extends Controller
{
    private $soalRepo;
    private $tokenRepo;
    private $pertanyaanRepo;
    private $tahunAjaranRepo;
    private $pertanyaanServe;

    public function __construct(
        SoalRepository $soalRepository,
        TokenRepository $tokenRepository,
        PertanyaanService $pertanyaanService,
        PertanyaanRepository $pertanyaanRepository,
        TahunAjaranRepository $tahunAjaranRepository
    ) {
        $this->soalRepo = $soalRepository;
        $this->tokenRepo = $tokenRepository;
        $this->pertanyaanServe = $pertanyaanService;
        $this->pertanyaanRepo = $pertanyaanRepository;
        $this->tahunAjaranRepo = $tahunAjaranRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function data()
    {
        $nidn = Auth::guard('prodi')->user()->nidn;

        $soal = $this
            ->soalRepo
            ->getAllDataByProdi($nidn);

        return DataTables::of($soal)
            ->addColumn('action', function($soal){
                if($soal->status == 1){
                    return '<center><a href="#status" onclick="aktifkan('.$soal->id.','.$soal->status.')" class="btn btn-xs btn-info"><i class="fa fa-list-alt"></i></a> <a href="/prodi/pmb/soal/unduh/'.$soal->id.'" class="btn btn-success btn-xs"><i class="fa fa-file-excel-o"></i></a> <a href="/prodi/pmb/soal/form-ubah/'.$soal->id.'" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i></a> <a href="#hapus" onclick="destroy('.$soal->id.')" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a></center>';
                }else{
                    return '<center><a href="#status" onclick="aktifkan('.$soal->id.','.$soal->status.')" class="btn btn-xs btn-info"><i class="fa fa-list-alt"></i></a> <a href="/prodi/pmb/soal/unduh/'.$soal->id.'" class="btn btn-success btn-xs"><i class="fa fa-file-excel-o"></i></a> <a href="/prodi/pmb/soal/form-ubah/'.$soal->id.'" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i></a> <a href="#hapus" onclick="destroy('.$soal->id.')" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a></center>';
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
                    return '<center>'.$soal->token.'</center>';
                }else{
                    return '<center><span class="label label-danger">Belum diaktifkan</span></center>';
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
        return view('prodi.pmb.soal.soal');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tahunAjaran = $this
            ->tahunAjaranRepo
            ->getAllData();

        return view('prodi.pmb.soal.form_tambah', compact('tahunAjaran'));
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
        $kodesoal               = $soalReq->kode;
        $nidn                   = Auth::guard('prodi')->user()->nidn;
        $jumlahpertanyaan       = $soalReq->jumlah_pertanyaan;
        $token                  = Keygen::numeric(5)->generate();

        $data = [
            'kode'                  => $kodesoal,
            'kode_tahun_ajaran'     => $kodetahunajaran,
            'nidn'                  => $nidn,
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

        return redirect('/prodi/pmb/soal')
            ->with([
                'notification' => 'Data berhasil disimpan'
            ]);
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

        $tahunAjaran = $this
            ->tahunAjaranRepo
            ->getAllData();

        return view('prodi.pmb.soal.form_ubah', compact(
            'soal',
            'tahunAjaran'
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
        $kode                   = $soalReq->kode;
        $nidn                   = Auth::guard('prodi')->user()->nidn;
        $jumlahpertanyaan       = $soalReq->jumlah_pertanyaan;

        $data = [
            'kode'                  => $kode,
            'kode_tahun_ajaran'     => $kodetahunajaran,
            'nidn'                  => $nidn,
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

        return redirect('/prodi/pmb/soal');
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
            ->getSingleDataForDeleteBySoal($kodeSoal);

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

        // $checkJawaban = $this
        //     ->jawabanRepo
        //     ->checkJawabanDataBySoal($kodeSoal);

        // $checkHasil = $this
        //     ->hasilRepo
        //     ->checkHasilDataBySoal($kodeSoal);

        // if(!empty($checkJawaban)){
        //     $destroyJawaban = $this
        //         ->jawabanRepo
        //         ->destroyJawabanData($kodeSoal);

        //     foreach ($checkJawaban as $item) {
        //         if($item->gambar != null){
        //             $deleteFileGambar = $this
        //                 ->pertanyaanServe
        //                 ->handleDeleteGambar($item->gambar);
        //         }
        //     }
        // }

        // if(!empty($checkHasil)){
        //     $destroyHasil = $this
        //         ->hasilRepo
        //         ->destroyHasilData($kodeSoal);
        // }

        return response()
            ->json([
                'destroyed' => TRUE
            ], 200);
    }

    public function export($id)
    {
        $dataPertanyaan = $this
            ->soalRepo
            ->getSingleKodeSoalData($id);

        $kode_soal = $dataPertanyaan->kode;

        return Excel::download(new PertanyaanExport($id), $kode_soal.'.xlsx');
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
}
