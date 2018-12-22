<html>
    <head>
        <title></title>
        <style>
            body{
                margin-left: 50px;
                margin-right: 50px;
            }
            .post-container {
                /*overflow: auto;*/
            }
            .post-thumb {
                float: left;
            }
            .post-thumb-2 {
                float: right;
            }
            #coba{
                float: left;
            }
            .post-content {
                margin-left: 210px;
                float:right;
            }
            .post-content-2 {
                margin-right: 210px;
                float:left;
            }
        </style>
    </head>
    <body>
        <div class="post-container">
    <div class="post-thumb">
        <img
            src="<?php echo $_SERVER["DOCUMENT_ROOT"].'/assets/img/logo-stmik-bandung.png' ?>"
            height="75"
        />
    </div>
    <div class="post-content">
        <p>
            <b>
                UJIAN SARINGAN PENERIMAAN MAHASISWA BARU <br />
                STMIK BANDUNG TAHUN {{$tahunAjaran}}
            </b>
        </p>
    </div>
    <br><br><br><br><br>
    <hr />
    <br>
    <div class="post-thumb-2">
        @if(!empty($foto4x6))
        <img
            src="<?php echo $_SERVER["DOCUMENT_ROOT"].'/uploads/pmb/pendaftaran/kelengkapan/'.$foto4x6 ?>"
            height="150"
        />
        @endif
    </div>
    <div class="post-content-2">
    <p>KODE PENDAFTARAN : {{$kodePendaftaran}}</p>
    <p>NAMA : {{$nama}}</p>
    <p>TEMPAT LAHIR : {{$kotaLahir}}</p>
    <p>TANGGAL LAHIR : {{$bulan}}, {{$tanggal}} {{$tahun}}</p>
    <p>TANGGAL MULAI UJIAN : {{$tanggalMulaiUjian}}</p>
    <p>TANGGAL SELESAI UJIAN : {{$tanggalSelesaiUjian}}</p>
    <p>RUANGAN : {{$ruangan}}</p>
    <img src="data:image/png;base64, {{ base64_encode(QrCode::format('png')->size(150)->generate("pmb.stmik-bandung.online/kehadiran/".$encryptKodePendafaran)) }} " />
    </div>
</div>
    </body>
</html>
