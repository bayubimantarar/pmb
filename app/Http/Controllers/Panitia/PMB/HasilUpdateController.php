<?php

namespace App\Http\Controllers\Panitia\PMB;

use PDF;
use Mail;
use DataTables;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Mail\PMB\KeteranganLulus;
use App\Http\Controllers\Controller;
use App\Repositories\PMB\BiayaRepository;
use App\Repositories\PMB\PotonganRepository;
use App\Repositories\PMB\GelombangRepository;
use App\Repositories\PMB\NilaiLulusRepository;
use App\Repositories\PMB\HasilUpdateRepository;
use App\Repositories\Dasbor\Master\ProdiRepository;

class HasilUpdateController extends Controller
{
    private $prodiRepo;
    private $biayaRepo;
    private $potonganRepo;
    private $gelombangRepo;
    private $nilaiLulusRepo;
    private $hasilUpdateRepo;

    public function __construct(
        ProdiRepository $prodiRepository,
        BiayaRepository $biayaRepository,
        PotonganRepository $potonganRepository,
        GelombangRepository $gelombangRepository,
        NilaiLulusRepository $nilaiLulusRepository,
        HasilUpdateRepository $hasilUpdateRepository
    ) {
        $this->prodiRepo = $prodiRepository;
        $this->biayaRepo = $biayaRepository;
        $this->potonganRepo = $potonganRepository;
        $this->gelombangRepo = $gelombangRepository;
        $this->nilaiLulusRepo = $nilaiLulusRepository;
        $this->hasilUpdateRepo = $hasilUpdateRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function data($kodeJadwalUjian)
    {
        $hasilUpdate = $this
            ->hasilUpdateRepo
            ->getAllHasilUpdateDataByCalonMahasiswa();

        $nilaiLulus = $this
            ->nilaiLulusRepo
            ->getAllData()
            ->first();

        return DataTables::of($hasilUpdate)
            ->addColumn('action', function($hasilUpdate) use ($kodeJadwalUjian){
                return '<center><a href="/panitia/pmb/hasil-ujian-update/'.$kodeJadwalUjian.'/kirim-email/'.$hasilUpdate->id.'" class="btn btn-xs btn-success"><i class="fa fa-envelope"></i></a></center>';
            })
            ->editColumn('status', function($hasilUpdate) use($nilaiLulus){
                if($hasilUpdate->nilai_angka >= $nilaiLulus->nilai){
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
    public function store($kodeJadwalUjian, Request $req)
    {
        $kodeJadwalUjian = $req->kode_jadwal_ujian;
        $kodePendaftaran = $req->kode_pendaftaran;
        $kodeGelombang = $req->kode_gelombang;
        $kodeJurusan = $req->kode_jurusan;
        $kodeSoal = $req->kode_soal;
        $kodeKelas = $req->kode_kelas;
        $nilaiAngka = $req->nilai_angka;

        $data = [
            'kode_jadwal_ujian' => $kodeJadwalUjian,
            'kode_pendaftaran' => $kodePendaftaran,
            'kode_gelombang' => $kodeGelombang,
            'kode_jurusan' => $kodeJurusan,
            'kode_soal' => $kodeSoal,
            'kode_kelas' => $kodeKelas,
            'nilai_angka' => $nilaiAngka
        ];

        $store = $this
            ->hasilUpdateRepo
            ->storeHasilUpdateData($data);

        return redirect('/panitia/pmb/hasil-ujian/'.$kodeJadwalUjian);
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

    public function sendEmail($kodeJadwalUjian, $id)
    {
        $hasilUpdate = $this
            ->hasilUpdateRepo
            ->getSingleHasilUpdateDataForKeteranganLulus($id);

        $nama = $hasilUpdate->nama;
        $email = $hasilUpdate->email;
        $kotaLahir = $hasilUpdate->kota_lahir;
        $tanggal = $hasilUpdate->tanggal;
        $tanggalBulan = $hasilUpdate->bulan;
        $tahun = $hasilUpdate->tahun;
        $nilaiAngka = $hasilUpdate->nilai_angka;

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

        $sekolahAsal = $hasilUpdate->asal_sekolah;
        $kodeGelombang = $hasilUpdate->kode_gelombang;
        $kodeKelas = $hasilUpdate->kode_kelas;
        $kodeJurusan = $hasilUpdate->kode_jurusan;
        $kodePotongan = $hasilUpdate->kode_potongan;
        $kodePendaftaran = $hasilUpdate->kode_pendaftaran;

        if($kodeJurusan == "IF"){
            $jurusanPilihan = "Teknik Informatika";
        }else{
            $jurusanPilihan = "Sistem Informasi";
        }

        $nilaiLulus = $this
            ->nilaiLulusRepo
            ->getAllData()
            ->first();

        $totalNilai = $nilaiLulus->nilai;

        if($nilaiAngka >= $totalNilai){
            $gelombang = $this
                ->gelombangRepo
                ->getSingleDataForBiaya($kodeGelombang);

            $biaya = $this
                ->biayaRepo
                ->getSingleDataForBiaya($kodeKelas);

            $gelombang = $this
                ->gelombangRepo
                ->getSingleDataForBiaya($kodeGelombang);

            $potongan = $this
                ->potonganRepo
                ->getSingleDataForPotongan($kodePotongan);

            $deskripsi = $potongan->deskripsi;
            $jumlahPotongan = $potongan->jumlah_potongan;

            $gelombangData = $this
                ->gelombangRepo
                ->getAllData();

            foreach ($gelombangData as $item) {
                if ($kodeGelombang == $item->kode) {
                    $tempTanggalGelombang = $item->sampai_tanggal;
                }
            }

            $biayaPendaftaran = $biaya->biaya_pendaftaran;
            $biayaJaketKemeja = $biaya->biaya_jaket_kemeja;
            $biayaPSPT = $biaya->biaya_pspt;
            $biayaPengembanganInstitusi = $biaya->biaya_pengembangan_institusi;
            $biayaKuliah = $biaya->biaya_kuliah;
            $biayaKemahasiswaan = $biaya->biaya_kemahasiswaan;
            $potonganPengembanganInstitusi = $gelombang->jumlah_potongan;
            $tanggalGelombang = $tempTanggalGelombang->formatLocalized('%d %B %Y');
            $tanggalSekarang = Carbon::now()->formatLocalized('%d %B %Y');

            $keteranganLulus = "Lulus";
            $pdf = PDF::loadView('pmb.ujian.keterangan_lulus_pdf', compact(
                'nama',
                'kodePendaftaran',
                'keteranganLulus',
                'kotaLahir',
                'tanggal',
                'bulan',
                'tahun',
                'sekolahAsal',
                'jurusanPilihan',
                'tanggalSekarang'
            ));

            $biayaPdf = PDF::loadView('pmb.ujian.biaya_daftar_ulang_pdf', compact(
                'nama',
                'sekolahAsal',
                'jurusanPilihan',
                'kodeKelas',
                'biayaPendaftaran',
                'biayaJaketKemeja',
                'biayaPSPT',
                'biayaPengembanganInstitusi',
                'biayaKuliah',
                'biayaKemahasiswaan',
                'potonganPengembanganInstitusi',
                'tanggalGelombang',
                'tanggalSekarang',
                'deskripsi',
                'jumlahPotongan'
            ));

            $file = $pdf->save(public_path("/files/Surat Kelulusan Ujian Penerimaan Siswa Baru - ".$kodePendaftaran.' - '.$nama.'.pdf'));

            $realFile = public_path("/files/Surat Kelulusan Ujian Penerimaan Siswa Baru - ".$kodePendaftaran.' - '.$nama.'.pdf');

            $filePdfBiaya = $biayaPdf->save(public_path("/files/Rincian Biaya Kuliah - ".$kodePendaftaran.' - '.$nama.'.pdf'));

            $realFilePdfBiaya = public_path("/files/Rincian Biaya Kuliah - ".$kodePendaftaran.' - '.$nama.'.pdf');

            $fileName = 'Surat Keterangan Kelulusan - '.$kodePendaftaran.' - '.$nama.'.pdf';
            $fileNamePdfBiaya = 'Rincian Biaya Kuliah - '.$kodePendaftaran.' - '.$nama.'.pdf';

            $sendEmail = Mail::to($email)
                ->send(new KeteranganLulus($realFile, $fileName, $realFilePdfBiaya, $fileNamePdfBiaya, $keteranganLulus));
        }else{
            $keteranganLulus = "Tidak Lulus";

            $pdf = PDF::loadView('pmb.ujian.keterangan_lulus_pdf', compact(
                'nama',
                'kodePendaftaran',
                'keteranganLulus',
                'kotaLahir',
                'tanggal',
                'bulan',
                'tahun',
                'sekolahAsal',
                'jurusanPilihan',
                'tanggalSekarang'
            ));

            $file = $pdf->save(public_path("/files/Surat Kelulusan Ujian Penerimaan Siswa Baru - ".$kodePendaftaran.' - '.$nama.'.pdf'));
            $realFile = public_path("/files/Surat Kelulusan Ujian Penerimaan Siswa Baru - ".$kodePendaftaran.' - '.$nama.'.pdf');
            $filePdfBiaya = NULL;
            $realFilePdfBiaya = NULL;
            $fileName = 'Surat Keterangan Kelulusan - '.$kodePendaftaran.' - '.$nama.'.pdf';
            $fileNamePdfBiaya = NULL;

            $sendEmail = Mail::to($email)
                ->send(new KeteranganLulus(
                    $realFile,
                    $fileName,
                    $realFilePdfBiaya,
                    $fileNamePdfBiaya,
                    $keteranganLulus
                ));
        }

        return redirect('/panitia/pmb/hasil-ujian/'.$kodeJadwalUjian);
    }
}
