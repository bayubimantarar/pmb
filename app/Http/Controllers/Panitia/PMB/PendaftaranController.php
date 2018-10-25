<?php

namespace App\Http\Controllers\Panitia\PMB;

use Mail;
use Crypt;
use DataTables;
use App\Mail\Pendaftaran;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PMB\PendaftaranRepository;

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
    public function data()
    {
        $pendaftaran = $this
            ->pendaftaranRepo
            ->getAllData();

        return DataTables::of($pendaftaran)
            ->addColumn('action', function($dosen){
                return '<center><a href="/panitia/pmb/pendaftaran/aktifkan/'.$dosen->id.'" class="btn btn-info btn-xs"><i class="fa fa-check"></i></a></center>';
            })
            ->editCOlumn('konfirmasi_pembayaran', function($pendaftaran){
                if($pendaftaran->konfirmasi_pembayaran == 1){
                    return '<center><span class="label label-success">Pembayaran sudah dikonfirmasi</span></center>';
                }else{
                    return '<center><span class="label label-danger">Pembayaran belum dikonfirmasi</span></center>';
                }
            })
            ->editCOlumn('status', function($pendaftaran){
                if($pendaftaran->status == 1){
                    return '<center><span class="label label-success">Formulir sudah diisi</span></center>';
                }else{
                    return '<center><span class="label label-danger">Formulir belum diisi</span></center>';
                }
            })
            ->rawColumns(['action', 'konfirmasi_pembayaran', 'status'])
            ->make(true);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('panitia.pmb.pendaftaran.pendaftaran');
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

    public function active($id)
    {
        $pendaftaran = $this
            ->pendaftaranRepo
            ->getSingleData($id);

        $email = $pendaftaran->email;

        $data = [
            'konfirmasi_pembayaran' => 1
        ];

        $update = $this
            ->pendaftaranRepo
            ->updatePendaftaranData($data,  $id);

        $encryptID = Crypt::encrypt($id);

        $sendEmail = Mail::to($email)->send(new Pendaftaran($encryptID));
    }
}
