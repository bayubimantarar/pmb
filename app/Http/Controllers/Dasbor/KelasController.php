<?php

namespace App\Http\Controllers\Dasbor;

use DataTables;
use App\Http\Requests\KelasRequest;
use App\Http\Controllers\Controller;
use App\Repositories\KelasRepository;

class KelasController extends Controller
{
    private $kelasRepo;

    public function __construct(KelasRepository $kelasRepository)
    {
        $this->kelasRepo = $kelasRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function data()
    {
        $kelas = $this
            ->kelasRepo
            ->getAllData();

        return DataTables::of($kelas)
            ->addColumn('action', function($kelas){
                return '<center><a href="/dasbor/kelas/form-ubah/'.$kelas->id.'" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i></a> <a href="#hapus" onclick="destroy('.$kelas->id.')" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a></center>';
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
        return view('dasbor.kelas.kelas');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dasbor.kelas.form_tambah');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KelasRequest $kelasReq)
    {
        $kode = $kelasReq->kode;
        $nama = $kelasReq->nama;
        
        $data = [
            'kode' => $kode,
            'nama' => $nama
        ];

        $store = $this
            ->kelasRepo
            ->storeKelasData($data);

        return redirect('/dasbor/kelas')
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
        $kelas = $this
            ->kelasRepo
            ->getSingleData($id);

        return view('dasbor.kelas.form_ubah', compact(
            'kelas'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(KelasRequest $kelasReq, $id)
    {
        $kode = $kelasReq->kode;
        $nama = $kelasReq->nama;

        $data = [
            'kode' => $kode,
            'nama' => $nama
        ];

        $update = $this
            ->kelasRepo
            ->updateKelasData($data, $id);

        return redirect('/dasbor/kelas')
            ->with([
                'notification' => 'Data berhasil diubah'
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
            ->kelasRepo
            ->destroyKelasData($id);

        return response()
            ->json([
                'destroyed' => true
            ], 200);
    }
}
