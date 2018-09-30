<?php

namespace App\Http\Controllers\Mahasiswa;

use Auth;
use DataTables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\HasilRepository;

class HasilController extends Controller
{
    private $hasilRepo;

    public function __construct(HasilRepository $hasilRepository)
    {
        $this->hasilRepo = $hasilRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function data()
    {
        $nim = Auth::guard('mahasiswa')->User()->nim;

        $hasil = $this
            ->hasilRepo
            ->getAllHasilData($nim);

        return DataTables::of($hasil)
            ->editColumn('tahun_ajaran', function($hasil){
                return $hasil->tahun_ajaran.' '.$hasil->semester;
            })
            ->editColumn('nilai_angka', function($hasil){
                if($hasil->nilai_angka == NULL){
                    return '<center><span class="label label-danger">Belum diperiksa</span></center>';
                }else{
                    return $hasil->nilai_angka;
                }
            })
            ->rawColumns(['action', 'tahun_ajaran', 'nilai_angka'])
            ->make(true);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('mahasiswa.hasil.hasil');
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
