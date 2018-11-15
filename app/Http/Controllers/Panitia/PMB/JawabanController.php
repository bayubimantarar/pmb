<?php

namespace App\Http\Controllers\Panitia\PMB;

use PDF;
use DataTables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Prodi\PMB\JawabanRepository;
use App\Repositories\Prodi\PMB\PertanyaanRepository;

class JawabanController extends Controller
{
    private $jawabanRepo;
    private $pertanyaanRepo;

    public function __construct(
        JawabanRepository $jawabanRepository,
        PertanyaanRepository $pertanyaanRepository
    ) {
        $this->jawabanRepo = $jawabanRepository;
        $this->pertanyaanRepo = $pertanyaanRepository;
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
                return '<center><a href="/panitia/pmb/jawaban-ujian/'.$kodeJadwalUjian.'/detail/'.$jawaban->kode_pendaftaran.'/'.$jawaban->kode_soal.'" class="btn btn-info btn-xs"><i class="fa fa-info-circle"></i></a> <a href="/panitia/pmb/jawaban-ujian/'.$kodeJadwalUjian.'/unduh/'.$jawaban->kode_pendaftaran.'" class="btn btn-success btn-xs" title="Unduh formulir"><i class="fa fa-file-text-o"></i></a></center>';
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
    public function show($kodeJadwalUjian, $kodePendaftaran, $kodeSoal)
    {
        $jawaban = $this
            ->jawabanRepo
            ->getSingleDataByPanitiaForCheck($kodePendaftaran, $kodeSoal);

        $pertanyaan = $this
            ->pertanyaanRepo
            ->getAllDataBySoal($kodeSoal);

        $nomorSoal  = 1;
        $nomorSoalPertanyaan = 1;
        
        return view('panitia.pmb.jawaban.detail', compact(
            'jawaban',
            'pertanyaan',
            'kodeSoal',
            'nomorSoal',
            'nomorSoalPertanyaan'
        ));
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

    public function downloadJawaban($kodeJadwalUjian, $kodePendaftaran)
    {
        $jawaban = $this
            ->jawabanRepo
            ->checkJawabanDataByCalonMahasiswa($kodePendaftaran);

        $nama = $jawaban->first()->nama;

        $nomorSoal  = 1;

        $pdf = PDF::loadView('panitia.pmb.jawaban.jawaban_pdf', compact(
            'jawaban',
            'nomorSoal'
        ));

        $fileName = 'Jawaban '.$nama.' '.$kodePendaftaran.'.pdf';

        return $pdf->download($fileName);
    }
}
