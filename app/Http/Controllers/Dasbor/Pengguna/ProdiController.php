<?php

namespace App\Http\Controllers\Dasbor\Pengguna;

use DataTables;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dasbor\Pengguna\ProdiRequest;
use App\Repositories\Dasbor\Master\ProdiRepository as ProdiMasterRepository;
use App\Repositories\Dasbor\Pengguna\ProdiRepository;

class ProdiController extends Controller
{
    private $prodiRepo;
    private $prodiMasterRepo;

    public function __construct(
        ProdiRepository $prodiRepository,
        ProdiMasterRepository $prodiMasterRepository
    ) {
        $this->prodiRepo = $prodiRepository;
        $this->prodiMasterRepo = $prodiMasterRepository;
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
                return '<center><a href="/dasbor/pengguna/prodi/form-ubah/'.$prodi->id.'" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i></a> <a href="#hapus" onclick="destroy('.$prodi->id.')" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a></center>';
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
        return view('dasbor.pengguna.prodi.prodi');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $prodi = $this
            ->prodiMasterRepo
            ->getAllData();

        return view('dasbor.pengguna.prodi.form_tambah', compact('prodi'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProdiRequest $prodiReq)
    {
        $nidn           = $prodiReq->nidn;
        $kode_prodi     = $prodiReq->kode_prodi;
        $nama           = $prodiReq->nama;
        $email          = $prodiReq->email;
        $nomor_telepon  = $prodiReq->nomor_telepon;
        $alamat         = $prodiReq->alamat;
        $password       = $prodiReq->password;

        $data = [
            'nidn'          => $nidn,
            'kode_prodi'    => $kode_prodi,
            'nama'          => $nama,
            'email'         => $email,
            'nomor_telepon' => $nomor_telepon,
            'alamat'        => $alamat,
            'password'      => bcrypt($password)
        ];

        $store = $this
            ->prodiRepo
            ->storeProdiData($data);

        return redirect('/dasbor/pengguna/prodi')
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

        $prodiMaster = $this
            ->prodiMasterRepo
            ->getAllData();

        return view('dasbor.pengguna.prodi.form_ubah', compact(
            'prodi', 'prodiMaster'
        ));
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
        $nidn           = $prodiReq->nidn;
        $kode_prodi     = $prodiReq->kode_prodi;
        $nama           = $prodiReq->nama;
        $email          = $prodiReq->email;
        $nomor_telepon  = $prodiReq->nomor_telepon;
        $alamat         = $prodiReq->alamat;
        $password       = $prodiReq->password;

        if($password == NULL){
            $data = [
                'nidn'          => $nidn,
                'kode_prodi'    => $kode_prodi,
                'nama'          => $nama,
                'email'         => $email,
                'nomor_telepon' => $nomor_telepon,
                'alamat'        => $alamat
            ];

            $store = $this
                ->prodiRepo
                ->updateProdiData($data, $id);

            return redirect('/dasbor/pengguna/prodi')
                ->with([
                    'notification' => 'Data berhasil diubah'
                ]);
        }else{
            $data = [
                'nidn'          => $nidn,
                'kode_prodi'    => $kode_prodi,
                'nama'          => $nama,
                'email'         => $email,
                'nomor_telepon' => $nomor_telepon,
                'alamat'        => $alamat,
                'password'      => bcrypt($password)
            ];

            $store = $this
                ->prodiRepo
                ->updateProdiData($data, $id);

            return redirect('/dasbor/pengguna/prodi')
                ->with([
                    'notification' => 'Data berhasil diubah'
                ]);
        }
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
