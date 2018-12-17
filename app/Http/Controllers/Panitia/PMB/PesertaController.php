<?php

namespace App\Http\Controllers\Panitia\PMB;

use PDF;
use Mail;
use Crypt;
use QrCode;
use DataTables;
use Carbon\Carbon;
use App\Models\PMB\Sesi;
use App\Mail\PMB\JadwalUjian;
use App\Http\Controllers\Controller;
use App\Repositories\PMB\SesiRepository;
use App\Repositories\PMB\BiayaRepository;
use App\Repositories\PMB\PotonganRepository;
use App\Repositories\PMB\GelombangRepository;
use App\Http\Requests\PMB\PendaftaranRequest;
use App\Repositories\PMB\JadwalUjianRepository;
use App\Repositories\PMB\CalonMahasiswaRepository;
use App\Services\CalonMahasiswaKelengkapanService;
use App\Repositories\PMB\CalonMahasiswaKelengkapanRepository;

class PesertaController extends Controller
{
    private $sesiRepo;
    private $jadwalUjianRepo;
    private $biayaRepo;
    private $formulirRepo;
    private $potonganRepo;
    private $gelombangRepo;
    private $calonMahasiswaRepo;
    private $calonMahasiswaKelengkapanRepo;
    private $calonMahasiswaKelengkapanServe;

    public function __construct(
        SesiRepository $sesiRepository,
        BiayaRepository $biayaRepository,
        PotonganRepository $potonganRepository,
        GelombangRepository $gelombangRepository,
        JadwalUjianRepository $jadwalUjianRepository,
        CalonMahasiswaRepository $calonMahasiswaRepository,
        CalonMahasiswaKelengkapanService $calonMahasiswaKelengkapanService,
        CalonMahasiswaKelengkapanRepository $calonMahasiswaKelengkapanRepository
    ) {
        $this->sesiRepo = $sesiRepository;
        $this->biayaRepo = $biayaRepository;
        $this->potonganRepo = $potonganRepository;
        $this->gelombangRepo = $gelombangRepository;
        $this->jadwalUjianRepo = $jadwalUjianRepository;
        $this->calonMahasiswaRepo = $calonMahasiswaRepository;
        $this->calonMahasiswaKelengkapanServe = $calonMahasiswaKelengkapanService;
        $this->calonMahasiswaKelengkapanRepo = $calonMahasiswaKelengkapanRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function data($kodeJadwalUjian)
    {
        $sesi = $this
            ->sesiRepo
            ->getAllDataByJadwalUjian($kodeJadwalUjian);

        return DataTables::of($sesi)
            ->addColumn('action', function($sesi) use($kodeJadwalUjian) {
                return '<center><a href="/panitia/pmb/peserta-ujian/'.$kodeJadwalUjian.'/kirim-email/'.$sesi->kode_pendaftaran.'" class="btn btn-xs btn-info"><i class="fa fa-envelope"></i></a></center>';
            })
            ->editColumn('status', function($soal){
                if($soal->status == 1){
                    return '<center><span class="label label-success">Email sudah terkirim</span></center>';
                }else{
                    return '<center><span class="label label-danger">Email belum terkirim</span></center>';
                }
            })
            ->rawColumns(['action', 'status'])
            ->make(true);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($kodeJadwalUjian)
    {
        return view('panitia.pmb.peserta.peserta', compact(
            'kodeJadwalUjian'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($kodeJadwalUjian)
    {
        $peserta = $this
            ->jadwalUjianRepo
            ->getSingleDataForPeserta($kodeJadwalUjian)
            ->first();

        $sesi = $this
            ->sesiRepo
            ->getAllDataForSesi($kodeJadwalUjian);

        $totalSesi      = $peserta->jumlah_calon_mahasiswa;
        $totalPeserta   = $sesi->count();
        $total          = $totalSesi - $totalPeserta;
        $nomorPeserta   = 1;

        $potongan = $this
            ->potonganRepo
            ->getAllData();

        $biaya = $this
            ->biayaRepo
            ->getAllData();

        $gelombang = $this
            ->gelombangRepo
            ->getAllData();

        return view('panitia.pmb.peserta.form_tambah', compact(
            'gelombang',
            'potongan',
            'biaya',
            'total',
            'nomorPeserta',
            'kodeJadwalUjian',
            'peserta'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($kodeJadwalUjian, PendaftaranRequest $pendaftaranReq)
    {
        $peserta = $this
            ->jadwalUjianRepo
            ->getSingleDataForPeserta($kodeJadwalUjian)
            ->first();

        $a= 1;
        $total = $pendaftaranReq->total;

        for ($i=0; $i<$total; $i++) {
            if($peserta->kode_jurusan == "IF"){
                $calonMahasiswa = $this
                    ->calonMahasiswaRepo
                    ->getAllDataByIF();

                $jumlah = $calonMahasiswa+$a++;
                $tahun = date('Y');
                $kodePendaftaran = "PMBIF".$tahun.'0'.$jumlah;
            }else if($peserta->kode_jurusan == "SI"){
                $calonMahasiswa = $this
                    ->calonMahasiswaRepo
                    ->getAllDataBySI();

                $jumlah = $calonMahasiswa+$a++;
                $tahun = date('Y');
                $kodePendaftaran = "PMBSI".$tahun.'0'.$jumlah;
            }

            $kodeJurusan = $peserta->kode_jurusan;
            $kodeKelas = $pendaftaranReq->kode_kelas[$i];
            $kodeGelombang = $peserta->kode_gelombang;
            $kodePotongan = $pendaftaranReq->kode_potongan[$i];
            $statusPendaftaran = $pendaftaranReq->status_pendaftaran[$i];

            $status = $pendaftaranReq->status[$i];
            $asalSekolah = $pendaftaranReq->asal_sekolah[$i];
            $asalJurusan = $pendaftaranReq->asal_jurusan[$i];

            $status = $pendaftaranReq->status[$i];
            $nama   = $pendaftaranReq->nama[$i];
            $jenisKelamin = $pendaftaranReq->jenis_kelamin[$i];
            $alamat = $pendaftaranReq->alamat[$i];
            $pekerjaan = $pendaftaranReq->pekerjaan[$i];
            $kotaLahir = $pendaftaranReq->kota_lahir[$i];
            $tanggalLahir = $pendaftaranReq->tanggal_lahir[$i];
            $bulanLahir = $pendaftaranReq->bulan_lahir[$i];
            $tahunLahir = $pendaftaranReq->tahun_lahir[$i];
            $nomorTeleponRumah = $pendaftaranReq->nomor_telepon_rumah[$i];
            $nomorTelepon = $pendaftaranReq->nomor_telepon[$i];
            $email = $pendaftaranReq->email[$i];
            $website = $pendaftaranReq->website[$i];
            $mengenalSTMIK = $pendaftaranReq->mengenal_stmik[$i];
            $foto4x6 = $pendaftaranReq->foto_4x6;

            if(!empty($foto4x6[$i])){
                $dataCalonMahasiswa[] = [
                    'kode' => $kodePendaftaran,
                    'kode_jurusan' => $kodeJurusan,
                    'kode_kelas' => $kodeKelas,
                    'kode_gelombang' => $kodeGelombang,
                    'kode_potongan' => $kodePotongan,
                    'status_pendaftaran' => $statusPendaftaran,
                    'password' => NULL,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ];

                $dataCalonMahasiswaStatus[] = [
                    'kode_pendaftaran' => $kodePendaftaran,
                    'status' => $status,
                    'asal_sekolah' => $asalSekolah,
                    'asal_jurusan' => $asalJurusan,
                    'jurusan_pilihan' => $kodeJurusan,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ];

                $dataCalonMahasiswaBiodata[] = [
                    'kode_pendaftaran' => $kodePendaftaran,
                    'nama' => $nama,
                    'jenis_kelamin' => $jenisKelamin,
                    'alamat' => $alamat,
                    'kota_lahir' => $kotaLahir,
                    'tanggal' => $tanggalLahir,
                    'bulan' => $bulanLahir,
                    'tahun' => $tahunLahir,
                    'pekerjaan' => $pekerjaan,
                    'nomor_telepon_rumah' => $nomorTeleponRumah,
                    'nomor_telepon' => $nomorTelepon,
                    'email' => $email,
                    'website' => $website,
                    'mengenal_stmik' => $mengenalSTMIK,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ];

                $tempNamaFoto4x6 = $foto4x6[$i]->getClientOriginalName();

                $namaFileFoto4x6 = 'Foto 4x6 '.$kodePendaftaran.' '.$tempNamaFoto4x6;

                $dataCalonMahasiswaKelengkapan[] = [
                    'kode_pendaftaran' => $kodePendaftaran,
                    'fotocopy_raport_kelas_xii' => NULL,
                    'fotocopy_ijazah_sma' => NULL,
                    'foto_3x4' => NULL,
                    'foto_4x6' => $namaFileFoto4x6,
                    'surat_keterangan_pindah' => NULL,
                    'fotocopy_transkrip_nilai' => NULL,
                    'fotocopy_ijazah_perguruan_tinggi_asal' => NULL,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ];

                $dataSesi[] = [
                    'kode_jadwal_ujian' => $kodeJadwalUjian,
                    'kode_pendaftaran' => $kodePendaftaran,
                    'status' => 0,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ];

                $upload = $this
                    ->calonMahasiswaKelengkapanServe
                    ->handleUploadGambar($foto4x6[$i], $namaFileFoto4x6);
            }else{
                $dataCalonMahasiswa[] = [
                    'kode' => $kodePendaftaran,
                    'kode_jurusan' => $kodeJurusan,
                    'kode_kelas' => $kodeKelas,
                    'kode_gelombang' => $kodeGelombang,
                    'kode_potongan' => $kodePotongan,
                    'status_pendaftaran' => $statusPendaftaran,
                    'password' => NULL,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ];

                $dataCalonMahasiswaStatus[] = [
                    'kode_pendaftaran' => $kodePendaftaran,
                    'status' => $status,
                    'asal_sekolah' => $asalSekolah,
                    'asal_jurusan' => $asalJurusan,
                    'jurusan_pilihan' => $kodeJurusan,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ];

                $dataCalonMahasiswaBiodata[] = [
                    'kode_pendaftaran' => $kodePendaftaran,
                    'nama' => $nama,
                    'jenis_kelamin' => $jenisKelamin,
                    'alamat' => $alamat,
                    'kota_lahir' => $kotaLahir,
                    'tanggal' => $tanggalLahir,
                    'bulan' => $bulanLahir,
                    'tahun' => $tahunLahir,
                    'pekerjaan' => $pekerjaan,
                    'nomor_telepon_rumah' => $nomorTeleponRumah,
                    'nomor_telepon' => $nomorTelepon,
                    'email' => $email,
                    'website' => $website,
                    'mengenal_stmik' => $mengenalSTMIK,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ];

                $dataCalonMahasiswaKelengkapan[] = [
                    'kode_pendaftaran' => $kodePendaftaran,
                    'fotocopy_raport_kelas_xii' => NULL,
                    'fotocopy_ijazah_sma' => NULL,
                    'foto_3x4' => NULL,
                    'foto_4x6' => NULL,
                    'surat_keterangan_pindah' => NULL,
                    'fotocopy_transkrip_nilai' => NULL,
                    'fotocopy_ijazah_perguruan_tinggi_asal' => NULL,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ];

                $dataSesi[] = [
                    'kode_jadwal_ujian' => $kodeJadwalUjian,
                    'kode_pendaftaran' => $kodePendaftaran,
                    'status' => 0,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ];
            }
        }

        $storeCalonMahasiswa = $this
            ->calonMahasiswaRepo
            ->storeCalonMahasiswaDataForJadwalUjian(
                $dataCalonMahasiswa,
                $dataCalonMahasiswaStatus,
                $dataCalonMahasiswaBiodata,
                $dataCalonMahasiswaKelengkapan
            );

        $storeSesi = $this
            ->sesiRepo
            ->storeSesiData($dataSesi);

        return redirect('/panitia/pmb/peserta-ujian/'.$kodeJadwalUjian);
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

    public function sendEmail($kodeJadwalUjian, $kodePendaftaran)
    {
        $sesi = $this
            ->sesiRepo
            ->getSingleDataForEmail($kodePendaftaran);

        $id = $sesi->id;
        $kodePendaftaran = $sesi->kode_pendaftaran;
        $kodeSoal = $sesi->kode_soal;
        $password = str_random(7);
        $nama = $sesi->nama;
        $email = $sesi->email;
        $kotaLahir = $sesi->kota_lahir;
        $tanggalBulan = $sesi->bulan;
        $tahun = $sesi->tahun;
        $tanggal = $sesi->tanggal;
        $foto4x6 = $sesi->foto_4x6;
        $tanggalMulaiUjian = $sesi->tanggal_mulai_ujian->formatLocalized('%c');
        $tanggalSelesaiUjian = $sesi->tanggal_selesai_ujian->formatLocalized('%c');
        $durasi = $sesi->tanggal_mulai_ujian->diffInMinutes($sesi->tanggal_selesai_ujian);
        $tahunAjaran = date('Y');
        $ruangan = $sesi->ruangan;
        $encryptKodePendafaran = Crypt::encrypt($kodePendaftaran);

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
            $bulan = "Desember";
        }

        $pdfKartuUjian = PDF::LoadView('panitia.pmb.jadwal_ujian.kartu_ujian', compact(
            'kodePendaftaran',
            'nama',
            'tahun',
            'kotaLahir',
            'bulan',
            'tahun',
            'tanggal',
            'tahunAjaran',
            'foto4x6',
            'tanggalMulaiUjian',
            'tanggalSelesaiUjian',
            'ruangan',
            'encryptKodePendafaran'
        ));

        $fileKartuUjian = $pdfKartuUjian->save(public_path("/files/Kartu Ujian | ".$nama."-".$kodePendaftaran.".pdf"));

        $realFileKartuUjian = public_path("/files/Kartu Ujian | ".$nama."-".$kodePendaftaran.".pdf");

        $fileNameKartuUjian = "Kartu Ujian | ".$nama."-".$kodePendaftaran.".pdf";

        $sendEmail = Mail::to($email)->send(new JadwalUjian(
            $nama,
            $kodePendaftaran,
            $password,
            $tanggalMulaiUjian,
            $tanggalSelesaiUjian,
            $realFileKartuUjian,
            $fileNameKartuUjian,
            $durasi,
            $kodeJadwalUjian
        ));

        $dataSesi = [
            'status' => 1
        ];

        $dataCalonMahasiswa = [
                'password' => bcrypt($password)
            ];

        $update = $this
            ->calonMahasiswaRepo
            ->updateCalonMahasiswaDataBySendEmailJadwal($dataCalonMahasiswa, $kodePendaftaran);

        $updateSesi = $this
            ->sesiRepo
            ->updateSesiData($dataSesi, $id);

        return redirect('/panitia/pmb/peserta-ujian/'.$kodeJadwalUjian);
    }

    public function broadcastEmail($kodeJadwalUjian)
    {
        $sesi = $this
            ->sesiRepo
            ->getAllDataForEmailBroadcast($kodeJadwalUjian);

        $tahunAjaran = date('Y');

        foreach ($sesi as $item) {
            $password = str_random(7);

            $dataCalonMahasiswa = [
                'password' => bcrypt($password)
            ];

            $update = $this
                ->calonMahasiswaRepo
                ->updateCalonMahasiswaData($dataCalonMahasiswa, $item->calon_mahasiswa_id);

            $id = $item->id;
            $kodePendaftaran = $item->kode_pendaftaran;
            $nama = $item->nama;
            $kotaLahir = $item->kota_lahir;
            $tanggalBulan = $item->bulan;
            $tahun = $item->tahun;
            $tanggal = $item->tanggal;
            $foto4x6 = $item->foto_4x6;
            $tanggalMulaiUjian = $item->tanggal_mulai_ujian->formatLocalized('%c');
            $tanggalSelesaiUjian = $item->tanggal_selesai_ujian->formatLocalized('%c');
            $durasi = $item->tanggal_mulai_ujian->diffInMinutes($item->tanggal_selesai_ujian);
            $encryptKodePendafaran = Crypt::encrypt($kodePendaftaran);

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
                $bulan = "Desember";
            }

            $pdfKartuUjian = PDF::LoadView('panitia.pmb.jadwal_ujian.kartu_ujian', compact(
                'kodePendaftaran',
                'nama',
                'tahun',
                'kotaLahir',
                'bulan',
                'tahun',
                'tanggal',
                'tahunAjaran',
                'foto4x6',
                'encryptKodePendafaran'
            ));

            $fileKartuUjian = $pdfKartuUjian->save(public_path("/files/Kartu Ujian | ".$item->nama."-".$item->kode_pendaftaran.".pdf"));

            $realFileKartuUjian = public_path("/files/Kartu Ujian | ".$item->nama."-".$item->kode_pendaftaran.".pdf");

            $fileNameKartuUjian = "Kartu Ujian | ".$item->nama."-".$item->kode_pendaftaran.".pdf";

            $sendEmail = Mail::to($item->email)->send(new JadwalUjian(
                $item->nama,
                $item->kode_pendaftaran,
                $password,
                $tanggalMulaiUjian,
                $tanggalSelesaiUjian,
                $realFileKartuUjian,
                $fileNameKartuUjian,
                $durasi,
                $kodeJadwalUjian
            ));

            $dataSesi = [
                'status' => 1
            ];

            $updateSesi = $this
                ->sesiRepo
                ->updateSesiData($dataSesi, $id);
        }

        return redirect('/panitia/pmb/peserta-ujian/'.$kodeJadwalUjian);
    }
}
