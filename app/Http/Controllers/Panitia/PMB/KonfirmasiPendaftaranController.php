<?php

namespace App\Http\Controllers\Panitia\PMB;

use DataTables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PMB\KonfirmasiPendaftaranRepository;

class KonfirmasiPendaftaranController extends Controller
{
    protected $konfirmasiPendaftaranRepo;

    public function __construct(
        KonfirmasiPendaftaranRepository $konfirmasiPendaftaranRepository
    ) {
        $this->konfirmasiPendaftaranRepo = $konfirmasiPendaftaranRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function data()
    {
        $konfirmasiPendaftaran = $this
            ->konfirmasiPendaftaranRepo
            ->getAllData();

        return DataTables::of($konfirmasiPendaftaran)
            ->editCOlumn('status', function($konfirmasiPendaftaran){
                if($konfirmasiPendaftaran->status == 1){
                    return '<center><span class="label label-success">Pembayaran sudah dikonfirmasi</span></center>';
                }else{
                    return '<center><span class="label label-danger">Pembayaran belum dikonfirmasi</span></center>';
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
        //
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
