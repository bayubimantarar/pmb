<?php

namespace App\Http\Controllers\Panitia\PMB;

use Mail;
use DataTables;
use Carbon\Carbon;
use App\Mail\PMB\JadwalUjian;
use App\Jobs\KirimJadwalUjianJob;
use App\Http\Controllers\Controller;
use App\Repositories\PMB\GelombangRepository;
use App\Repositories\Prodi\PMB\SoalRepository;
use App\Repositories\PMB\JadwalUjianRepository;
use App\Http\Requests\Panitia\JadwalUjianRequest;
use App\Repositories\PMB\CalonMahasiswaRepository;
use App\Repositories\Dasbor\Master\ProdiRepository;
use App\Repositories\Dasbor\Master\TahunAjaranRepository;

class JadwalUjianController extends Controller
{
    private $soalRepo;
    private $prodiRepo;
    private $GelombangRepo;
    private $jadwalUjianRepo;
    private $tahunAjaranRepo;
    private $calonMahasiswaRepo;

    public function __construct(
        SoalRepository $soalRepository,
        ProdiRepository $prodiRepository,
        GelombangRepository $gelombangRepository,
        JadwalUjianRepository $jadwalUjianRepository,
        TahunAjaranRepository $tahunAjaranRepository,
        CalonMahasiswaRepository $calonMahasiswaRepository
    ) {
        $this->soalRepo = $soalRepository;
        $this->prodiRepo = $prodiRepository;
        $this->gelombangRepo = $gelombangRepository;
        $this->jadwalUjianRepo = $jadwalUjianRepository;
        $this->tahunAjaranRepo = $tahunAjaranRepository;
        $this->calonMahasiswaRepo = $calonMahasiswaRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function data()
    {
        $jadwalUjian = $this
            ->jadwalUjianRepo
            ->getAllData();

        return DataTables::of($jadwalUjian)
            ->addColumn('action', function($jadwalUjian){
                if($jadwalUjian->status == 0){
                    return '<center><a href="/panitia/pmb/jadwal-ujian/kirim-jadwal-ujian/'.$jadwalUjian->id.'/'.$jadwalUjian->kode_soal.'/'.$jadwalUjian->kode_gelombang.'/'.$jadwalUjian->kode_jurusan.'/'.$jadwalUjian->status_pendaftaran.'" class="btn btn-xs btn-info"><i class="fa fa-envelope"></i></a> <a href="/prodi/pmb/soal/form-ubah/'.$jadwalUjian->id.'" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i></a> <a href="#hapus" onclick="destroy('.$jadwalUjian->id.')" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a></center>';
                }else{
                    return '<center><a href="/panitia/pmb/jadwal-ujian/kirim-jadwal-ujian/'.$jadwalUjian->id.'/'.$jadwalUjian->kode_soal.'/'.$jadwalUjian->kode_gelombang.'/'.$jadwalUjian->kode_jurusan.'" class="btn btn-xs btn-info" class="disabled"><i class="fa fa-envelope"></i></a> <a href="/prodi/pmb/soal/form-ubah/'.$jadwalUjian->id.'" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i></a> <a href="#hapus" onclick="destroy('.$jadwalUjian->id.')" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a></center>';
                }
            })
            ->editColumn('tanggal_mulai_ujian', function($jadwalUjian){
                return $jadwalUjian->tanggal_mulai_ujian->formatLocalized('%c');
            })
            ->editColumn('tanggal_selesai_ujian', function($jadwalUjian){
                return $jadwalUjian->tanggal_selesai_ujian->formatLocalized('%c');
            })
            ->editColumn('status', function($soal){
                if($soal->status == 1){
                    return '<center><span class="label label-success">Sudah terbroadcast</span></center>';
                }else{
                    return '<center><span class="label label-danger">Belum terbroadcast</span></center>';
                }
            })
            ->rawColumns(['action', 'tanggal_mulai_ujian', 'tanggal_selesai_ujian', 'status'])
            ->make(true);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('panitia.pmb.jadwal_ujian.jadwal_ujian');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tahunAjaran = $this
            ->tahunAjaranRepo
            ->getAllData();

        $gelombang = $this
            ->gelombangRepo
            ->getAllData();

        $prodi = $this
            ->prodiRepo
            ->getAllData();

        $soal = $this
            ->soalRepo
            ->getAllDataByJadwalUjian();

        return view('panitia.pmb.jadwal_ujian.form_tambah', compact(
            'tahunAjaran',
            'gelombang',
            'prodi',
            'soal'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(JadwalUjianRequest $jadwalUjianReq)
    {
        $kodeJurusan = $jadwalUjianReq->kode_jurusan;
        $kodeSoal = $jadwalUjianReq->kode_soal;
        $kodeGelombang = $jadwalUjianReq->kode_gelombang;
        $statusPendaftaran = $jadwalUjianReq->status_pendaftaran;
        $tahun = $jadwalUjianReq->tahun;
        $tanggalMulaiUjian = Carbon::parse($jadwalUjianReq->tanggal_mulai_ujian);
        $tanggalSelesaiUjian = Carbon::parse($jadwalUjianReq->tanggal_selesai_ujian);
        $kode = $jadwalUjianReq->kode;

        $data = [
            'kode' => $kode,
            'kode_soal' => $kodeSoal,
            'kode_gelombang' => $kodeGelombang,
            'kode_jurusan' => $kodeJurusan,
            'status_pendaftaran' => $statusPendaftaran,
            'tahun' => $tahun,
            'tanggal_mulai_ujian' => $tanggalMulaiUjian,
            'tanggal_selesai_ujian' => $tanggalSelesaiUjian,
            'status' => 0
        ];

        $store = $this
            ->jadwalUjianRepo
            ->storeJadwalUjianData($data);

        return redirect('/panitia/pmb/jadwal-ujian')
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
        $destroy = $this
            ->jadwalUjianRepo
            ->destroyJadwalUjianData($id);

        return response()
            ->json([
                'destroyed' => TRUE
            ]);
    }

    public function sendEmail(
        $id, 
        $kodeSoal, 
        $kodeGelombang, 
        $kodeJurusan,
        $statusPendaftaran
    ) {
        $calonMahasiswa = $this
            ->calonMahasiswaRepo
            ->getAllDataByJadwalUjian($kodeJurusan, $kodeGelombang, $statusPendaftaran);

        $jadwalUjian = $this
            ->jadwalUjianRepo
            ->getSingleData($id);

        $soal = $this
            ->soalRepo
            ->getSingleDataByJadwalUjian($kodeSoal)
            ->first();

        $kodeSoal = $jadwalUjian->kode;
        $token = $soal->token;
        $tanggalMulaiUjian = $jadwalUjian->tanggal_mulai_ujian->formatLocalized('%c');
        $tanggalSelesaiUjian = $jadwalUjian->tanggal_selesai_ujian->formatLocalized('%c');

        $data = [
            'status' => 1
        ];

        $update = $this
            ->jadwalUjianRepo
            ->updateJadwalUjianData($data, $id);

        foreach ($calonMahasiswa as $item) {
            $password = str_random(7);

            $dataCalonMahasiswa = [
                'password' => bcrypt($password)
            ];

            $update = $this
                ->calonMahasiswaRepo
                ->updateCalonMahasiswaData($dataCalonMahasiswa, $item->id);

            $sendEmail = Mail::to($item->email)->send(new JadwalUjian(
                $item->nama,
                $item->kode,
                $password,
                $kodeSoal,
                $token,
                $tanggalMulaiUjian,
                $tanggalSelesaiUjian
            ));
        }

        return redirect('/panitia/pmb/jadwal-ujian')
            ->with([
                'notification' => 'Email berhasil dibroadcast'
            ]);
    }
}
