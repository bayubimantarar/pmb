<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Services\KonfirmasiPembayaranService;
use App\Http\Requests\PMB\KonfirmasiPembayaranRequest;
use App\Repositories\PMB\KonfirmasiPembayaranRepository;

class KonfirmasiPembayaranController extends Controller
{
    protected $konfirmasiPembayaranRepo;
    protected $konfirmasiPembayaranServe;

    public function __construct(
        KonfirmasiPembayaranService $konfirmasiPembayaranService,
        KonfirmasiPembayaranRepository $konfirmasiPembayaranRepository
    ) {
        $this->konfirmasiPembayaranServe    = $konfirmasiPembayaranService; 
        $this->konfirmasiPembayaranRepo     = $konfirmasiPembayaranRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('konfirmasi');
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
    public function store(KonfirmasiPembayaranRequest $konfirmasiPembayaranReq)
    {
        $nama = $konfirmasiPembayaranReq->nama;
        $nomor_telepon = $konfirmasiPembayaranReq->nomor_telepon;
        $email = $konfirmasiPembayaranReq->email;
        $alamat = $konfirmasiPembayaranReq->alamat;
        $tanggalPembayaran = Carbon::parse($konfirmasiPembayaranReq->tanggal_pembayaran);
        $jumlahPembayaran = $konfirmasiPembayaranReq->jumlah_pembayaran;
        $bankTujuan = $konfirmasiPembayaranReq->bank_tujuan;
        $namaRekeningPengirim = $konfirmasiPembayaranReq->nama_rekening_pengirim;
        $fileBuktiTransaksi = $konfirmasiPembayaranReq->file('bukti_transaksi');

        if(!empty($fileBuktiTransaksi)){
            $NamaFileBuktiTransaksi = $fileBuktiTransaksi->getClientOriginalName();

            $data = [
                'nama' => $nama,
                'nomor_telepon' => $nomor_telepon,
                'email' => $email,
                'alamat' => $alamat,
                'tanggal_pembayaran' => $tanggalPembayaran,
                'jumlah_pembayaran' => $jumlahPembayaran,
                'bank_tujuan' => $bankTujuan,
                'nama_rekening_pengirim' => $namaRekeningPengirim,
                'bukti_transaksi' => $NamaFileBuktiTransaksi
            ];

            $uploadBuktiPembayaran = $this
                ->konfirmasiPembayaranServe
                ->handleUploadGambar($fileBuktiTransaksi, $NamaFileBuktiTransaksi);

            $store = $this
                ->konfirmasiPembayaranRepo
                ->storeKonfirmasiPembayaranData($data);
        }else{
            $data = [
                'nama' => $nama,
                'nomor_telepon' => $nomor_telepon,
                'email' => $email,
                'alamat' => $alamat,
                'tanggal_pembayaran' => $tanggalPembayaran,
                'jumlah_pembayaran' => $jumlahPembayaran,
                'bank_tujuan' => $bankTujuan,
                'nama_rekening_pengirim' => $namaRekeningPengirim
            ];
            
            $store = $this
                ->konfirmasiPembayaranRepo
                ->storeKonfirmasiPembayaranData($data);
        }
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
