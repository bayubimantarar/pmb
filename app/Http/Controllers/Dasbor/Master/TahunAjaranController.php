<?php

namespace App\Http\Controllers\Dasbor\Master;

use DataTables;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dasbor\Master\TahunAjaranRequest;
use App\Repositories\Dasbor\Master\TahunAjaranRepository;

class TahunAjaranController extends Controller
{
    private $tahunajaranRepo;

    public function __construct(TahunAjaranRepository $tahunajaranRepository)
    {
        $this->tahunajaranRepo = $tahunajaranRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function data()
    {
        $tahunajaran = $this
            ->tahunajaranRepo
            ->getAllData();

        return DataTables::of($tahunajaran)
            ->addColumn('action', function($tahunajaran){
                return '<center><a href="/dasbor/master/tahun-ajaran/form-ubah/'.$tahunajaran->id.'" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i></a> <a href="#hapus" onclick="destroy('.$tahunajaran->id.')" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a></center>';
            })
            ->editColumn('semester', function($tahunajaran){
                if($tahunajaran->semester == 1){
                    return 'Ganjil';
                }else{
                    return 'Genap';
                }
            })
            ->rawColumns(['action', 'semester'])
            ->make(true);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dasbor.master.tahun_ajaran.tahun_ajaran');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dasbor.master.tahun_ajaran.form_tambah');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TahunAjaranRequest $tahunajaranReq)
    {
        $tahunAwal  = $tahunajaranReq->tahun_awal;
        $tahunAkhir = $tahunajaranReq->tahun_akhir;
        $semester   = $tahunajaranReq->semester;
        $tahun      = $tahunAwal.' - '.$tahunAkhir;
        $kode       = $tahunajaranReq->kode;

        $data = [
            'kode'      => $kode,
            'tahun'     => $tahun,
            'semester'  => $semester
        ];

        $store = $this
            ->tahunajaranRepo
            ->storeTahunAjaranData($data);

        return redirect('/dasbor/master/tahun-ajaran')
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
        $tahunajaran = $this
            ->tahunajaranRepo
            ->getSingleData($id);

        $temptahun_awal     = substr($tahunajaran->tahun, 0, 4);
        $temptahun_akhir    = substr($tahunajaran->tahun, 7, 4);

        $tahun_awal     = (int)$temptahun_awal;
        $tahun_akhir    = (int)$temptahun_akhir;

        return view('dasbor.master.tahun_ajaran.form_ubah', compact(
            'tahunajaran',
            'tahun_awal',
            'tahun_akhir'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TahunAjaranRequest $tahunajaranReq, $id)
    {
        $kode           = $tahunajaranReq->kode;
        $tahunAwal      = $tahunajaranReq->tahun_awal;
        $tahunAkhir     = $tahunajaranReq->tahun_akhir;
        $semester       = $tahunajaranReq->semester;
        $tahun          = $tahunAwal.' - '.$tahunAkhir;

        $data = [
            'kode' => $kode,
            'tahun' => $tahun,
            'semester' => $semester
        ];

        $store = $this
            ->tahunajaranRepo
            ->updateTahunAjaranData($data, $id);

        return redirect('/dasbor/master/tahun-ajaran')
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
            ->tahunajaranRepo
            ->destroyTahunAjaranData($id);

        return response()
            ->json([
                'destroyed' => true
            ], 200);
    }
}
