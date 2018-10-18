<?php

namespace App\Http\Controllers\Dasbor\Pengguna;

use DataTables;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dasbor\Pengguna\PanitiaRequest;
use App\Repositories\Dasbor\Pengguna\PanitiaRepository;

class PanitiaController extends Controller
{
    private $panitiaRepo;

    public function __construct(panitiaRepository $panitiaRepository)
    {
        $this->panitiaRepo = $panitiaRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function data()
    {
        $panitia = $this
            ->panitiaRepo
            ->getAllData();

        return DataTables::of($panitia)
            ->addColumn('action', function($panitia){
                return '<center><a href="/dasbor/pengguna/panitia/form-ubah/'.$panitia->id.'" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i></a> <a href="#hapus" onclick="destroy('.$panitia->id.')" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a></center>';
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
        return view('dasbor.pengguna.panitia.panitia');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dasbor.pengguna.panitia.form_tambah');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PanitiaRequest $panitiaReq)
    {
        $nidn           = $panitiaReq->nidn;
        $nama           = $panitiaReq->nama;
        $email          = $panitiaReq->email;
        $nomor_telepon  = $panitiaReq->nomor_telepon;
        $alamat         = $panitiaReq->alamat;
        $password       = $panitiaReq->password;

        $data = [
            'nidn'          => $nidn,
            'nama'          => $nama,
            'email'         => $email,
            'nomor_telepon' => $nomor_telepon,
            'alamat'        => $alamat,
            'password'      => bcrypt($password)
        ];

        $store = $this
            ->panitiaRepo
            ->storePanitiaData($data);

        return redirect('/dasbor/pengguna/panitia')
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
        $panitia = $this
            ->panitiaRepo
            ->getSingleData($id);

        return view('dasbor.pengguna.panitia.form_ubah', compact('panitia'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PanitiaRequest $panitiaReq, $id)
    {
        $nidn           = $panitiaReq->nidn;
        $nama           = $panitiaReq->nama;
        $email          = $panitiaReq->email;
        $nomor_telepon  = $panitiaReq->nomor_telepon;
        $alamat         = $panitiaReq->alamat;
        $password       = $panitiaReq->password;

        if($password == NULL){
            $data = [
                'nidn'          => $nidn,
                'nama'          => $nama,
                'email'         => $email,
                'nomor_telepon' => $nomor_telepon,
                'alamat'        => $alamat
            ];

            $store = $this
                ->panitiaRepo
                ->updatePanitiaData($data, $id);

            return redirect('/dasbor/pengguna/panitia')
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
                ->panitiaRepo
                ->updatePanitiaData($data, $id);

            return redirect('/dasbor/pengguna/panitia')
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
            ->panitiaRepo
            ->destroyPanitiaData($id);

        return response()
            ->json([
                'destroyed' => true
            ], 200);
    }
}
