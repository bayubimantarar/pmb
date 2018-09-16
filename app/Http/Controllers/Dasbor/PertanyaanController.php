<?php

namespace App\Http\Controllers\Dasbor;

use DataTables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PertanyaanRepository;

class PertanyaanController extends Controller
{
    private $kodesoalpertanyaan;
    private $pertanyaanRepo;

    public function __construct(PertanyaanRepository $pertanyaanRepository) 
    {
        $this->pertanyaanRepo = $pertanyaanRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($kodesoal)
    {
        $this
            ->kodesoalpertanyaan = $kodesoal;

        return view('dasbor.pertanyaan.pertanyaan', compact(
            'kodesoal'
        ));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function data()
    {
        $pertanyaan = $this
            ->pertanyaanRepo
            ->getAllData($this->kodesoalpertanyaan);

        return DataTables::of($pertanyaan)
            ->addColumn('action', function($pertanyaan){
                return '<center><a href="/dasbor/soal/form-ubah/'.$pertanyaan->id.'" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i></a> <a href="#hapus" onclick="destroy('.$pertanyaan->id.')" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a></center>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kodesoal =  $this->kodesoalpertanyaan;

        $pertanyaan = $this
            ->pertanyaanRepo
            ->getAllData()
            ->first();

        return view('dasbor.pertanyaan.form_tambah', compact(
            'pertanyaan', 'kodesoal'
        ));
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
