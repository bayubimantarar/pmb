<html>
    <head>
        <title></title>
        <style>
            .header {

            }
            .header img {
                float: left;
                margin-top: 25px;
            }
            .header h1 {
                position: relative;
                left: 100px;
            }
            .header h5 {
                position: relative;
                bottom: 25px;
            }
            .hasil p{
                text-indent: 50px;
            }
        </style>
    </head>
    <body>
        <div class="header">
            <img src="<?php echo $_SERVER["DOCUMENT_ROOT"].'/assets/img/logo-stmik-bandung.png' ?>" height="75" />
            <h1>STMIK BANDUNG</h1>
            <h5>SEKOLAH TINGGI MANAJEMEN INFORMATIKA DAN KOMPUTER BANDUNG</h5>
        </div>
        <div class="main">
            <center>
                <h5>PANITIA PENERIMAAN MAHASISWA BARU<br />
                    STMIK Bandung<br />
                    TAHUN AKADEMIK 2018 / 2019
                </h5>
            </center>
        </div>
        <div class="hasil">
            <p>Yang bertanda tangan di bawah ini, Ketua pelaksana panitia Penerimaan Mahasiswa Baru STMIK Bandung, tahun akademik 2018/2019 pengelengara Tes Potensi Akademik (TPA) / Test Program Studi bagi calon mahasiswa baru menerangkan bahwa :</P>
            <ul style="list-style: none;">
                <li>
                    Kode Pendaftaran : {{$kodePendaftaran}}
                </li>
                <li>
                    Nama : {{$nama}}
                </li>
                <li>
                    Tempat, tanggal lahir : {{$kotaLahir}}, {{$tanggal}} {{$bulan}} {{$tahun}}
                </li>
                <li>
                    Sekolah Asal : {{$sekolahAsal}}
                </li>
                <li>
                    Program Studi Pilihan : {{$jurusanPilihan}} - S1
                </li>
            </ul>
            <center>
                <h6>
                    Dinyatakan
                </h6>
                <h3>
                   {{$keteranganLulus}}
                </h3>
            </center>
            @if($keteranganLulus == "LULUS")
                <p>
                    Kepada calon mahasiswa diwajibkan untuk segera melengkapi persyaratan dan administrasi serta mengikuti serangkaian kegiatan sebagaimana tercantum dalam Agenda akademik.
                </p>
            @else
                <p>
                    Kepada calon mahasiswa silahkan mendaftarkan diri kembali, kemudian cantumkan surat keterangan lulus ini di konfirmasi pembayaran (Tidak perlu membayar biaya pendaftaran), kemudian pilih pada status pendaftaran (Daftar Untuk Mengulang Ujian), selanjutnya ujian akan diinformasikan kembali melalui email.
                </p>
            @endif
        </div>
        <div class="tanggal">
            <p>
                Bandung, {{$tanggalSekarang}}
            </p>
            <p>
                Hormat kami,
                Panitia Penerimaan Mahasiswa Baru STMIK Bandung<br />
                Tahun Akademik 2018 / 2019
            </p>
            <br />
            <p>
                <b>
                    <u>Yus Jayusman, S.Kom., M.T,</u><br />
                    Ketua Pelaksana
                </b>
            </p>
            <br />
            <center>
                <h5>KNOWLEDGE & ENTREPRENEURSHIP UNIVERSITY</h5>
                <p>
                    Jl. Cikutra 113-A Bandung - Jawa Barat +62 22 7207777 +62 85722157777<br />
                    Email : info@stmik-bandung.ac.id www.stmik-bandung.ac.id
                </p>
            </center>
    </body>
</html>
