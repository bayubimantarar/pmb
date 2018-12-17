<?php

namespace App\Http\Controllers\Keuangan;

use DataTables;
use App\Http\Controllers\Controller;
use App\Http\Requests\Keuangan\DetailPotonganRequest;
use App\Repositories\PMB\DetailBiayaPotonganRepository;

class DetailPotonganController extends Controller
{
    private $detailBiayaPotonganRepo;

    public function __construct(
        DetailBiayaPotonganRepository $detailBiayaPotonganRepository
    ) {
        $this->detailBiayaPotonganRepo = $detailBiayaPotonganRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function data($kodePotongan)
    {
        $detailPotongan = $this
            ->detailBiayaPotonganRepo
            ->getSingleDataForDetailBiayaPotonganForPotongan($kodePotongan);

        return DataTables::of($detailPotongan)
            ->addColumn('action', function($detailPotongan) use ($kodePotongan){
                return '<center><a href="/keuangan/detail-potongan/'.$kodePotongan.'/form-ubah/'.$detailPotongan->id.'" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i></a> <a href="#hapus" onclick="destroy('.$detailPotongan->id.')" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a></center>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($kodePotongan)
    {
        return view('keuangan.detail_potongan.detail_potongan', compact(
            'kodePotongan'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($kodePotongan)
    {
        return view('keuangan.detail_potongan.form_tambah', compact(
            'kodePotongan'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($kodePotongan, detailPotonganRequest $detailPotonganReq)
    {
        $deskripsi  = $detailPotonganReq->deskripsi;
        $jumlah     = $detailPotonganReq->jumlah;

        $data = [
            'kode_potongan' => $kodePotongan,
            'deskripsi' => $deskripsi,
            'jumlah' => $jumlah
        ];

        $store = $this
            ->detailBiayaPotonganRepo
            ->storeDetailBiayaPotonganData($data);

        return redirect('/keuangan/detail-potongan/'.$kodePotongan);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($kodePotongan, $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($kodePotongan, $id)
    {
        $detailPotongan = $this
            ->detailBiayaPotonganRepo
            ->getSingleData($id);

        return view('keuangan.detail_potongan.form_ubah', compact(
            'kodePotongan', 'detailPotongan', 'id'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($kodePotongan, detailPotonganRequest $detailPotonganReq, $id)
    {
        $deskripsi  = $detailPotonganReq->deskripsi;
        $jumlah     = $detailPotonganReq->jumlah;

        $data = [
            'kode_potongan' => $kodePotongan,
            'deskripsi' => $deskripsi,
            'jumlah' => $jumlah
        ];

        $store = $this
            ->detailBiayaPotonganRepo
            ->updateDetailBiayaPotonganData($data, $id);

        return redirect('/keuangan/detail-potongan/'.$kodePotongan);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($kodePotongan, $id)
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
