<?php

namespace App\Http\Controllers\Dasbor;

use DataTables;
use App\Http\Requests\SoalRequest;
use App\Repositories\SoalRepository;
use App\Http\Controllers\Controller;
use App\Repositories\JenisUjianRepository;
use App\Repositories\MataKuliahRepository;

class SoalController extends Controller
{
    private $soalRepo;
    private $jenisujianRepo;
    private $matakuliahRepo;

    public function __construct(
        SoalRepository $soalRepository,
        JenisUjianRepository $jenisujianRepository,
        MataKuliahRepository $matakuliahRepository
    ) {
        $this->soalRepo         = $soalRepository;
        $this->jenisujianRepo   = $jenisujianRepository;
        $this->matakuliahRepo   = $matakuliahRepository;
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
                return '<center><a href="/dasbor/soal/form-ubah/'.$soal->id.'" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i></a> <a href="#hapus" onclick="destroy('.$soal->id.')" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a></center>';
            })
            ->rawColumns(['action'])
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

        return view('dasbor.soal.form_tambah', compact(
            'jenisujian',
            'matakuliah'
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
        $data = [
            'kode' => $soalReq->kode,
            'kode_jenis_ujian' => $soalReq->kode_jenis_ujian,
            'kode_mata_kuliah' => $soalReq->kode_mata_kuliah,
            'sifat_ujian' => $soalReq->sifat_ujian,
            'durasi_ujian' => $soalReq->durasi_ujian,
        ];

        $store = $this
            ->soalRepo
            ->storeSoalData($data);

        return redirect('/dasbor/soal');
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
            ->getSingleData($id);

        $jenisujian = $this
            ->jenisujianRepo
            ->getAllData();

        $matakuliah = $this
            ->matakuliahRepo
            ->getAllData();

        return view('dasbor.soal.form_ubah', compact(
            'soal',
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destroy = $this
            ->soalRepo
            ->destroySoalData($id);

        return response()
            ->json([
                'destroyed' => true
            ], 200);
    }
}
