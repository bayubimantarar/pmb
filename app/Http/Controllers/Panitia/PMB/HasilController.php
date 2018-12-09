<?php

namespace App\Http\Controllers\Panitia\PMB;

use PDF;
use DataTables;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PMB\HasilRepository;
use App\Repositories\PMB\BiayaRepository;
use App\Repositories\PMB\GelombangRepository;
use App\Repositories\PMB\NilaiLulusRepository;
use App\Repositories\Dasbor\Master\ProdiRepository;

class HasilController extends Controller
{
    private $hasilRepo;
    private $prodiRepo;
    private $biayaRepo;
    private $gelombangRepo;
    private $nilaiLulusRepo;

    public function __construct(
        HasilRepository $hasilRepository,
        ProdiRepository $prodiRepository,
        BiayaRepository $biayaRepository,
        GelombangRepository $gelombangRepository,
        NilaiLulusRepository $nilaiLulusRepository
    ) {
        $this->hasilRepo = $hasilRepository;
        $this->prodiRepo = $prodiRepository;
        $this->biayaRepo = $biayaRepository;
        $this->gelombangRepo = $gelombangRepository;
        $this->nilaiLulusRepo = $nilaiLulusRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function data($kodeJadwalUjian)
    {
        $hasil = $this
            ->hasilRepo
            ->getAllHasilDataByCalonMahasiswa();

        $nilaiLulus = $this
            ->nilaiLulusRepo
            ->getAllData()
            ->first();

        return DataTables::of($hasil)
            ->addColumn('action', function($hasil) use ($kodeJadwalUjian){
                return '<center><a href="/panitia/pmb/hasil-ujian/'.$kodeJadwalUjian.'/form-ubah/'.$hasil->id.'" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i></a></center>';
            })
            ->editColumn('status', function($hasil) use($nilaiLulus){
                if($hasil->nilai_angka >= $nilaiLulus->nilai){
                    return '<center><span class="label label-success">Lulus</span></center>';
                }else{
                    return '<center><span class="label label-danger">Tidak Lulus</span></center>';
                }
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dataFilter($kodeJurusan, $kodeGelombang, $kodeKelas, $tahun)
    {
        $hasil = $this
            ->hasilRepo
            ->getAllHasilDataByFilter($kodeJurusan, $kodeGelombang, $kodeKelas, $tahun);

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
            ->rawColumns(['status'])
            ->make(true);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($kodeJadwalUjian)
    {
        $prodi = $this
            ->prodiRepo
            ->getAllData();

        $gelombang = $this
            ->gelombangRepo
            ->getAllData();

        $biaya = $this
            ->biayaRepo
            ->getAllData();

        return view('panitia.pmb.hasil.hasil', compact(
            'prodi', 'gelombang', 'biaya', 'kodeJadwalUjian'
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
    public function edit($kodeJadwalUjian, $id)
    {
        $hasil = $this
            ->hasilRepo
            ->getSingleHasilData($id);

        return view('panitia.pmb.hasil.form_ubah', compact(
            'hasil'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($kodeJadwalUjian, Request $request, $id)
    {
        $nilaiAngka = $request->nilai_angka;
        $kodeJadwalUjian = $request->kode_jadwal_ujian;

        $data = [
            'nilai_angka' => $nilaiAngka
        ];

        $update = $this
            ->hasilRepo
            ->updateHasilData($id, $data);

        return redirect('/panitia/pmb/hasil-ujian/'.$kodeJadwalUjian)
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
        //
    }

    public function downloadKelulusan($kodeJadwalUjian, $id)
    {
        $hasil = $this
            ->hasilRepo
            ->getSingleHasilDataForKeteranganLulus($id)
            ->first();

        $nilaiLulus = $this
            ->nilaiLulusRepo
            ->getAllData()
            ->first();

        if($hasil->nilai_angka >= $nilaiLulus->nilai){
            $kodePendaftaran = $hasil->kode_pendaftaran;
            $nama = $hasil->nama;
            $kotaLahir = $hasil->kota_lahir;
            $tanggal = $hasil->tanggal;
            $tanggalBulan = $hasil->bulan;
            $tahun = $hasil->tahun;
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

            if($calonMahasiswa->kode_jurusan == "IF"){
                $jurusanPilihan = "Teknik Informatika";
            }else{
                $jurusanPilihan = "Sistem Informasi";
            }

            $tanggalSekarang = Carbon::now()->formatLocalized('%d %B %Y');

            $keteranganLulus = "LULUS";

            $pdf = PDF::loadView('panitia.pmb.hasil.kelulusan_pdf', compact(
                'nama',
                'kodePendaftaran',
                'keteranganLulus',
                'kotaLahir',
                'tanggalLahir',
                'bulan',
                'tahunLahir',
                'sekolahAsal',
                'jurusanPilihan'
            ));

            return $pdf->download("Surat Keterangan.pdf");
        }else{
            $kodePendaftaran = $hasil->kode_pendaftaran;
            $nama = $hasil->nama;
            $kotaLahir = $hasil->kota_lahir;
            $tanggalLahir = $hasil->tanggal;
            $bulanLahir = $hasil->bulan;
            $tahunLahir = $hasil->tahun;
            if($bulanLahir == '1'){
                $bulan = "Januari";
            }else if($bulanLahir == '2'){
                $bulan = "Februari";
            }else if($bulanLahir == '3'){
                $bulan = "Maret";
            }else if($bulanLahir == '4'){
                $bulan = "April";
            }else if($bulanLahir == '5'){
                $bulan = "Mei";
            }else if($bulanLahir == '6'){
                $bulan = "Juni";
            }else if($bulanLahir == '7'){
                $bulan = "Juli";
            }else if($bulanLahir == '8'){
                $bulan = "Agustus";
            }else if($bulanLahir == '9'){
                $bulan = "September";
            }else if($bulanLahir == '10'){
                $bulan = "Oktober";
            }else if($bulanLahir == '11'){
                $bulan = "November";
            }else if($bulanLahir == '12'){
                $bulan = "Desember";
            }

            $sekolahAsal = $hasil->asal_sekolah;

            if($hasil->kode_jurusan == "IF"){
                $jurusanPilihan = "Teknik Informatika";
            }else{
                $jurusanPilihan = "Sistem Informasi";
            }

            $tanggalSekarang = Carbon::now()->formatLocalized('%d %B %Y');

            $keteranganLulus = "TIDAK LULUS";

            $pdf = PDF::loadView('panitia.pmb.hasil.kelulusan_pdf', compact(
                'nama',
                'kodePendaftaran',
                'keteranganLulus',
                'kotaLahir',
                'tanggalLahir',
                'bulan',
                'tahunLahir',
                'sekolahAsal',
                'jurusanPilihan'
            ));

            return $pdf->download("Surat Keterangan.pdf");
        }
    }
}
