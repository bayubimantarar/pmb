<?php

namespace App\Http\Controllers\Panitia\PMB;

use PDF;
use Excel;
use DataTables;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\PMB\JadwalUjian;
use App\Models\Dasbor\Master\Prodi;
use App\Http\Controllers\Controller;
use App\Repositories\PMB\HasilRepository;
use App\Exports\Panitia\PMB\LaporanExport;
use App\Repositories\PMB\NilaiLulusRepository;
use App\Repositories\PMB\HasilUpdateRepository;

class LaporanController extends Controller
{
    private $hasilRepo, $nilaiLulusRepo;

    public function __construct(
        HasilRepository $hasilRepository,
        NilaiLulusRepository $nilaiLulusRepository,
        HasilUpdateRepository $hasilUpdateRepository
    ) {
        $this->hasilRepo = $hasilRepository;
        $this->nilaiLulusRepo = $nilaiLulusRepository;
        $this->hasilUpdateRepo = $hasilUpdateRepository;
    }

    public function data()
    {
        $hasil = $this
            ->hasilUpdateRepo
            ->getAllHasilUPdateDataForLaporan();

        $nilaiLulus = $this
            ->nilaiLulusRepo
            ->getAllData()
            ->first();

        return DataTables::of($hasil)
            ->editColumn('status', function($hasil) use($nilaiLulus){
                if($hasil->nilai_angka >= $nilaiLulus->nilai){
                    return '<center><span class="label label-success">Lulus</span></center>';
                }else{
                    return '<center><span class="label label-danger">Tidak Lulus</span></center>';
                }
            })
            ->editColumn('created_at', function($hasil){
                return $hasil->created_at->formatLocalized('%d %B %Y');
            })
            ->rawColumns(['status', 'created_at'])
            ->make(true);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prodi = Prodi::all();
        $jadwalUjian = JadwalUjian::all();

        return view('panitia.pmb.laporan.laporan', compact(
            'prodi', 'jadwalUjian'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function filterJurusan($jurusan, $tahun)
    {
        $hasil = $this
            ->hasilRepo
            ->getAllHasilDataForLaporanByJurusan($jurusan, $tahun);

        $nilaiLulus = $this
            ->nilaiLulusRepo
            ->getAllData()
            ->first();

        return DataTables::of($hasil)
            ->editColumn('status', function($hasil) use($nilaiLulus){
                if($hasil->nilai_angka >= $nilaiLulus->nilai){
                    return '<center><span class="label label-success">Lulus</span></center>';
                }else{
                    return '<center><span class="label label-danger">Tidak Lulus</span></center>';
                }
            })
            ->editColumn('created_at', function($hasil){
                return $hasil->created_at->formatLocalized('%d %B %Y');
            })
            ->rawColumns(['status', 'created_at'])
            ->make(true);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function filterTahun($tahun)
    {
        $hasil = $this
            ->hasilRepo
            ->getAllHasilDataForLaporanByTahun($tahun);

        $nilaiLulus = $this
            ->nilaiLulusRepo
            ->getAllData()
            ->first();

        return DataTables::of($hasil)
            ->editColumn('status', function($hasil) use($nilaiLulus){
                if($hasil->nilai_angka >= $nilaiLulus->nilai){
                    return '<center><span class="label label-success">Lulus</span></center>';
                }else{
                    return '<center><span class="label label-danger">Tidak Lulus</span></center>';
                }
            })
            ->editColumn('created_at', function($hasil){
                return $hasil->created_at->formatLocalized('%d %B %Y');
            })
            ->rawColumns(['status', 'created_at'])
            ->make(true);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function filterSesi($sesi)
    {
        $hasil = $this
            ->hasilRepo
            ->getAllHasilDataForLaporanBySesi($sesi);

        $nilaiLulus = $this
            ->nilaiLulusRepo
            ->getAllData()
            ->first();

        return DataTables::of($hasil)
            ->editColumn('status', function($hasil) use($nilaiLulus){
                if($hasil->nilai_angka >= $nilaiLulus->nilai){
                    return '<center><span class="label label-success">Lulus</span></center>';
                }else{
                    return '<center><span class="label label-danger">Tidak Lulus</span></center>';
                }
            })
            ->editColumn('created_at', function($hasil){
                return $hasil->created_at->formatLocalized('%d %B %Y');
            })
            ->rawColumns(['status', 'created_at'])
            ->make(true);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function filterPendaftaran($pendaftaran)
    {
        $hasil = $this
            ->hasilRepo
            ->getAllHasilDataForLaporanByPendaftaran($pendaftaran);

        $nilaiLulus = $this
            ->nilaiLulusRepo
            ->getAllData()
            ->first();

        return DataTables::of($hasil)
            ->editColumn('status', function($hasil) use($nilaiLulus){
                if($hasil->nilai_angka >= $nilaiLulus->nilai){
                    return '<center><span class="label label-success">Lulus</span></center>';
                }else{
                    return '<center><span class="label label-danger">Tidak Lulus</span></center>';
                }
            })
            ->editColumn('created_at', function($hasil){
                return $hasil->created_at->formatLocalized('%d %B %Y');
            })
            ->rawColumns(['status', 'created_at'])
            ->make(true);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function filterStatus($status)
    {
        $hasil = $this
            ->hasilRepo
            ->getAllHasilDataForLaporanByStatus($status);

        $nilaiLulus = $this
            ->nilaiLulusRepo
            ->getAllData()
            ->first();

        return DataTables::of($hasil)
            ->editColumn('status', function($hasil) use($nilaiLulus){
                if($hasil->nilai_angka >= $nilaiLulus->nilai){
                    return '<center><span class="label label-success">Lulus</span></center>';
                }else{
                    return '<center><span class="label label-danger">Tidak Lulus</span></center>';
                }
            })
            ->editColumn('created_at', function($hasil){
                return $hasil->created_at->formatLocalized('%d %B %Y');
            })
            ->rawColumns(['status', 'created_at'])
            ->make(true);
    }

    public function downloadExcel($tahun)
    {
        $hasil = $this
            ->hasilRepo
            ->getAllHasilDataForLaporanByTahun($tahun);

        $pdfKartuUjian = PDF::LoadView('panitia.pmb.laporan.export', compact(
            'hasil'
        ));

        return $pdfKartuUjian->download('Laporan.pdf');
    }

    public function chart()
    {
        $hasil = $this
            ->hasilUpdateRepo
            ->getAllHasilUpdateDataForChart();

        return response()->json($hasil);
    }

    public function chartFilterTahun($tahun)
    {
        $hasil = $this
            ->hasilRepo
            ->getAllHasilDataForChart($tahun);

        return response()->json($hasil);
    }
}
