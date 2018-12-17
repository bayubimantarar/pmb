<?php

namespace App\Http\Controllers\Panitia\PMB;

use DataTables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PMB\BiayaRepository;
use App\Http\Requests\Panitia\BiayaRequest;

class BiayaController extends Controller
{
    protected $biayaRepo;

    public function __construct(BiayaRepository $biayaRepository)
    {
        $this->biayaRepo = $biayaRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function data()
    {
        $biaya = $this
            ->biayaRepo
            ->getAllData();


        return DataTables::of($biaya)
            ->addColumn('action', function($biaya){
                return '<center><a href="/panitia/pmb/biaya/form-ubah/'.$biaya->id.'" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i></a> <a href="#hapus" onclick="destroy('.$biaya->id.')" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a></center>';
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
        return view('panitia.pmb.biaya.biaya');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('panitia.pmb.biaya.form_tambah');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BiayaRequest $biayaReq)
    {
        $kelas = $biayaReq->kelas;
        $biayaPendaftaran = $biayaReq->biaya_pendaftaran;
        $biayaJaketKemeja = $biayaReq->biaya_jaket_kemeja;
        $biayaPSPT = $biayaReq->biaya_pspt;
        $biayaPengembanganInstitusi = $biayaReq->biaya_pengembangan_institusi;
        $biayaKuliah = $biayaReq->biaya_kuliah;
        $biayaKemahasiswaan = $biayaReq->biaya_kemahasiswaan;
        $keterangan = $biayaReq->keterangan;

        $data = [
            'kelas' => $kelas,
            'biaya_pendaftaran' => $biayaPendaftaran,
            'biaya_jaket_kemeja' => $biayaJaketKemeja,
            'biaya_pspt' => $biayaPSPT,
            'biaya_pengembangan_institusi' => $biayaPengembanganInstitusi,
            'biaya_kuliah' => $biayaKuliah,
            'biaya_kemahasiswaan' => $biayaKemahasiswaan,
            'keterangan' => $keterangan
        ];

        $store = $this
            ->biayaRepo
            ->storeBiayaData($data);

        return redirect('/panitia/pmb/biaya');
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
        $biaya = $this
            ->biayaRepo
            ->getSingleData($id);

        return view('panitia.pmb.biaya.form_ubah', compact('biaya'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BiayaRequest $biayaReq, $id)
    {
        $kelas = $biayaReq->kelas;
        $biayaPendaftaran = $biayaReq->biaya_pendaftaran;
        $biayaJaketKemeja = $biayaReq->biaya_jaket_kemeja;
        $biayaPSPT = $biayaReq->biaya_pspt;
        $biayaPengembanganInstitusi = $biayaReq->biaya_pengembangan_institusi;
        $biayaKuliah = $biayaReq->biaya_kuliah;
        $biayaKemahasiswaan = $biayaReq->biaya_kemahasiswaan;
        $keterangan = $biayaReq->keterangan;

        $data = [
            'kelas' => $kelas,
            'biaya_pendaftaran' => $biayaPendaftaran,
            'biaya_jaket_kemeja' => $biayaJaketKemeja,
            'biaya_pspt' => $biayaPSPT,
            'biaya_pengembangan_institusi' => $biayaPengembanganInstitusi,
            'biaya_kuliah' => $biayaKuliah,
            'biaya_kemahasiswaan' => $biayaKemahasiswaan,
            'keterangan' => $keterangan
        ];

        $store = $this
            ->biayaRepo
            ->updateBiayaData($data, $id);

        return redirect('/panitia/pmb/biaya');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destroy = $this
            ->biayaRepo
            ->destroyBiayaData($id);

        return response()
            ->json([
                'destroyed' => TRUE
            ]);
    }
}
