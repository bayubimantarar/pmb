@component('mail::message')
# PANITIA PENERIMAAN MAHASISWA BARU
# STMIK BANDUNG
# TAHUN AKADEMIK 2018 / 2019

Yang bertanda tangan di bawah ini, Ketua pelaksana panitia Penerimaan Mahasiswa Baru STMIK Bandung, tahun akademik 2018/2019 pengelengara Tes Potensi Akademik (TPA) / Test Program Studi bagi calon mahasiswa baru menerangkan bahwa :

- Kode Pendaftaran : {{ $kodePendaftaran }}
- Nama : {{ $nama }}
- Tempat, Tanggal Lahir : {{ $kotaLahir}}, {{ $tanggal }} {{ $bulan }} {{ $tahun }}
- Sekolah Asal : {{ $sekolahAsal }}
- Program Studi Pilihan : {{ $jurusanPilihan }}  - S1

Dinyatakan :
# {{ $KeteranganLulus }}

@if($KeteranganLulus == "Lulus")
Kepada calon mahasiswa diwajibkan untuk segera melengkapi persyaratan dan administrasi serta mengikuti serangkaian kegiatan sebagaimana tercantum dalam Agenda akademik
@else
Kepada calon mahasiswa silahkan mendaftarkan diri kembali, kemudian cantumkan bukti email ini di konfirmasi pembayaran (Tidak perlu membayar biaya pendaftaran), kemudian pilih pada status pendaftaran (Daftar Untuk Mengulang Ujian), selanjutnya ujian akan diinformasikan kembali melalui email
@endif

@endcomponent
