<?php

namespace App\Http\Controllers\Dasbor;

use DataTables;
use App\Http\Controllers\Controller;
use App\Http\Requests\JenisUjianRequest;
use App\Repositories\JenisUjianRepository;

class JenisUjianController extends Controller
{
    private $jenisujianRepo;

    public function __construct(JenisUjianRepository $jenisujianRepository)
    {
        $this->jenisujianRepo = $jenisujianRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function data()
    {
        $jenisujian = $this
            ->jenisujianRepo
            ->getAllData();

        return DataTables::of($jenisujian)
            ->addColumn('action', function($jenisujian){
                return '<center><a href="/dasbor/jenis-ujian/form-ubah/'.$jenisujian->id.'" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i></a> <a href="#hapus" onclick="destroy('.$jenisujian->id.')" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a></center>';
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
        return view('dasbor.jenis_ujian.jenis_ujian');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dasbor.jenis_ujian.form_tambah');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(JenisUjianRequest $jenisujianReq)
    {
        $data = [
            'kode' => $jenisujianReq->kode,
            'nama' => $jenisujianReq->nama,
        ];

        $store = $this
            ->jenisujianRepo
            ->storeJenisUjianData($data);

        return redirect('/dasbor/jenis-ujian');
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
        $jenisujian = $this
            ->jenisujianRepo
            ->getSingleData($id);

        return view('dasbor.jenis_ujian.form_ubah', compact(
            'jenisujian'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(JenisUjianRequest $jenisujianReq, $id)
    {
        $data = [
            'kode' => $jenisujianReq->kode,
            'nama' => $jenisujianReq->nama,
        ];

        $store = $this
            ->jenisujianRepo
            ->updateJenisUjianData($data, $id);

        return redirect('/dasbor/jenis-ujian');
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
            ->jenisujianRepo
            ->destroyJenisUjianData($id);

        return response()
            ->json([
                'destroyed' => true
            ], 200);
    }
}
