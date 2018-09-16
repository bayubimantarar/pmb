<?php

namespace App\Http\Controllers\Dasbor;

use DataTables;
use App\Http\Controllers\Controller;
use App\Http\Requests\MahasiswaRequest;
use App\Repositories\MahasiswaRepository;

class MahasiswaController extends Controller
{
    private $mahasiswaRepo;

    public function __construct(MahasiswaRepository $mahasiswaRepository)
    {
        $this->mahasiswaRepo = $mahasiswaRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function data()
    {
        $mahasiswa = $this
            ->mahasiswaRepo
            ->getAllData();

        return DataTables::of($mahasiswa)
            ->addColumn('action', function($mahasiswa){
                return '<center><a href="/dasbor/mahasiswa/form-ubah/'.$mahasiswa->id.'" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i></a> <a href="#hapus" onclick="destroy('.$mahasiswa->id.')" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a></center>';
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
        return view('dasbor.mahasiswa.mahasiswa');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dasbor.mahasiswa.form_tambah');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MahasiswaRequest $mahasiswaReq)
    {
        $data = [
            'nim' => $mahasiswaReq->nim,
            'nama' => $mahasiswaReq->nama,
            'jenis_kelamin' => $mahasiswaReq->jenis_kelamin,
            'alamat' => $mahasiswaReq->alamat,
            'email' => $mahasiswaReq->email,
            'password' => bcrypt('123')
        ];

        $store = $this
            ->mahasiswaRepo
            ->storeMahasiswaData($data);

        return redirect('/dasbor/mahasiswa');
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
        $mahasiswa = $this
            ->mahasiswaRepo
            ->getSingleData($id);

        return view('dasbor.mahasiswa.form_ubah', compact(
            'mahasiswa'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MahasiswaRequest $mahasiswaReq, $id)
    {
        $data = [
            'nim' => $mahasiswaReq->nim,
            'nama' => $mahasiswaReq->nama,
            'jenis_kelamin' => $mahasiswaReq->jenis_kelamin,
            'alamat' => $mahasiswaReq->alamat,
            'email' => $mahasiswaReq->email
        ];

        $store = $this
            ->mahasiswaRepo
            ->updateMahasiswaData($data, $id);

        return redirect('/dasbor/mahasiswa');
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
            ->mahasiswaRepo
            ->destroyMahasiswaData($id);

        return response()
            ->json([
                'destroyed' => true
            ], 200);
    }
}
