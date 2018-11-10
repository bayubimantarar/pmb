<?php

namespace App\Http\Controllers\Panitia\PMB;

use DataTables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Prodi\PMB\JawabanRepository;

class JawabanController extends Controller
{
    private $jawabanRepo;

    public function __construct(JawabanRepository $jawabanRepository)
    {
        $this->jawabanRepo = $jawabanRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function data($kodeJadwalUjian)
    {
        $jawaban = $this
            ->jawabanRepo
            ->getSingleDataByPanitiaForNilai($kodeJadwalUjian);

        return DataTables::of($jawaban)
            ->addColumn('action', function($jawaban) use ($kodeJadwalUjian){
                return '<center><a href="/panitia/pmb/jawaban-ujian/'.$kodeJadwalUjian.'/detail/'.$jawaban->kode_pendaftaran.'" class="btn btn-info btn-xs"><i class="fa fa-info-circle"></i></a></center>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($kodeJadwalUjian)
    {
        return view('panitia.pmb.jawaban.jawaban', compact(
            'kodeJadwalUjian'
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
    public function show($kodeJadwalUjian, $kodePendaftaran)
    {
        dd($kodePendaftaran);
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
