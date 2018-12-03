<?php

namespace App\Http\Controllers\Panitia\PMB;

use DataTables;
use App\Http\Controllers\Controller;
use App\Repositories\PMB\PotonganRepository;
use App\Http\Requests\Panitia\PotonganRequest;

class PotonganController extends Controller
{
    private $potonganRepo;

    public function __construct(PotonganRepository $potonganRepository)
    {
        $this->potonganRepo = $potonganRepository;
    }

    public function data()
    {
        $potongan = $this
            ->potonganRepo
            ->getAllData();

        return DataTables::of($potongan)
            ->addColumn('action', function($potongan){
                return '<center><a href="/panitia/pmb/potongan/form-ubah/'.$potongan->id.'" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i></a> <a href="#hapus" onclick="destroy('.$potongan->id.')" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a></center>';
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
        return view('panitia.pmb.potongan.potongan');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('panitia.pmb.potongan.form_tambah');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PotonganRequest $potonganReq)
    {
        $deskripsi = $potonganReq->deskripsi;
        $jumlahPotongan = $potonganReq->jumlah_potongan;

        $data = [
            'deskripsi' => $deskripsi,
            'jumlah_potongan' => $jumlahPotongan
        ];

        $store = $this
            ->potonganRepo
            ->storePotonganData($data);

        return redirect('/panitia/pmb/potongan');
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
        $potongan = $this
            ->potonganRepo
            ->getSingleData($id);

        return view('panitia.pmb.potongan.form_ubah', compact(
            'potongan'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PotonganRequest $potonganReq, $id)
    {
        $deskripsi = $potonganReq->deskripsi;
        $jumlahPotongan = $potonganReq->jumlah_potongan;

        $data = [
            'deskripsi' => $deskripsi,
            'jumlah_potongan' => $jumlahPotongan
        ];

        $store = $this
            ->potonganRepo
            ->updatePotonganData($data, $id);

        return redirect('/panitia/pmb/potongan');
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
            ->potonganRepo
            ->destroyPotonganData($id);

        return response()
            ->json([
                'destroyed' => TRUE
            ]);
    }
}
