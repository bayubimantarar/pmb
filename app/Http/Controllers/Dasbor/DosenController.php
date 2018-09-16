<?php

namespace App\Http\Controllers\Dasbor;

use DataTables;
use App\Http\Requests\DosenRequest;
use App\Http\Controllers\Controller;
use App\Repositories\DosenRepository;

class DosenController extends Controller
{
    private $dosenRepo;

    public function __construct(DosenRepository $dosenRepository)
    {
        $this->dosenRepo = $dosenRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function data()
    {
        $dosen = $this
            ->dosenRepo
            ->getAllData();

        return DataTables::of($dosen)
            ->addColumn('action', function($dosen){
                return '<center><a href="/dasbor/dosen/form-ubah/'.$dosen->id.'" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i></a> <a href="#hapus" onclick="destroy('.$dosen->id.')" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a></center>';
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
        return view('dasbor.dosen.dosen');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dasbor.dosen.form_tambah');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DosenRequest $dosenReq)
    {
        $data = [
            'nip' => $dosenReq->nip,
            'nama' => $dosenReq->nama,
            'jenis_kelamin' => $dosenReq->jenis_kelamin,
            'alamat' => $dosenReq->alamat,
            'email' => $dosenReq->email,
            'password' => bcrypt('123')
        ];

        $store = $this
            ->dosenRepo
            ->storeDosenData($data);

        return redirect('/dasbor/dosen');
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
        $dosen = $this
            ->dosenRepo
            ->getSingleData($id);

        return view('dasbor.dosen.form_ubah', compact('dosen'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DosenRequest $dosenReq, $id)
    {
        $data = [
            'nip' => $dosenReq->nip,
            'nama' => $dosenReq->nama,
            'jenis_kelamin' => $dosenReq->jenis_kelamin,
            'alamat' => $dosenReq->alamat,
            'email' => $dosenReq->email
        ];

        $store = $this
            ->dosenRepo
            ->updateDosenData($data, $id);

        return redirect('/dasbor/dosen');
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
            ->dosenRepo
            ->destroyDosenData($id);

        return response()
            ->json([
                'destroyed' => true
            ], 200);
    }
}
