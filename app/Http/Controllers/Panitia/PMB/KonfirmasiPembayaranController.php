<?php

namespace App\Http\Controllers\Panitia\PMB;

use DataTables;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PMB\KonfirmasiPembayaranRepository;

class KonfirmasiPembayaranController extends Controller
{
    protected $konfirmasiPembayaranRepo;

    public function __construct(
        KonfirmasiPembayaranRepository $konfirmasiPembayaranRepository
    ) {
        $this->konfirmasiPembayaranRepo = $konfirmasiPembayaranRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function data()
    {
        $konfirmasiPendaftaran = $this
            ->konfirmasiPembayaranRepo
            ->getAllData();

        return DataTables::of($konfirmasiPendaftaran)
            ->editCOlumn('status', function($konfirmasiPendaftaran){
                if($konfirmasiPendaftaran->status == 1){
                    return '<center><span class="label label-success">Pembayaran sudah dikonfirmasi</span></center>';
                }else{
                    return '<center><span class="label label-danger">Pembayaran belum dikonfirmasi</span></center>';
                }
            })
            ->editCOlumn('tanggal_pembayaran', function($konfirmasiPendaftaran){
                return $konfirmasiPendaftaran->tanggal_pembayaran->formatLocalized('%d %B %Y');
            })
            ->rawColumns(['action', 'status'])
            ->make(true);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('panitia.pmb.konfirmasi_pembayaran.konfirmasi_pembayaran');
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
