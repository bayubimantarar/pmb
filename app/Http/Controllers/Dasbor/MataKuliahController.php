<?php

namespace App\Http\Controllers\Dasbor;

use DataTables;
use App\Http\Controllers\Controller;
use App\Http\Requests\MataKuliahRequest;
use App\Repositories\MataKuliahRepository;

class MataKuliahController extends Controller
{
    private $matakuliahRepo;

    public function __construct(MataKuliahRepository $matakuliahRepository)
    {
        $this->matakuliahRepo = $matakuliahRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function data()
    {
        $matakuliah = $this
            ->matakuliahRepo
            ->getAllData();

        return DataTables::of($matakuliah)
            ->addColumn('action', function($matakuliah){
                return '<center><a href="/dasbor/mata-kuliah/form-ubah/'.$matakuliah->id.'" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i></a> <a href="#hapus" onclick="destroy('.$matakuliah->id.')" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a></center>';
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
        return view('dasbor.mata_kuliah.mata_kuliah');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dasbor.mata_kuliah.form_tambah');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MataKuliahRequest $matakuliahReq)
    {
        $kode = $matakuliahReq->kode;
        $nama = $matakuliahReq->nama;

        $data = [
            'kode' => $kode,
            'nama' => $nama,
        ];

        $store = $this
            ->matakuliahRepo
            ->storeMataKuliahData($data);

        return redirect('/dasbor/mata-kuliah')
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
        $matakuliah = $this
            ->matakuliahRepo
            ->getSingleData($id);

        return view('dasbor.mata_kuliah.form_ubah', compact(
            'matakuliah'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MataKuliahRequest $matakuliahReq, $id)
    {
        $kode = $MataKuliahReq->kode;
        $nama = $MataKuliahReq->nama;

        $data = [
            'kode' => $kode,
            'nama' => $nama,
        ];

        $update = $this
            ->matakuliahRepo
            ->updateMataKuliahData($data, $id);

        return redirect('/dasbor/mata-kuliah')
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
            ->matakuliahRepo
            ->destroyMataKuliahData($id);

        return response()
            ->json([
                'destroyed' => true
            ], 200);
    }
}
