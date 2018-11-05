<?php

namespace App\Http\Controllers\Panitia\PMB;

use DataTables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PMB\HasilRepository;
use App\Repositories\PMB\NilaiLulusRepository;

class HasilController extends Controller
{
    private $hasilRepo;
    private $nilaiLulusRepo;

    public function __construct(
        HasilRepository $hasilRepository,
        NilaiLulusRepository $nilaiLulusRepository
    ) {
        $this->hasilRepo = $hasilRepository;
        $this->nilaiLulusRepo = $nilaiLulusRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function data()
    {
        $hasil = $this
            ->hasilRepo
            ->getAllHasilData();

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
    public function index()
    {
        return view('panitia.pmb.hasil.hasil');
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
