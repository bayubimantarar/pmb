<?php

namespace App\Http\Controllers\PMB;

use Mail;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Mail\PMB\KeteranganLulus;
use App\Http\Controllers\Controller;
use App\Http\Requests\PMB\UjianRequest;
use App\Repositories\PMB\HasilRepository;
use App\Repositories\PMB\NilaiLulusRepository;
use App\Repositories\Prodi\PMB\SoalRepository;
use App\Repositories\Prodi\PMB\TokenRepository;
use App\Repositories\PMB\JadwalUjianRepository;
use App\Repositories\Prodi\PMB\JawabanRepository;
use App\Repositories\Prodi\PMB\PertanyaanRepository;
use App\Repositories\PMB\CalonMahasiswaRepository;

class SoalController extends Controller
{
    private $soalRepo;
    private $tokenRepo;
    private $hasilRepo;
    private $jawabanRepo;
    private $nilaiLulusRepo;
    private $pertanyaanRepo;
    private $jadwalUjianRepo;
    private $pertanyaanServe;
    private $calonMahasiswaRepo;

    public function __construct(
        TokenRepository $tokenRepo,
        SoalRepository $soalRepository,
        HasilRepository $hasilRepository,
        PertanyaanRepository $pertanyaanRepo,
        JawabanRepository $jawabanRepository,
        NilaiLulusRepository $nilaiLulusRepository,
        JadwalUjianRepository $jadwalUjianRepository,
        CalonMahasiswaRepository $calonMahasiswaRepository
    ) {
        $this->tokenRepo        = $tokenRepo;
        $this->soalRepo         = $soalRepository;
        $this->pertanyaanRepo   = $pertanyaanRepo;
        $this->hasilRepo        = $hasilRepository;
        $this->jawabanRepo      = $jawabanRepository;
        $this->nilaiLulusRepo   = $nilaiLulusRepository;
        $this->jadwalUjianRepo  = $jadwalUjianRepository;
        $this->calonMahasiswaRepo   = $calonMahasiswaRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pmb.ujian.cari_soal');
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
    public function store(UjianRequest $ujianReq)
    {
        $totalPertanyaan = $ujianReq->total_pertanyaan;

        for($i=0; $i<$totalPertanyaan; $i++){
            $kodeJadwalUjian = $ujianReq->kode_jadwal_ujian;
            $kodePendaftaran = $ujianReq->kode_pendaftaran;
            $kodesoal = $ujianReq->kode_soal;

            $jenispertanyaan    = $ujianReq->jenis_pertanyaan[$i];
            $nomorpertanyaan    = $ujianReq->nomor_pertanyaan[$i];
            $jawabanpilihan     = $ujianReq->jawaban_pilihan;
            $jawabanBenarSalah  = $ujianReq->jawaban_benar_salah;
            $createdAt          = Carbon::now();
                    
            if($jenispertanyaan == 'benar-salah' || $jenispertanyaan == 'Benar-Salah'){
                if(!empty($jawabanBenarSalah[$i])){
                    $data[] = [
                        'kode_jadwal_ujian' => $kodeJadwalUjian,
                        'kode_pendaftaran' => $kodePendaftaran,
                        'kode_soal' => $kodesoal,
                        'nomor_pertanyaan' => $nomorpertanyaan,
                        'jenis_pertanyaan' => $jenispertanyaan,
                        'jawaban_pilihan' => NULL,
                        'jawaban_benar_salah' => $jawabanBenarSalah[$i],
                        'created_at' => $createdAt,
                        'updated_at' => $createdAt
                    ];
                }else{
                    $data[] = [
                        'kode_jadwal_ujian' => $kodeJadwalUjian,
                        'kode_pendaftaran' => $kodePendaftaran,
                        'kode_soal' => $kodesoal,
                        'nomor_pertanyaan' => $nomorpertanyaan,
                        'jenis_pertanyaan' => $jenispertanyaan,
                        'jawaban_pilihan' => NULL,
                        'jawaban_benar_salah' => NULL,
                        'created_at' => $createdAt,
                        'updated_at' => $createdAt
                    ];
                }
            }else{
                if(!empty($jawabanpilihan[$i])){
                    $data[] = [
                        'kode_jadwal_ujian' => $kodeJadwalUjian,
                        'kode_pendaftaran' => $kodePendaftaran,
                        'kode_soal' => $kodesoal,
                        'nomor_pertanyaan' => $nomorpertanyaan,
                        'jenis_pertanyaan' => $jenispertanyaan,
                        'jawaban_pilihan' => $jawabanpilihan[$i],
                        'jawaban_benar_salah' => NULL,
                        'created_at' => $createdAt,
                        'updated_at' => $createdAt
                    ];
                }else{
                    $data[] = [
                        'kode_jadwal_ujian' => $kodeJadwalUjian,
                        'kode_pendaftaran' => $kodePendaftaran,
                        'kode_soal' => $kodesoal,
                        'nomor_pertanyaan' => $nomorpertanyaan,
                        'jenis_pertanyaan' => $jenispertanyaan,
                        'jawaban_essay' => NULL,
                        'jawaban_pilihan' => NULL,
                        'created_at' => $createdAt,
                        'updated_at' => $createdAt
                    ];
                }
            }
        }

        $pertanyaan = $this
            ->pertanyaanRepo
            ->getAllDataBySoal($kodesoal)
            ->toArray();

        $i=0;
        for ($i=0; $i<$totalPertanyaan; $i++) {
            if($data[$i]['jenis_pertanyaan'] == "Benar-Salah" || $data[$i]['jenis_pertanyaan'] == "benar-salah"){
                if($data[$i]['jawaban_benar_salah'] != $pertanyaan[$i]['jawaban_benar_salah']){
                    $nilai[] = [
                        'nilai' => 0
                    ];
                }else{
                    $nilai[] = [
                        'nilai' => 10
                    ];
                }
            }else{
                if($data[$i]['jawaban_pilihan'] != $pertanyaan[$i]['jawaban_pilihan']){
                    $nilai[] = [
                        'nilai' => 0,
                    ];
                }else{
                    $nilai[] = [
                        'nilai' => 10
                    ];
                }
            }
        }
        $totalbobot = array_sum(array_column($nilai, 'nilai'));

        $totalNilai = ($totalbobot/$totalPertanyaan)*10;

        $nilaiLulus = $this
            ->nilaiLulusRepo
            ->getAllData()
            ->first();

        $nilaiAngka = $nilaiLulus->nilai;
        $kodeGelombang = Auth::guard('calon_mahasiswa')->User()->kode_gelombang;
        $kodeJurusan = Auth::guard('calon_mahasiswa')->User()->kode_jurusan;
        $kodeKelas = Auth::guard('calon_mahasiswa')->User()->kode_kelas;

        $dataHasil = [
            'kode_jadwal_ujian' => $kodeJadwalUjian,
            'kode_pendaftaran' => $kodePendaftaran,
            'kode_gelombang' => $kodeGelombang,
            'kode_jurusan' => $kodeJurusan,
            'kode_soal' => $kodesoal,
            'kode_kelas' => $kodeKelas,
            'nilai_angka' => $totalNilai
        ];

        $calonMahasiswa = $this
            ->calonMahasiswaRepo
            ->getSingleDataByEmail($kodePendaftaran)
            ->first();

        $nama = $calonMahasiswa->nama;
        $email = $calonMahasiswa->email;
        $kotaLahir = $calonMahasiswa->kota_lahir;
        $tanggal = $calonMahasiswa->tanggal;
        $tanggalBulan = $calonMahasiswa->bulan;

        if($tanggalBulan == '1'){
            $bulan = "Januari";
        }else if($tanggalBulan == '2'){
            $bulan = "Februari";
        }else if($tanggalBulan == '3'){
            $bulan = "Maret";
        }else if($tanggalBulan == '4'){
            $bulan = "April";
        }else if($tanggalBulan == '5'){
            $bulan = "Mei";
        }else if($tanggalBulan == '6'){
            $bulan = "Juni";
        }else if($tanggalBulan == '7'){
            $bulan = "Juli";
        }else if($tanggalBulan == '8'){
            $bulan = "Agustus";
        }else if($tanggalBulan == '9'){
            $bulan = "September";
        }else if($tanggalBulan == '10'){
            $bulan = "Oktober";
        }else if($tanggalBulan == '11'){
            $bulan = "November";
        }else if($tanggalBulan == '12'){
            $bulan = "Dsember";
        }

        $tahun = $calonMahasiswa->tahun;
        $sekolahAsal = $calonMahasiswa->asal_sekolah;
        if($calonMahasiswa->kode_jurusan == "IF"){
            $jurusanPilihan = "Teknik Informatika";
        }else{
            $jurusanPilihan = "Sistem Informasi";
        }

        if($totalNilai >= $nilaiAngka){
            $keteranganLulus = "Lulus";
            $sendEmail = Mail::to($email)->send(new KeteranganLulus(
                $nama,
                $kodePendaftaran,
                $keteranganLulus,
                $kotaLahir,
                $tanggal,
                $bulan,
                $tahun,
                $sekolahAsal,
                $jurusanPilihan
            ));
        }else{
            $keteranganLulus = "Tidak Lulus";
            $sendEmail = Mail::to($email)->send(new KeteranganLulus(
                $nama,
                $kodePendaftaran,
                $keteranganLulus,
                $kotaLahir,
                $tanggal,
                $bulan,
                $tahun,
                $sekolahAsal,
                $jurusanPilihan
            ));
        }

        $store = $this
            ->jawabanRepo
            ->storeJawabanData($data);
        
        $storeHasil = $this
            ->hasilRepo
            ->storeHasilData($dataHasil);

        return redirect('/pmb');
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

    public function find()
    {
        $kodeSoal = \Request::get('kode_soal');
        $kodePendaftaran = Auth::guard('calon_mahasiswa')->User()->kode_pendaftaran;

        $jadwalUjian = $this
            ->jadwalUjianRepo
            ->getSingleDataByExam($kodeSoal)
            ->first();

        $checkCalonMahasiswaHasExam = $this
            ->jawabanRepo
            ->checkMahasiswaHasExam($kodePendaftaran, $kodeSoal);

        $kodeSoal = $jadwalUjian->kode;
        $tanggalSekarang = Carbon::now();
        $tanggalMulaiUjian = $jadwalUjian->tanggal_mulai_ujian;
        $tanggalSelesaiUjian = $jadwalUjian->tanggal_selesai_ujian;

        if(
            $tanggalSekarang >= $tanggalMulaiUjian && 
            $tanggalSekarang <= $tanggalSelesaiUjian
        ) {
            $hasExam    = 1;
            $examDate   = 1;
                
            return view('pmb.ujian.soal', compact(
                'hasExam',
                'examDate',
                'kodeSoal',
                'token'
            ));
        }else{
            $hasExam    = 0;
            $examDate   = 0;

            return view('pmb.ujian.soal', compact(
                'hasExam',
                'examDate',
                'kodeSoal',
                'token'
            ));
        }
    }

    public function checkToken($token)
    {
        $checkSoal = $this
            ->tokenRepo
            ->getSingleDataForSoal($token);

        if(!empty($checkSoal)){
            $status     = $checkSoal->status;
            $kodesoal   = $checkSoal->kode_soal;
            $token      = $checkSoal->token;
            if($status == 1){
                return response()->json([
                    'active' => true,
                    'data' => [
                        'kode_soal' => $kodesoal,
                        'token'     => $token
                    ]
                ], 200);
            }else{
                return response()->json([
                    'active' => false
                ], 200);
            }
        }else{
            return response()->json([
                'active' => false
            ], 200);
        }
    }

    public function startExam($kodeSoal, $token)
    {
        $dataSoal = $this
            ->tokenRepo
            ->getSingleDataForSoal($token);

        $jadwalUjian = $this
            ->jadwalUjianRepo
            ->getSingleDataByExam($kodeSoal)
            ->first();

        $kodeSoal   = $dataSoal->kode_soal;

        $dataPertanyaan = $this
            ->pertanyaanRepo
            ->getAllDataBySoal($kodeSoal);

        $detailSoal = $this
            ->pertanyaanRepo
            ->getAllDataBySoal($kodeSoal)
            ->first();

        $kodeJadwalUjian        = $jadwalUjian->kode;
        $kodesoal               = $detailSoal->kode_soal; 
        $jenispertanyaan        = $detailSoal->jenis_pertanyaan;
        $nip                    = $detailSoal->nip;
        $kelas                  = $detailSoal->nama_kelas;
        $matakuliah             = $detailSoal->nama_mata_kuliah;
        $dosen                  = $detailSoal->nama_dosen;
        $jenisujian             = $detailSoal->nama_jenis_ujian;
        $tanggalujian           = $jadwalUjian->tanggal_mulai_ujian->formatLocalized('%A'.', '.'%d %B %Y');
        $tanggalselesaiujian    = $jadwalUjian->tanggal_selesai_ujian;
        $durasi                 = $detailSoal->durasi_ujian;

        $tanggal_sekarang = Carbon::now();

        $totalPertanyaan = $dataPertanyaan->count();

        $kodePendaftaran = Auth::Guard('calon_mahasiswa')->User()->kode;

        $checkMahasiswaHasExam = $this
            ->jawabanRepo
            ->checkMahasiswaHasExam($kodePendaftaran, $kodeSoal);

        if(!empty($checkMahasiswaHasExam)){
            abort(404);
        }else{
            if($dataSoal->status == 0){
                abort(404);
            }else{
                $nomorsoal = 1;
                $i = 0;
                $hasExam = true;

                return view('pmb.ujian.form_soal', compact(
                    'dataPertanyaan',
                    'totalPertanyaan', 
                    'jenispertanyaan',
                    'i', 
                    'hasExam',
                    'nomorsoal',
                    'nip',
                    'jenisujian',
                    'tanggalselesaiujian',
                    'durasiujian',
                    'tanggalujian',
                    'durasi',
                    'kodesoal',
                    'tahun',
                    'kodeJadwalUjian'
                ));
            }
        }
    }
}
