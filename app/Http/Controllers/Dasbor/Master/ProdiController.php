<?php

namespace App\Http\Controllers\Dasbor\Master;

use DataTables;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dasbor\Master\ProdiRequest;
use App\Repositories\Dasbor\Master\ProdiRepository;

class ProdiController extends Controller
{
    private $prodiRepo;

    public function __construct(ProdiRepository $prodiRepository)
    {
        $this->prodiRepo = $prodiRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function data()
    {
        $prodi = $this
            ->prodiRepo
            ->getAllData();

        return DataTables::of($prodi)
            ->addColumn('action', function($prodi){
                return '<center><a href="/dasbor/master/prodi/form-ubah/'.$prodi->id.'" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i></a> <a href="#hapus" onclick="destroy('.$prodi->id.')" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a></center>';
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
        return view('dasbor.master.prodi.prodi');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dasbor.master.prodi.form_tambah');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProdiRequest $prodiReq)
    {
        $kode = $prodiReq->kode;
        $nama = $prodiReq->nama;

        $data = [
            'kode' => $kode,
            'nama' => $nama
        ];

        $store = $this
            ->prodiRepo
            ->storeProdiData($data);

        return redirect('/dasbor/master/prodi')
            ->with([
                'notification' => 'Data berhasil disimpan'
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
        $prodi = $this
            ->prodiRepo
            ->getSingleData($id);

        return view('dasbor.master.prodi.form_ubah', compact('prodi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProdiRequest $prodiReq, $id)
    {
        $kode = $prodiReq->kode;
        $nama = $prodiReq->nama;

        $data = [
            'kode' => $kode,
            'nama' => $nama
        ];

        $store = $this
            ->prodiRepo
            ->updateProdiData($data, $id);

        return redirect('/dasbor/master/prodi')
            ->with([
                'notification' => 'Data berhasil disimpan'
            ]);
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
            ->prodiRepo
            ->destroyProdiData($id);

        return response()
            ->json([
                'destroyed' => true
            ], 200);
    }
}
