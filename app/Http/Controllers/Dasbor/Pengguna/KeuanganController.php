<?php

namespace App\Http\Controllers\Dasbor\Pengguna;

use DataTables;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dasbor\Pengguna\KeuanganRequest;
use App\Repositories\Dasbor\Pengguna\KeuanganRepository;

class KeuanganController extends Controller
{
    private $keuanganRepo;

    public function __construct(keuanganRepository $keuanganRepository)
    {
        $this->keuanganRepo = $keuanganRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function data()
    {
        $keuangan = $this
            ->keuanganRepo
            ->getAllData();

        return DataTables::of($keuangan)
            ->addColumn('action', function($keuangan){
                return '<center><a href="/dasbor/pengguna/keuangan/form-ubah/'.$keuangan->id.'" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i></a> <a href="#hapus" onclick="destroy('.$keuangan->id.')" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a></center>';
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
        return view('dasbor.pengguna.keuangan.keuangan');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dasbor.pengguna.keuangan.form_tambah');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KeuanganRequest $keuanganReq)
    {
        $nidn           = $keuanganReq->nidn;
        $nama           = $keuanganReq->nama;
        $email          = $keuanganReq->email;
        $nomor_telepon  = $keuanganReq->nomor_telepon;
        $alamat         = $keuanganReq->alamat;
        $password       = $keuanganReq->password;

        $data = [
            'nidn'          => $nidn,
            'nama'          => $nama,
            'email'         => $email,
            'nomor_telepon' => $nomor_telepon,
            'alamat'        => $alamat,
            'password'      => bcrypt($password)
        ];

        $store = $this
            ->keuanganRepo
            ->storeKeuanganData($data);

        return redirect('/dasbor/pengguna/keuangan')
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
        $keuangan = $this
            ->keuanganRepo
            ->getSingleData($id);

        return view('dasbor.pengguna.keuangan.form_ubah', compact('keuangan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(keuanganRequest $keuanganReq, $id)
    {
        $nidn           = $keuanganReq->nidn;
        $nama           = $keuanganReq->nama;
        $email          = $keuanganReq->email;
        $nomor_telepon  = $keuanganReq->nomor_telepon;
        $alamat         = $keuanganReq->alamat;
        $password       = $keuanganReq->password;

        if($password == NULL){
            $data = [
                'nidn'          => $nidn,
                'nama'          => $nama,
                'email'         => $email,
                'nomor_telepon' => $nomor_telepon,
                'alamat'        => $alamat
            ];

            $store = $this
                ->keuanganRepo
                ->updateKeuanganData($data, $id);

            return redirect('/dasbor/pengguna/keuangan')
                ->with([
                    'notification' => 'Data berhasil diubah'
                ]);
        }else{
            $data = [
                'nidn'          => $nidn,
                'nama'          => $nama,
                'email'         => $email,
                'nomor_telepon' => $nomor_telepon,
                'alamat'        => $alamat,
                'password'      => bcrypt($password)
            ];

            $store = $this
                ->keuanganRepo
                ->updateKeuanganData($data, $id);

            return redirect('/dasbor/pengguna/keuangan')
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
            ->keuanganRepo
            ->destroyKeuanganData($id);

        return response()
            ->json([
                'destroyed' => true
            ], 200);
    }
}
