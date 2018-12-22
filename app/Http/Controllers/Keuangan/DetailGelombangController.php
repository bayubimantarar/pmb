<?php

namespace App\Http\Controllers\Keuangan;

use DataTables;
use App\Http\Controllers\Controller;
use App\Repositories\PMB\GelombangRepository;
use App\Http\Requests\Keuangan\DetailGelombangRequest;
use App\Repositories\PMB\DetailBiayaPotonganRepository;

class DetailGelombangController extends Controller
{
    private $gelombangRepo, $detailBiayaPotonganRepo;

    public function __construct(
        GelombangRepository $gelombangRepository,
        DetailBiayaPotonganRepository $detailBiayaPotonganRepository
    ) {
        $this->gelombangRepo = $gelombangRepository;
        $this->detailBiayaPotonganRepo = $detailBiayaPotonganRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function data($kodeGelombang)
    {
        $detailGelombang = $this
            ->detailBiayaPotonganRepo
            ->getSingleDataForDetailBiayaPotonganForGelombang($kodeGelombang);

        return DataTables::of($detailGelombang)
            ->addColumn('action', function($detailGelombang) use ($kodeGelombang){
                return '<center><a href="/keuangan/detail-gelombang/'.$kodeGelombang.'/form-ubah/'.$detailGelombang->id.'" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i></a> <a href="#hapus" onclick="destroy('.$detailGelombang->id.')" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a></center>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($kodeGelombang)
    {
        return view('keuangan.detail_gelombang.detail_gelombang', compact(
            'kodeGelombang'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($kodeGelombang)
    {
        return view('keuangan.detail_gelombang.form_tambah', compact(
            'biaya', 'kodeGelombang'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($kodeGelombang, detailGelombangRequest $detailGelombangReq)
    {
        $deskripsi  = $detailGelombangReq->deskripsi;
        $jumlah     = $detailGelombangReq->jumlah;

        $data = [
            'kode_gelombang' => $kodeGelombang,
            'deskripsi' => $deskripsi,
            'jumlah' => $jumlah
        ];

        $store = $this
            ->detailBiayaPotonganRepo
            ->storeDetailBiayaPotonganData($data);

        return redirect('/keuangan/detail-gelombang/'.$kodeGelombang);
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
    public function edit($kodeGelombang, $id)
    {
        $detailBiaya = $this
            ->detailBiayaPotonganRepo
            ->getSingleData($id);

        return view('keuangan.detail_gelombang.form_ubah', compact(
            'kodeGelombang', 'detailBiaya', 'id'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($kodeGelombang, detailGelombangRequest $detailGelombangReq, $id)
    {
        $deskripsi  = $detailGelombangReq->deskripsi;
        $jumlah     = $detailGelombangReq->jumlah;

        $data = [
            'kode_gelombang' => $kodeGelombang,
            'deskripsi' => $deskripsi,
            'jumlah' => $jumlah
        ];

        $store = $this
            ->detailBiayaPotonganRepo
            ->updateDetailBiayaPotonganData($data, $id);

        return redirect('/keuangan/detail-gelombang/'.$kodeGelombang);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($kodeGelombang, $id)
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
