<?php

namespace App\Http\Controllers;

use Mail;
use Crypt;
use App\Mail\Pendaftaran;
use App\Mail\KonfirmasiPembayaran;
use App\Repositories\PMB\PendaftaranRepository;
use App\Http\Requests\Pendaftaran\PendaftaranRequest;

class PendaftaranController extends Controller
{
    protected $pendaftaranRepo;

    public function __construct(PendaftaranRepository $pendaftaranRepository)
    {
        $this->pendaftaranRepo = $pendaftaranRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pendaftaran');
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
    public function store(PendaftaranRequest $pendaftaranReq)
    {
        $nama               = $pendaftaranReq->nama;
        $email              = $pendaftaranReq->email;
        $nomor_telepon      = $pendaftaranReq->nomor_telepon;
        $email              = $pendaftaranReq->email;
        $alamat             = $pendaftaranReq->alamat;

        $data = [
            'nama'          => $nama,
            'email'         => $email,
            'nomor_telepon' => $nomor_telepon,
            'alamat'        => $alamat,
            'status'        => 0,
            'konfirmasi_pembayaran' => 0
        ];

        $store = $this
            ->pendaftaranRepo
            ->storePendaftaranData($data);

        $sendEmail = Mail::to($email)->send(new KonfirmasiPembayaran($nama));

        return redirect('/pendaftaran')
            ->with([
                'notification' => 'Pendaftaran telah berhasil, silahkan cek email anda untuk menerima informasi lebih lanjut.'
            ]);
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
