@component('mail::message')
<center>
<h1>PANITIA PENERIMAAN MAHASISWA BARU<br />
STMIK BANDUNG<br />
TAHUN AKADEMIK 2018 / 2019</h1>
</center>

Yang bertanda tangan di bawah ini, Ketua pelaksana panitia Penerimaan Mahasiswa Baru STMIK Bandung, tahun akademik 2018/2019 pengelengara Tes Potensi Akademik (TPA) / Test Program Studi bagi calon mahasiswa baru menerangkan bahwa :

- Kode Pendaftaran : {{ $kodePendaftaran }}
- Nama : {{ $nama }}
- Tempat, Tanggal Lahir : {{ $kotaLahir}}, {{ $tanggal }} {{ $bulan }} {{ $tahun }}
- Sekolah Asal : {{ $sekolahAsal }}
- Program Studi Pilihan : {{ $jurusanPilihan }}  - S1

<center>
<h1>
    Dinyatakan :
</h1>
<h1>
    {{ $KeteranganLulus }}
</h1>
</center>

@if($KeteranganLulus == "Lulus")
Kepada calon mahasiswa diwajibkan untuk segera melengkapi persyaratan dan administrasi serta mengikuti serangkaian kegiatan sebagaimana tercantum dalam Agenda akademik
@else
Kepada calon mahasiswa silahkan mendaftarkan diri kembali, kemudian cantumkan bukti email ini di konfirmasi pembayaran (Tidak perlu membayar biaya pendaftaran), kemudian pilih pada status pendaftaran (Daftar Untuk Mengulang Ujian), selanjutnya ujian akan diinformasikan kembali melalui email
@endif

@endcomponent
