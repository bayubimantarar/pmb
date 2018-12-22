<?php

namespace App\Http\Controllers;

use Crypt;
use Illuminate\Http\Request;
use App\Repositories\PMB\SesiRepository;
use App\Http\Requests\PMB\KehadiranRequest;
use App\Repositories\PMB\KehadiranRepository;
use App\Repositories\PMB\CalonMahasiswaRepository;
use App\Repositories\Dasbor\Pengguna\PanitiaRepository;

class KehadiranController extends Controller
{
    private $calonMahasiswaRepo, $panitiaRepo, $sesiRepo, $kehadiranRepo;

    public function __construct(
        SesiRepository $sesiRepository,
        PanitiaRepository $panitiaRepository,
        KehadiranRepository $kehadiranRepository,
        CalonMahasiswaRepository $calonMahasiswaRepository
    ) {
        $this->sesiRepo = $sesiRepository;
        $this->panitiaRepo = $panitiaRepository;
        $this->kehadiranRepo = $kehadiranRepository;
        $this->calonMahasiswaRepo = $calonMahasiswaRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($kodePendaftaran)
    {
        $encryptKodePendaftaran = $kodePendaftaran;
        $kodePendaftaran = Crypt::decrypt($kodePendaftaran);

        $calonMahasiswa = $this
            ->sesiRepo
            ->getSingleDataForEmail($kodePendaftaran);

        $cekKehadiran = $this
            ->kehadiranRepo
            ->getSingleDataForKehadiran($kodePendaftaran);

        if($cekKehadiran != NULL){
            $nama = $calonMahasiswa->nama;
            $kotaLahir = $calonMahasiswa->kota_lahir;
            $id = $calonMahasiswa->id;
            $nama = $calonMahasiswa->nama;
            $kotaLahir = $calonMahasiswa->kota_lahir;
            $tanggalBulan = $calonMahasiswa->bulan;
            $tahun = $calonMahasiswa->tahun;
            $tanggal = $calonMahasiswa->tanggal;
            $foto4x6 = $calonMahasiswa->foto_4x6;
            $tanggalMulaiUjian = $calonMahasiswa->tanggal_mulai_ujian->formatLocalized('%c');
            $tanggalSelesaiUjian = $calonMahasiswa->tanggal_selesai_ujian->formatLocalized('%c');
            $durasi = $calonMahasiswa->tanggal_mulai_ujian->diffInMinutes($calonMahasiswa->tanggal_selesai_ujian);
            $ruangan = $calonMahasiswa->ruangan;
            $hasKehadiran = 0;

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

            return view('kehadiran', compact(
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
                'durasi',
                'ruangan',
                'encryptKodePendaftaran',
                'hasKehadiran'
            ));
        }else{
            $nama = $calonMahasiswa->nama;
            $kotaLahir = $calonMahasiswa->kota_lahir;
            $id = $calonMahasiswa->id;
            $nama = $calonMahasiswa->nama;
            $kotaLahir = $calonMahasiswa->kota_lahir;
            $tanggalBulan = $calonMahasiswa->bulan;
            $tahun = $calonMahasiswa->tahun;
            $tanggal = $calonMahasiswa->tanggal;
            $foto4x6 = $calonMahasiswa->foto_4x6;
            $tanggalMulaiUjian = $calonMahasiswa->tanggal_mulai_ujian->formatLocalized('%c');
            $tanggalSelesaiUjian = $calonMahasiswa->tanggal_selesai_ujian->formatLocalized('%c');
            $durasi = $calonMahasiswa->tanggal_mulai_ujian->diffInMinutes($calonMahasiswa->tanggal_selesai_ujian);
            $ruangan = $calonMahasiswa->ruangan;
            $hasKehadiran = 1;

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

            return view('kehadiran', compact(
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
                'durasi',
                'ruangan',
                'encryptKodePendaftaran',
                'hasKehadiran'
            ));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($kodePendaftaran)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($kodePendaftaran, Request $request)
    {

        $kodePendaftaran = Crypt::decrypt($request->kode_pendaftaran);

        $data = [
            'kode_pendaftaran' => $kodePendaftaran
        ];

        $store = $this
            ->kehadiranRepo
            ->storeKehadiranData($data);

        return response()->json([
            'created' => 1
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($kodePendaftaran, $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($kodePendaftaran, $id)
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
    public function update($kodePendaftaran, Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($kodePendaftaran, $id)
    {
        //
    }

    public function checkPanitia($kodePendaftaran, $nidn)
    {
        $kodePendaftaran = Crypt::decrypt($kodePendaftaran);

        $panitia = $this
            ->panitiaRepo
            ->getSingleDataForKehadiran($nidn);

        return response()->json([
            'total' => $panitia
        ]);
    }
}
