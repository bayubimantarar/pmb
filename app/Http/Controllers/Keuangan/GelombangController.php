<?php

namespace App\Http\Controllers\Keuangan;

use DataTables;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PMB\GelombangRepository;
use App\Http\Requests\Panitia\GelombangRequest;

class GelombangController extends Controller
{
    protected $gelombangRepo;

    public function __construct(GelombangRepository $gelombangRepository)
    {
        $this->gelombangRepo = $gelombangRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function data()
    {
        $gelombang = $this
            ->gelombangRepo
            ->getAllData();

        return DataTables::of($gelombang)
            ->addColumn('action', function($gelombang){
                return '<center><a href="/keuangan/gelombang/form-ubah/'.$gelombang->id.'" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i></a> <a href="#hapus" onclick="destroy('.$gelombang->id.')" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a></center>';
            })
            ->editCOlumn('dari_tanggal', function($gelombang){
                return $gelombang->dari_tanggal->formatLocalized('%d %B %Y');
            })
            ->editCOlumn('sampai_tanggal', function($gelombang){
                return $gelombang->sampai_tanggal->formatLocalized('%d %B %Y');
            })
            ->rawColumns(['action', 'dari_tanggal', 'sampai_tanggal'])
            ->make(true);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gelombang = $this
            ->gelombangRepo
            ->getAllData()
            ->count();

        return view('keuangan.gelombang.gelombang', compact('gelombang'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $gelombang = $this
            ->gelombangRepo
            ->getAllData()
            ->count();

        if($gelombang >= 3){
            abort(404);
        }

        return view('keuangan.gelombang.form_tambah', compact('gelombang'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GelombangRequest $gelombangReq)
    {
        $kode = $gelombangReq->kode;
        $nama = $gelombangReq->nama;
        $dariTanggal = Carbon::parse($gelombangReq->dari_tanggal);
        $sampaiTanggal =  Carbon::parse($gelombangReq->sampai_tanggal);
        $jumlahPotongan = $gelombangReq->jumlah_potongan;

        $data = [
            'kode' => $kode,
            'nama' => $nama,
            'dari_tanggal' => $dariTanggal,
            'sampai_tanggal' => $sampaiTanggal,
            'jumlah_potongan' => $jumlahPotongan
        ];

        $store = $this
            ->gelombangRepo
            ->storeGelombangData($data);

        return redirect('/keuangan/gelombang');
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
        $gelombang = $this
            ->gelombangRepo
            ->getSingleData($id);

        $dariTanggal = $gelombang
            ->dari_tanggal
            ->format('d-m-Y');

        $sampaiTanggal = $gelombang
            ->sampai_tanggal
            ->format('d-m-Y');

        return view('keuangan.gelombang.form_ubah', compact(
            'gelombang',
            'dariTanggal',
            'sampaiTanggal'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GelombangRequest $gelombangReq, $id)
    {
        $kode = $gelombangReq->kode;
        $nama = $gelombangReq->nama;
        $dariTanggal = Carbon::parse($gelombangReq->dari_tanggal);
        $sampaiTanggal =  Carbon::parse($gelombangReq->sampai_tanggal);
        $jumlahPotongan = $gelombangReq->jumlah_potongan;

        $data = [
            'kode' => $kode,
            'nama' => $nama,
            'dari_tanggal' => $dariTanggal,
            'sampai_tanggal' => $sampaiTanggal,
            'jumlah_potongan' => $jumlahPotongan
        ];

        $update = $this
            ->gelombangRepo
            ->updateGelombangData($data, $id);

        return redirect('/keuangan/gelombang');
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
            ->gelombangRepo
            ->destroyGelombangData($id);

        return response()
            ->json([
                'destroyed' => TRUE
            ], 200);
    }
}
