<?php

namespace App\Http\Controllers\Keuangan;

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
        $konfirmasiPembayaran = $this
            ->konfirmasiPembayaranRepo
            ->getAllData();

        return DataTables::of($konfirmasiPembayaran)
            ->editCOlumn('status', function($konfirmasiPembayaran){
                if($konfirmasiPembayaran->status == 1){
                    return '<center><span class="label label-success">Pembayaran sudah dikonfirmasi</span></center>';
                }else{
                    return '<center><span class="label label-danger">Pembayaran belum dikonfirmasi</span></center>';
                }
            })
            ->editCOlumn('tanggal_pembayaran', function($konfirmasiPembayaran){
                return $konfirmasiPembayaran->tanggal_pembayaran->formatLocalized('%d %B %Y');
            })
            ->editCOlumn('bukti_transaksi', function($konfirmasiPembayaran){
                if($konfirmasiPembayaran->bukti_transaksi == NULL){
                    return '<center><span class="label label-danger">Bukti pembayaran tidak disisipkan</span></center>';
                }else{
                    return '<center><a href="/keuangan/konfirmasi-pembayaran/unduh/'.$konfirmasiPembayaran->id.'" class="btn btn-xs btn-primary" title="Unduh bukti pembayaran"><i class="fa fa-download"></i></a></center>';
                }
            })
            ->rawColumns(['action', 'status', 'bukti_transaksi'])
            ->make(true);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('keuangan.konfirmasi_pembayaran.konfirmasi_pembayaran');
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
    public function download($id)
    {
        $konfirmasiPembayaran = $this
            ->konfirmasiPembayaranRepo
            ->getSingleData($id);

        $fileBuktiTransaksi = public_path('uploads/pmb/pembayaran/'.$konfirmasiPembayaran->bukti_transaksi);
        $fileName = "Bukti transaksi - ".$konfirmasiPembayaran->nama.' - '.$konfirmasiPembayaran->bukti_transaksi;

        return response()
            ->download($fileBuktiTransaksi, $fileName);
    }
}
