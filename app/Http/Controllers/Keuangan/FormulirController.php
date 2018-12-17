<?php

namespace App\Http\Controllers\Keuangan;

use PDF;
use Zipper;
use DataTables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PMB\BiayaRepository;
use App\Repositories\PMB\PotonganRepository;
use App\Repositories\PMB\FormulirRepository;
use App\Repositories\PMB\GelombangRepository;
use App\Http\Requests\PMB\PendaftaranRequest;
use App\Repositories\PMB\CalonMahasiswaRepository;
use App\Services\CalonMahasiswaKelengkapanService;
use App\Repositories\PMB\CalonMahasiswaKelengkapanRepository;

class FormulirController extends Controller
{
    private $biayaRepo;
    private $formulirRepo;
    private $potonganRepo;
    private $gelombangRepo;
    private $calonMahasiswaRepo;
    private $calonMahasiswaKelengkapanRepo;
    private $calonMahasiswaKelengkapanServe;

    public function __construct(
        BiayaRepository $biayaRepository,
        PotonganRepository $potonganRepository,
        FormulirRepository $formulirRepository,
        GelombangRepository $gelombangRepository,
        CalonMahasiswaRepository $calonMahasiswaRepository,
        CalonMahasiswaKelengkapanService $calonMahasiswaKelengkapanService,
        CalonMahasiswaKelengkapanRepository $calonMahasiswaKelengkapanRepository
    ) {
        $this->biayaRepo = $biayaRepository;
        $this->formulirRepo = $formulirRepository;
        $this->gelombangRepo = $gelombangRepository;
        $this->potonganRepo = $potonganRepository;
        $this->calonMahasiswaRepo = $calonMahasiswaRepository;
        $this->calonMahasiswaKelengkapanServe = $calonMahasiswaKelengkapanService;
        $this->calonMahasiswaKelengkapanRepo = $calonMahasiswaKelengkapanRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function data()
    {
        $formulir = $this
            ->formulirRepo
            ->getAllData();

        return DataTables::of($formulir)
            ->addColumn('action', function($formulir){
                return '<center><a href="/panitia/pmb/formulir/detail/'.$formulir->id.'" class="btn btn-info btn-xs"><i class="fa fa-info-circle" title="Lihat formulir"></i></a> <a href="/panitia/pmb/formulir/unduh-formulir/'.$formulir->id.'" class="btn btn-success btn-xs" title="Unduh formulir"><i class="fa fa-file-text-o"></i></a> <a href="/panitia/pmb/formulir/unduh-kelengkapan/'.$formulir->id.'" class="btn btn-primary btn-xs" title="Unduh formulir"><i class="fa fa-download"></i></a></center>';
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
        return view('keuangan.formulir.formulir');
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
            ->getAllData();

        $potongan = $this
            ->potonganRepo
            ->getAllData();

        $biaya = $this
            ->biayaRepo
            ->getAllData();

        return view('keuangan.formulir.form_tambah', compact(
            'gelombang', 'potongan', 'biaya'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PendaftaranRequest $pendaftaranReq)
    {
        $statusPendaftaran = $pendaftaranReq->status_pendaftaran;
        $status = $pendaftaranReq->status;
        $kodePotongan = $pendaftaranReq->kode_potongan;
        $asalSekolah = $pendaftaranReq->asal_sekolah;
        $asalJurusan = $pendaftaranReq->asal_jurusan;
        $jurusan = $pendaftaranReq->jurusan;
        $gelombang = $pendaftaranReq->kode_gelombang;
        $kodeKelas = $pendaftaranReq->kelas;

        if($jurusan == "IF"){
            $calonMahasiswa = $this
                ->calonMahasiswaRepo
                ->getAllDataByIF();

            $jumlah = $calonMahasiswa+1;
            $tahun = date('Y');
            $kodePendaftaran = "PMBIF".$tahun.'0'.$jumlah;
        }else if($jurusan == "SI"){
            $calonMahasiswa = $this
                ->calonMahasiswaRepo
                ->getAllDataBySI();

            $jumlah = $calonMahasiswa+1;
            $tahun = date('Y');
            $kodePendaftaran = "PMBSI".$tahun.'0'.$jumlah;
        }

        //calon mahasiswa biodata
        $nama = $pendaftaranReq->nama;
        $jenisKelamin = $pendaftaranReq->jenis_kelamin;
        $alamat = $pendaftaranReq->alamat;
        $rtrw = $pendaftaranReq->rt.'/'.$pendaftaranReq->rw;
        $kelurahan = $pendaftaranReq->kelurahan;
        $kecamatan = $pendaftaranReq->kecamatan;
        $kodePos = $pendaftaranReq->kode_pos;
        $kotaKabupaten = $pendaftaranReq->kota_kabupaten;
        $provinsi = $pendaftaranReq->provinsi;
        $pekerjaan = $pendaftaranReq->pekerjaan;
        $kotaLahir = $pendaftaranReq->kota_lahir;
        $tanggalLahir = $pendaftaranReq->tanggal_lahir;
        $bulanLahir = $pendaftaranReq->bulan_lahir;
        $tahunLahir = $pendaftaranReq->tahun_lahir;
        $nomorTeleponRumah = $pendaftaranReq->nomor_telepon_rumah;
        $nomorTelepon = $pendaftaranReq->nomor_telepon;
        $email = $pendaftaranReq->email;
        $website = $pendaftaranReq->website;
        $mengenalSTMIK = $pendaftaranReq->mengenal_stmik;

        //calon mahasiswa biodata orang tua wali
        $namaAyah = $pendaftaranReq->nama_ayah;
        $namaIbu = $pendaftaranReq->nama_ibu;
        $pekerjaanAyah = $pendaftaranReq->pekerjaan_ayah;
        $pekerjaanIbu = $pendaftaranReq->pekerjaan_ibu;
        $jurusanPilihan = $pendaftaranReq->jurusan_pilihan;
        $alamatOrangTua = $pendaftaranReq->alamat_orang_tua;
        $jurusanPilihan = $pendaftaranReq->jurusan_pilihan;
        $rtrwOrangTua = $pendaftaranReq->rt_orang_tua.'/'.$pendaftaranReq->rw_orang_tua;
        $kelurahanOrangTua = $pendaftaranReq->kelurahan_orang_tua;
        $kecamatanOrangTua = $pendaftaranReq->kecamatan_orang_tua;
        $kodePosOrangTua = $pendaftaranReq->kode_pos_orang_tua;
        $kotaKabupatenOrangTua = $pendaftaranReq->kode_kabupaten_orang_tua;
        $provinsiOrangTua = $pendaftaranReq->provinsi_orang_tua;
        $nomorTeleponRumahOrangTua = $pendaftaranReq->nomor_telepon_rumah_orang_tua;
        $nomorTeleponOrangTua = $pendaftaranReq->nomor_telepon_orang_tua;
        $emailOrangTua = $pendaftaranReq->email_orang_tua;
        $websiteOrangTua = $pendaftaranReq->website_orang_tua;

        //calon mahasiswa kelengkapan
        $fotoCopyRaportKelasXII = $pendaftaranReq->file('fotocopy_raport_kelas_xii');
        $fotoCopyIjazahSMA = $pendaftaranReq->file('fotocopy_ijazah_sma');
        $foto3x4 = $pendaftaranReq->file('foto_3x4');
        $foto4x6 = $pendaftaranReq->file('foto_4x6');
        $suratKeteranganPindah = $pendaftaranReq->file('surat_keterangan_pindah');
        $fotoCopyTranskripNilai = $pendaftaranReq->file('fotocopy_transkrip_nilai');
        $fotoCopyIjazahPerguruanTinggiAsal = $pendaftaranReq->file('fotocopy_ijazah_perguruan_tinggi_asal');

        if($fotoCopyRaportKelasXII != null){
            $tempNamaFileFotoCopyRaportKelasXII = $fotoCopyRaportKelasXII->getClientOriginalName();
            $namaFileFotocopyRaportKelasXII = 'Fotocopy Raport Kelas XII '.$kodePendaftaran.$tempNamaFileFotoCopyRaportKelasXII;
            $upload = $this
                ->calonMahasiswaKelengkapanServe
                ->handleUploadGambar($fotoCopyRaportKelasXII, $namaFileFotocopyRaportKelasXII);
        }else{
            $namaFileFotocopyRaportKelasXII = NULL;
        }

        if($fotoCopyIjazahSMA != null){
            $tempNamaFotoCopyIjazahSMA = $fotoCopyIjazahSMA->getClientOriginalName();
            $namaFileFotoCopyIjazahSMA = 'Fotocopy Ijazah '.$kodePendaftaran.$tempNamaFotoCopyIjazahSMA;
            $upload = $this
                ->calonMahasiswaKelengkapanServe
                ->handleUploadGambar($fotoCopyIjazahSMA, $namaFileFotoCopyIjazahSMA);
        }else{
            $namaFileFotoCopyIjazahSMA = NULL;
        }

        if($foto3x4 != null){
            $tempNamaFoto3x4 = $foto3x4->getClientOriginalName();
            $namaFileFoto3x4 = 'Foto 3x4 '.$kodePendaftaran.$tempNamaFoto3x4;
            $upload = $this
                ->calonMahasiswaKelengkapanServe
                ->handleUploadGambar($foto3x4, $namaFileFoto3x4);
        }else{
            $namaFileFoto3x4 = NULL;
        }

        if($foto4x6 != null){
            $tempNamaFoto4x6 = $foto4x6->getClientOriginalName();
            $namaFileFoto4x6 = 'Foto 4x6 '.$kodePendaftaran.$tempNamaFoto4x6;
            $upload = $this
                ->calonMahasiswaKelengkapanServe
                ->handleUploadGambar($foto4x6, $namaFileFoto4x6);
        }else{
            $namaFileFoto4x6 = NULL;
        }

        if($suratKeteranganPindah != null){
            $tempSuratKeteranganPindah = $suratKeteranganPindah->getClientOriginalName();
            $namaFileSuratKeteranganPindah = 'Surat Keterangan Pindah '.$kodePendaftaran.$tempSuratKeteranganPindah;
            $upload = $this
                ->calonMahasiswaKelengkapanServe
                ->handleUploadGambar($suratKeteranganPindah, $namaFileSuratKeteranganPindah);
        }else{
            $namaFileSuratKeteranganPindah = NULL;
        }

        if($fotoCopyTranskripNilai != null){
            $tempFotocopyTranskripNilai = $fotoCopyTranskripNilai->getClientOriginalName();
            $namaFileFotocopyTranskripNilai = 'Fotocopy Transkrip Nilai '.$kodePendaftaran.$tempFotocopyTranskripNilai;
            $upload = $this
                ->calonMahasiswaKelengkapanServe
                ->handleUploadGambar($fotoCopyTranskripNilai, $namaFileFotocopyTranskripNilai);
        }else{
            $namaFileFotocopyTranskripNilai = NULL;
        }

        if($fotoCopyIjazahPerguruanTinggiAsal != null){
            $tempFotocopyIjazahPerguruanTinggiAsal = $fotoCopyIjazahPerguruanTinggiAsal->getClientOriginalName();
            $namaFileFotocopyIjazahPerguruanTinggiAsal = 'Fotocopy Ijazah Perguruan Tinggi '.$kodePendaftaran.$tempFotocopyIjazahPerguruanTinggiAsal;
            $upload = $this
                ->calonMahasiswaKelengkapanServe
                ->handleUploadGambar($fotoCopyIjazahPerguruanTinggiAsal, $namaFileFotocopyIjazahPerguruanTinggiAsal);
        }else{
            $namaFileFotocopyIjazahPerguruanTinggiAsal = NULL;
        }

        $dataCalonMahasiswa = [
            'kode' => $kodePendaftaran,
            'kode_jurusan' => $jurusan,
            'kode_kelas' => $kodeKelas,
            'kode_gelombang' => $gelombang,
            'kode_potongan' => $kodePotongan,
            'status_pendaftaran' => $statusPendaftaran
        ];

        $dataCalonMahasiswaStatus = [
            'kode_pendaftaran' => $kodePendaftaran,
            'status' => $status,
            'asal_sekolah' => $asalSekolah,
            'asal_jurusan' => $asalJurusan,
            'jurusan_pilihan' => $jurusan,
            'semester' => 'GANJIL'
        ];

        $dataCalonMahasiswaBiodata = [
            'kode_pendaftaran' => $kodePendaftaran,
            'nama' => $nama,
            'jenis_kelamin' => $jenisKelamin,
            'alamat' => $alamat,
            'rt_rw' => $rtrw,
            'kelurahan' => $kelurahan,
            'kecamatan' => $kecamatan,
            'kode_pos' => $kodePos,
            'kota_kabupaten' => $kotaKabupaten,
            'provinsi' => $provinsi,
            'kota_lahir' => $kotaLahir,
            'tanggal' => $tanggalLahir,
            'bulan' => $bulanLahir,
            'tahun' => $tahunLahir,
            'pekerjaan' => $pekerjaan,
            'nomor_telepon_rumah' => $nomorTeleponRumah,
            'nomor_telepon' => $nomorTelepon,
            'email' => $email,
            'website' => $website,
            'mengenal_stmik' => $mengenalSTMIK
        ];

        $dataCalonMahasiswaBiodataOrangTuaWali = [
            'kode_pendaftaran' => $kodePendaftaran,
            'nama_ayah' => $namaAyah,
            'nama_ibu' => $namaIbu,
            'pekerjaan_ayah' => $pekerjaanAyah,
            'pekerjaan_ibu' => $pekerjaanIbu,
            'alamat' => $alamatOrangTua,
            'rt_rw' => $rtrwOrangTua,
            'kelurahan' => $kelurahanOrangTua,
            'kecamatan' => $kecamatanOrangTua,
            'kode_pos' => $kodePosOrangTua,
            'kota_kabupaten' => $kotaKabupatenOrangTua,
            'provinsi' => $provinsiOrangTua,
            'nomor_telepon_rumah' => $nomorTeleponRumahOrangTua,
            'nomor_telepon' => $nomorTeleponOrangTua
        ];

        $dataCalonMahasiswaKelengkapan = [
            'kode_pendaftaran' => $kodePendaftaran,
            'fotocopy_raport_kelas_xii' => $namaFileFotocopyRaportKelasXII,
            'fotocopy_ijazah_sma' => $namaFileFotoCopyIjazahSMA,
            'foto_3x4' => $namaFileFoto3x4,
            'foto_4x6' => $namaFileFoto4x6,
            'surat_keterangan_pindah' => $namaFileSuratKeteranganPindah,
            'fotocopy_transkrip_nilai' => $namaFileFotocopyTranskripNilai,
            'fotocopy_ijazah_perguruan_tinggi_asal' => $namaFileFotocopyIjazahPerguruanTinggiAsal
        ];

        $store = $this
            ->calonMahasiswaRepo
            ->storeCalonMahasiswaData(
                $dataCalonMahasiswa,
                $dataCalonMahasiswaStatus,
                $dataCalonMahasiswaBiodata,
                $dataCalonMahasiswaKelengkapan,
                $dataCalonMahasiswaBiodataOrangTuaWali
            );

        // $dataPendaftaran = [
        //     'status' => 1
        // ];

        // $update = $this
        //     ->pendaftaranRepo
        //     ->updatePendaftaranData($dataPendaftaran, $id);

        // $idURL = Request::segment(3);

        return redirect('panitia/pmb/formulir/')
            ->with([
                'notification' => 'Formulir telah kami terima, pemberihatuan jadwal ujian saringan akan diberitahukan melalui email'
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
        $formulir = $this
            ->formulirRepo
            ->getSingleData($id)
            ->first();

        return view('keuangan.formulir.detail', compact('formulir'));
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

    public function downloadFormulir($id)
    {
        $formulir = $this
            ->formulirRepo
            ->getSingleData($id)
            ->first();

        $kodePendaftaran = $formulir->kode;
        $nama = $formulir->nama;

        $pdf = PDF::loadView('keuangan.formulir.formulir_pdf', compact(
            'formulir'
        ));

        $fileName = "Formulir - ".$kodePendaftaran.' - '.$nama.'.pdf';

        return $pdf->download($fileName);
    }

    public function downloadKelengkapan($id)
    {
        $formulir = $this
            ->formulirRepo
            ->getSingleData($id)
            ->first();

        $kodePendaftaran = $formulir->kode;
        $nama = $formulir->nama;

        $lampiranFormulir = $this
            ->calonMahasiswaKelengkapanRepo
            ->getSingleDataForDownload($kodePendaftaran);

        foreach ($lampiranFormulir as $item) {
            $data = [
                public_path('/uploads/pmb/pendaftaran/kelengkapan/'.$item->fotocopy_raport_kelas_xii),
                public_path('/uploads/pmb/pendaftaran/kelengkapan/'.$item->fotocopy_ijazah_sma),
                public_path('/uploads/pmb/pendaftaran/kelengkapan/'.$item->foto_3x4),
                public_path('/uploads/pmb/pendaftaran/kelengkapan/'.$item->foto_4x6),
                public_path('/uploads/pmb/pendaftaran/kelengkapan/'.$formulir->fotocopy_transkrip_nilai),
                public_path('/uploads/pmb/pendaftaran/kelengkapan/'.$formulir->fotocopy_ijazah_perguruan_tinggi_asal)
            ];
        }

        $fileName = "File Kelengkapan Calon Mahasiswa - ".$kodePendaftaran.' - '.$nama.'.zip';

        $make = Zipper::make(public_path('/files/'.$fileName))->add($data)->close();

        return response()
            ->download(public_path('/files/'.$fileName));
    }
}
