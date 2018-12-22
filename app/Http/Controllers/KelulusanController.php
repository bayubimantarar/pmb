<?php

namespace App\Http\Controllers;

use Crypt;
use Illuminate\Http\Request;
use App\Repositories\PMB\SesiRepository;
use App\Repositories\PMB\HasilRepository;
use App\Repositories\PMB\CalonMahasiswaRepository;

class KelulusanController extends Controller
{
    private $hasilRepo, $calonMahasiswaRepo, $sesiRepo;

    public function __construct(
        SesiRepository $sesiRepository,
        HasilRepository $hasilRepository,
        CalonMahasiswaRepository $calonMahasiswaRepository
    ) {
        $this->sesiRepo = $sesiRepository;
        $this->hasilRepo = $hasilRepository;
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
            ->getSingleDataForKelulusan($kodePendaftaran);

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
        $nilai = $calonMahasiswa->nilai_angka;

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

        return view('kelulusan', compact(
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
            'nilai'
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
}
