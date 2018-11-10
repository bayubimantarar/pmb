<?php

namespace App\Http\Controllers\Panitia\PMB;

use PDF;
use Zipper;
use DataTables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PMB\FormulirRepository;
use App\Repositories\PMB\CalonMahasiswaKelengkapanRepository;

class FormulirController extends Controller
{
    private $formulirRepo;
    private $calonMahasiswaKelengkapanRepo;

    public function __construct(
        FormulirRepository $formulirRepository,
        CalonMahasiswaKelengkapanRepository $calonMahasiswaKelengkapanRepository
    ) {
        $this->formulirRepo = $formulirRepository;
        $this->calonMahasiswaKelengkapanRepo = $calonMahasiswaKelengkapanRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function data()
    {
        $formulir = $this
            ->formulirRepo
            ->getAllData();

        return DataTables::of($formulir)
            ->addColumn('action', function($formulir){
                return '<center><a href="/panitia/pmb/formulir/detail/'.$formulir->id.'" class="btn btn-info btn-xs"><i class="fa fa-info-circle" title="Lihat formulir"></i></a> <a href="/panitia/pmb/formulir/unduh-formulir/'.$formulir->id.'" class="btn btn-success btn-xs" title="Unduh formulir"><i class="fa fa-file-text-o"></i></a> <a href="/panitia/pmb/formulir/unduh-kelengkapan/'.$formulir->id.'" class="btn btn-primary btn-xs" title="Unduh formulir"><i class="fa fa-download"></i></a></center>';
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
        return view('panitia.pmb.formulir.formulir');
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
        $formulir = $this
            ->formulirRepo
            ->getSingleData($id)
            ->first();

        return view('panitia.pmb.formulir.detail', compact('formulir'));
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

    public function downloadFormulir($id)
    {
        $formulir = $this
            ->formulirRepo
            ->getSingleData($id)
            ->first();

        $kodePendaftaran = $formulir->kode;
        $nama = $formulir->nama;

        $pdf = PDF::loadView('panitia.pmb.formulir.formulir_pdf', compact(
            'formulir'
        ));

        $fileName = "Formulir - ".$kodePendaftaran.' - '.$nama.'.pdf';

        return $pdf->download($fileName);
    }

    public function downloadKelengkapan($id)
    {
        $formulir = $this
            ->formulirRepo
            ->getSingleData($id)
            ->first();

        $kodePendaftaran = $formulir->kode;
        $nama = $formulir->nama;

        $lampiranFormulir = $this
            ->calonMahasiswaKelengkapanRepo
            ->getSingleDataForDownload($kodePendaftaran);

        foreach ($lampiranFormulir as $item) {
            $data = [
                public_path('/uploads/pmb/pendaftaran/kelengkapan/'.$item->fotocopy_raport_kelas_xii),
                public_path('/uploads/pmb/pendaftaran/kelengkapan/'.$item->fotocopy_ijazah_sma),
                public_path('/uploads/pmb/pendaftaran/kelengkapan/'.$item->foto_3x4),
                public_path('/uploads/pmb/pendaftaran/kelengkapan/'.$item->foto_4x6),
                public_path('/uploads/pmb/pendaftaran/kelengkapan/'.$formulir->fotocopy_transkrip_nilai),
                public_path('/uploads/pmb/pendaftaran/kelengkapan/'.$formulir->fotocopy_ijazah_perguruan_tinggi_asal)
            ];
        }

        $fileName = "File Kelengkapan Calon Mahasiswa - ".$kodePendaftaran.' - '.$nama.'.zip';
        
        $make = Zipper::make(public_path('/files/'.$fileName))->add($data)->close();

        return response()
            ->download(public_path('/files/'.$fileName));
    }
}
