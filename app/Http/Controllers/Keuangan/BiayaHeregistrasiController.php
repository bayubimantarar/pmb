<?php

namespace App\Http\Controllers\Keuangan;

use DataTables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PMB\BiayaHeregistrasiRepository;

class BiayaHeregistrasiController extends Controller
{
    private $biayaHeregistrasiRepo;

    public function __construct(
        BiayaHeregistrasiRepository $biayaHeregistrasiRepository
    ) {
        $this->biayaHeregistrasiRepo = $biayaHeregistrasiRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function data()
    {
        $biayaHeregistrasi = $this
            ->biayaHeregistrasiRepo
            ->getAllData();

        return DataTables::of($biayaHeregistrasi)
            ->addColumn('action', function($biayaHeregistrasi){
                return '<center><a href="/keuangan/biaya-heregistrasi/form-ubah/'.$biayaHeregistrasi->id.'" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i></a> <a href="#hapus" onclick="destroy('.$biayaHeregistrasi->id.')" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a></center>';
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
        $biayaHeregistrasi = $this
            ->biayaHeregistrasiRepo
            ->getAllData();

        $jumlah = $biayaHeregistrasi->count();

        return view('keuangan.biaya_heregistrasi.biaya_heregistrasi', compact(
            'jumlah'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('keuangan.biaya_heregistrasi.form_tambah');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $jumlah = $request->jumlah;

        $data = [
            'jumlah' => $jumlah
        ];

        $store = $this
            ->biayaHeregistrasiRepo
            ->storeBiayaHeregistrasiData($data);

        return redirect('/keuangan/biaya-heregistrasi');
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
        $biayaHeregistrasi = $this
            ->biayaHeregistrasiRepo
            ->getSingleData($id);

        return view('keuangan.biaya_heregistrasi.form_ubah', compact(
            'biayaHeregistrasi'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $jumlah = $request->jumlah;

        $data = [
            'jumlah' => $jumlah
        ];

        $update = $this
            ->biayaHeregistrasiRepo
            ->updateBiayaHeregistrasiData($data, $id);

        return redirect('/keuangan/biaya-heregistrasi');
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
            ->biayaHeregistrasiRepo
            ->destroyBiayaHeregistrasiData($id);

        return response()
            ->json([
                'destroyed' => TRUE
            ]);
    }
}
