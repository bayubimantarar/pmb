<?php

namespace App\Http\Controllers\Mahasiswa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\SoalRepository;
use App\Repositories\TokenRepository;
use App\Repositories\PertanyaanRepository;
use App\Http\Requests\Mahasiswa\SoalRequest;

class SoalController extends Controller
{
    private $soalRepo;
    private $tokenRepo;
    private $pertanyaanRepo;

    public function __construct(
        SoalRepository $soalRepository,
        TokenRepository $tokenRepo,
        PertanyaanRepository $pertanyaanRepo
    ) {
        $this->soalRepo         = $soalRepository;
        $this->tokenRepo        = $tokenRepo;
        $this->pertanyaanRepo   =  $pertanyaanRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('mahasiswa.ujian.soal');
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function find(SoalRequest $soalReq)
    {
        $token = $soalReq->token;

        $dataSoal = $this
            ->tokenRepo
            ->getSingleDataForSoal($token);

        $kodeSoal = $dataSoal->kode_soal;

        $dataPertanyaan = $this
            ->pertanyaanRepo
            ->getAllDataBySoal($kodeSoal);

        $i = 1;

        return view('mahasiswa.ujian.form_soal', compact(
            'dataPertanyaan', 'i'
        ));
    }
}
