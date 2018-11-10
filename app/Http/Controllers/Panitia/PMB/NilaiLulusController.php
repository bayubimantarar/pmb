<?php

namespace App\Http\Controllers\Panitia\PMB;

use DataTables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PMB\NilaiLulusRepository;
use App\Http\Requests\Panitia\PMB\NilaiLulusRequest;

class NilaiLulusController extends Controller
{
    private $nilaiLulusRepo;

    public function __construct(NilaiLulusRepository $nilaiLulusRepository)
    {
        $this->nilaiLulusRepo = $nilaiLulusRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function data()
    {
        $nilaiLulus = $this
            ->nilaiLulusRepo
            ->getAllData();

        return DataTables::of($nilaiLulus)
            ->addColumn('action', function($nilaiLulus){
                return '<center><a href="/panitia/pmb/biaya/form-ubah/'.$nilaiLulus->id.'" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i></a> <a href="#hapus" onclick="destroy('.$nilaiLulus->id.')" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a></center>';
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
        $nilaiLulus = $this
            ->nilaiLulusRepo
            ->getAllData()
            ->count();

        return view('panitia.pmb.nilai_lulus.nilai_lulus', compact('nilaiLulus'));
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
