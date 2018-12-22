<?php

namespace App\Http\Controllers\Keuangan;

use DataTables;
use App\Http\Controllers\Controller;
use App\Repositories\PMB\BiayaRepository;
use App\Http\Requests\Keuangan\DetailBiayaRequest;
use App\Repositories\PMB\DetailBiayaPotonganRepository;

class DetailBiayaController extends Controller
{
    private $biayaRepo, $detailBiayaPotonganRepo;

    public function __construct(
        BiayaRepository $biayaRepository,
        DetailBiayaPotonganRepository $detailBiayaPotonganRepository
    ) {
        $this->biayaRepo = $biayaRepository;
        $this->detailBiayaPotonganRepo = $detailBiayaPotonganRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function data($kodeBiaya)
    {
        $detailBiaya = $this
            ->detailBiayaPotonganRepo
            ->getSingleDataForDetailBiayaPotongan($kodeBiaya);

        return DataTables::of($detailBiaya)
            ->addColumn('action', function($detailBiaya) use ($kodeBiaya){
                return '<center><a href="/keuangan/detail-biaya/'.$kodeBiaya.'/form-ubah/'.$detailBiaya->id.'" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i></a> <a href="#hapus" onclick="destroy('.$detailBiaya->id.')" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a></center>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($kodeBiaya)
    {
        return view('keuangan.detail_biaya.detail_biaya', compact(
            'kodeBiaya'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($kodeBiaya)
    {
        return view('keuangan.detail_biaya.form_tambah', compact(
            'biaya', 'kodeBiaya'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($kodeBiaya, DetailBiayaRequest $detailBiayaReq)
    {
        $deskripsi  = $detailBiayaReq->deskripsi;
        $jumlah     = $detailBiayaReq->jumlah;

        $data = [
            'kode_biaya' => $kodeBiaya,
            'deskripsi' => $deskripsi,
            'jumlah' => $jumlah
        ];

        $store = $this
            ->detailBiayaPotonganRepo
            ->storeDetailBiayaPotonganData($data);

        return redirect('/keuangan/detail-biaya/'.$kodeBiaya);
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
    public function edit($kodeBiaya, $id)
    {
        $detailBiaya = $this
            ->detailBiayaPotonganRepo
            ->getSingleData($id);

        return view('keuangan.detail_biaya.form_ubah', compact(
            'kodeBiaya', 'detailBiaya', 'id'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($kodeBiaya, detailBiayaRequest $detailBiayaReq, $id)
    {
        $deskripsi  = $detailBiayaReq->deskripsi;
        $jumlah     = $detailBiayaReq->jumlah;

        $data = [
            'kode_biaya' => $kodeBiaya,
            'deskripsi' => $deskripsi,
            'jumlah' => $jumlah
        ];

        $store = $this
            ->detailBiayaPotonganRepo
            ->updateDetailBiayaPotonganData($data, $id);

        return redirect('/keuangan/detail-biaya/'.$kodeBiaya);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($kodeBiaya, $id)
    {
        $destroy = $this
            ->detailBiayaPotonganRepo
            ->destroyDetailBiayaPotonganData($id);

        return response()
            ->json([
                'destroyed' => TRUE
            ]);
    }
}
