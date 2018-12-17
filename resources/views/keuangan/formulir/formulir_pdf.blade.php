<html>
    <head>
        <title></title>
        <style>
            table{
                font-size: 11px;
            }
            .heading{

            }
            .heading h1, h2, h3, h4, h5, h6{
                text-align: center;
                color: #000;
            }
            h3.status{
                text-align: left;
            }
        </style>
    </head>
    <body>
        <div class="heading">
            <h1>FORMULIR PENDAFTARAN</h1>
            <h2>CALON MAHASISWA BARU - PROGRAM SARJANA (S1)</h2>
        </div>
        <div class="status">
            <h3 class="status">Status dan pilihan</h3>
            <hr />
            <table>
                <tr>
                    <td><b>Status Calon Mahasiswa :</b> {{ $formulir->status }}</td>
                    <td><b>Asal Sekolah / PT :</b> {{ $formulir->asal_sekolah }}</td>
                </tr>
                <tr>
                    <td></td>
                    <td><b>Jurusan :</b> {{ $formulir->asal_jurusan }}</td>
                </tr>
                <tr>
                    <td>
                        <b>Jurusan Pilihan :</b>
                        @if($formulir->kode_jurusan == "IF")
                            Teknik Informatika
                        @else
                            Sistem Informasi
                        @endif
                    </td>
                    <td><b>Kode Pendaftaran :</b> {{ $formulir->kode }}</td>
                </tr>
            </table>
        </div>
        <div class="biodata">
            <h3 class="status">Biodata calon mahasiswa</h3>
            <hr />
            <table>
                <tr>
                    <td><b>Nama Lengkap :</b> {{ $formulir->nama }}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>
                        <b>Jenis Kelamin :</b> 
                        @if($formulir->jenis_kelamin == "1")
                            Laki-laki
                        @else
                            Perempuan
                        @endif
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td><b>Alamat Rumah :</b> {{ $formulir->alamat }}</td>
                    <td><b>RT/RW :</b> {{$formulir->rt_rw}}</td>
                    <td><b>Kelurahan :</b> {{$formulir->kelurahan}}</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td><b>Kecamatan :</b> {{$formulir->kecamatan}}</td>
                    <td><b>Kode Pos :</b> {{$formulir->kode_pos}}</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td><b>Kota / Kabupaten :</b> {{$formulir->kota_kabupaten}}</td>
                    <td><b>Provinsi :</b> {{$formulir->provinsi}}</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td><b>Tempat & Tanggal Lahir</b></td>
                    <td><b>Kota :</b> {{$formulir->kota_lahir}}</td>
                    <td><b>Tanggal :</b> {{$formulir->tanggal}}</td>
                    <td>
                        <b>Bulan :</b> 
                        @if($formulir->bulan == "1")
                            Januari
                        @elseif($formulir->bulan == "2")
                            Februari
                        @elseif($formulir->bulan == "3")
                            Maret
                        @elseif($formulir->bulan == "4")
                            April
                        @elseif($formulir->bulan == "5")
                            Mei
                        @elseif($formulir->bulan == "6")
                            Juni
                        @elseif($formulir->bulan == "7")
                            Juli
                        @elseif($formulir->bulan == "8")
                            Agustus
                        @elseif($formulir->bulan == "9")
                            September
                        @elseif($formulir->bulan == "10")
                            Oktober
                        @elseif($formulir->bulan == "11")
                            November
                        @elseif($formulir->bulan == "12")
                            Desember
                        @endif
                    </td>
                    <td><b>Tahun :</b> {{$formulir->tahun}}</td>
                </tr>
                <tr>
                    <td><b>Pekerjaan : </b>{{$formulir->pekerjaan}}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td><b>Nomor kontak</b></td>
                    <td><b>Telepon Rumah :</b> {{$formulir->nomro_telepon_rumah}}</td>
                    <td><b>HP :</b> {{$formulir->nomor_telepon}}</td>
                    <td><b>Email :</b> {{$formulir->email}}</td>
                    <td><b>Website :</b> {{$formulir->website}}</td>
                </tr>
                <tr>
                    <td><b>Mengenal STMIK Bandung :</b> {{$formulir->mengenal_stmik}}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </table>
        </div>
        <div>
            <h3 class="status">Biodata orang tua / wali</h3>
            <hr />
            <table>
                <tr>
                    <td><b>Nama Lengkap Ayah</b> : {{$formulir->nama_ayah}}</td>
                </tr>
                <tr>
                    <td><b>Nama Lengkap Ibu</b> : {{$formulir->nama_ibu}}</td>
                </tr>
                <tr>
                    <td><b>Pekerjaan Ayah</b> : {{$formulir->pekerjaan_ayah}}</td>
                </tr>
                <tr>
                    <td><b>Pekerjaan Ibu</b> : {{$formulir->pekerjaan_ibu}}</td>
                </tr>
                <tr>
                    <td><b>Alamat Rumah :</b> {{$formulir->alamat_orang_tua}}</td>
                    <td><b>RT/RW :</b> {{$formulir->rt_rw_orang_tua}}</td>
                    <td><b>Kelurahan :</b> {{$formulir->kelurahan_orang_tua}}</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td><b>Kecamatan :</b> {{$formulir->kecamatan_orang_tua}}</td>
                    <td><b>Kode Pos :</b> {{$formulir->kode_pos_orang_tua}}</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td><b>Kota / Kabupaten :</b> {{$formulir->kota_kabupaten_orang_tua}}</td>
                    <td><b>Provinsi :</b> {{$formulir->provinsi_orang_tua}}</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td><b>Nomor kontak</b></td>
                    <td><b>Telepon Rumah :</b> {{$formulir->nomor_telepon_rumah_orang_tua}}</td>
                    <td><b>HP :</b> {{$formulir->nomor_telepon_orang_tua}}</td>
                </tr>
            </table>
        </div>
    </body>
</html>
