<?php

namespace App\Http\Controllers\Panitia\PMB;

use DataTables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PMB\HasilRepository;
use App\Repositories\PMB\BiayaRepository;
use App\Repositories\PMB\GelombangRepository;
use App\Repositories\PMB\NilaiLulusRepository;
use App\Repositories\Dasbor\Master\ProdiRepository;

class HasilController extends Controller
{
    private $hasilRepo;
    private $prodiRepo;
    private $biayaRepo;
    private $gelombangRepo;
    private $nilaiLulusRepo;

    public function __construct(
        HasilRepository $hasilRepository,
        ProdiRepository $prodiRepository,
        BiayaRepository $biayaRepository,
        GelombangRepository $gelombangRepository,
        NilaiLulusRepository $nilaiLulusRepository
    ) {
        $this->hasilRepo = $hasilRepository;
        $this->prodiRepo = $prodiRepository;
        $this->biayaRepo = $biayaRepository;
        $this->gelombangRepo = $gelombangRepository;
        $this->nilaiLulusRepo = $nilaiLulusRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function data($kodeJadwalUjian)
    {
        $hasil = $this
            ->hasilRepo
            ->getAllHasilDataByCalonMahasiswa();

        $nilaiLulus = $this
            ->nilaiLulusRepo
            ->getAllData()
            ->first();

        return DataTables::of($hasil)
            ->addColumn('action', function($hasil) use ($kodeJadwalUjian){
                return '<center><a href="/panitia/pmb/hasil-ujian/'.$kodeJadwalUjian.'/form-ubah/'.$hasil->id.'" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i></a></center>';
            })
            ->editColumn('status', function($hasil) use($nilaiLulus){
                if($hasil->nilai_angka >= $nilaiLulus->nilai){
                    return '<center><span class="label label-success">Lulus</span></center>';
                }else{
                    return '<center><span class="label label-danger">Tidak Lulus</span></center>';
                }
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dataFilter($kodeJurusan, $kodeGelombang, $kodeKelas, $tahun)
    {
        $hasil = $this
            ->hasilRepo
            ->getAllHasilDataByFilter($kodeJurusan, $kodeGelombang, $kodeKelas, $tahun);

        $nilaiLulus = $this
            ->nilaiLulusRepo
            ->getAllData()
            ->first();

        return DataTables::of($hasil)
            ->editColumn('status', function($hasil) use($nilaiLulus){
                if($hasil->nilai_angka >= $nilaiLulus->nilai){
                    return '<center><span class="label label-success">Lulus</span></center>';
                }else{
                    return '<center><span class="label label-danger">Tidak Lulus</span></center>';
                }
            })
            ->rawColumns(['status'])
            ->make(true);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($kodeJadwalUjian)
    {
        $prodi = $this
            ->prodiRepo
            ->getAllData();

        $gelombang = $this
            ->gelombangRepo
            ->getAllData();

        $biaya = $this
            ->biayaRepo
            ->getAllData();

        return view('panitia.pmb.hasil.hasil', compact(
            'prodi', 'gelombang', 'biaya', 'kodeJadwalUjian'
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
    public function store(Request $request)
    {
        //
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
