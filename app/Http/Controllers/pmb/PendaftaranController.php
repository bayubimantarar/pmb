<?php

namespace App\Http\Controllers\pmb;

use Crypt;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PMB\PendaftaranRequest;
use App\Repositories\CalonMahasiswaRepository;
use App\Repositories\PMB\PendaftaranRepository;

class PendaftaranController extends Controller
{
    private $pendaftaranRepo;
    private $calonMahasiswaRepo;

    public function __construct(
        PendaftaranRepository $pendaftaranRepository,
        CalonMahasiswaRepository $calonMahasiswaRepository
    ) {
        $this->pendaftaranRepo = $pendaftaranRepository;
        $this->calonMahasiswaRepo = $calonMahasiswaRepository;
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function formPendaftaran($encryptID)
    {
        $id = Crypt::decrypt($encryptID);

        $pendaftaran = $this
            ->pendaftaranRepo
            ->getSingleData($id);

        $status = $pendaftaran->status;

        if($status == 1){
            abort(404);
        }

        return view('pmb.pendaftaran.form_pendaftaran');
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
        dd($pendaftaranReq->all());
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
