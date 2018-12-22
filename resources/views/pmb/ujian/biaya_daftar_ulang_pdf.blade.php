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
        <center>
            <h5>
                RINCIAN BIAYA KULIAH<br/>
                TAHUN AKADEMIK 2018 / 2019<br />
                GELOMBANG III
            </h5>
        </center>
        <table>
            <tr>
                <td>Nama</td>
                <td>: {{$nama}}</td>
            </tr>
            <tr>
                <td>Asal Sekolah</td>
                <td>: {{$sekolahAsal}}</td>
            </tr>
            <tr>
                <td>Jenis Kelas</td>
                <td>
                    : @if($kodeKelas == "1")
                        Reguler Pagi
                    @elseif($kodeKelas == "2")
                        Reguler Sore
                    @else
                        Eksekutif
                    @endif
                </td>
            </tr>
        </table>
        <p>Berikut adalah rincian biaya semester 1 untuk mahasiswa baru tahun ajaran 2018 / 2019</p>
        <center>
            <table border="0.1" align="center">
                <tr>
                    <td>
                        <center>
                            <b>Nomor</b>
                        </center>
                    </td>
                    <td width="75">
                        <center>
                            <b>Komponen Biaya</b>
                        </center>
                    </td>
                    <td width="75">
                        <center>
                            <b>Jumlah (Rp)</b>
                        </center>
                    </td>
                    <td width="75">
                        <center>
                            <b>Potongan Jalur (Rp)</b>
                        </center>
                    </td>

                    <td width="75">
                        <center>
                            <b>Potongan Gelombang(Rp)</b>
                        </center>
                    </td>
                </tr>
                @foreach($detailBiaya as $item)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{$item->deskripsi}}</td>
                    <td align="right">
                        @if($item->biaya == NULL)
                            Rp {{ number_format(round(0), 0, ',', '.') }}
                        @else
                            <div style="display: none;">{{ $sumBiaya += $item->biaya}}</div>
                            Rp {{ number_format(round($item->biaya), 0, ',', '.') }}
                        @endif
                    </td>
                    <td align="right">
                        @if($item->potongan_jalur == NULL)
                            Rp {{ number_format(round(0), 0, ',', '.') }}
                        @else
                            <div style="display: none;">{{ $sumPotongan += $item->potongan_jalur}}</div>
                            Rp {{ number_format(round($item->potongan_jalur), 0, ',', '.') }}
                        @endif
                    </td>
                    <td align="right">
                        @if($item->potongan_jalur != NULL)
                            Rp {{ number_format(round(0), 0, ',', '.') }}
                        @else
                            @if($item->potongan_gelombang == NULL)
                            Rp {{ number_format(round(0), 0, ',', '.') }}
                            @else
                                <div style="display: none;">{{ $sumPotonganGelombang += $item->potongan_gelombang}}</div>
                                Rp {{ number_format(round($item->potongan_gelombang), 0, ',', '.') }}
                            @endif
                        @endif
                    </td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="3">
                        <center>Jumlah potongan</center>
                    </td>
                    <td align="right">Rp {{ number_format(round($sumPotongan), 0, ',', '.') }}</td>
                    <td align="right">Rp {{ number_format(round($sumPotonganGelombang), 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td colspan="2">
                        <center>
                            Jumlah Biaya
                        </center>
                    </td>
                    <td align="right">
                        Rp {{ number_format(round($sumBiaya), 0, ',', '.') }}
                    </td>
                    <td align="right">
                        Rp {{ number_format(round($sumPotongan), 0, ',', '.') }}
                    </td>
                    <td align="right">
                        Rp {{ number_format(round($sumPotonganGelombang), 0, ',', '.') }}
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <center>
                            Total Kewajiban Semester 1
                        </center>
                    </td>
                    <td colspan="2" align="right">
                        Rp {{ number_format(round($sumBiaya - ($sumPotongan + $sumPotonganGelombang)), 0, ',', '.') }}
                    </td>
                </tr>
            </table>
        </center>
        <p>
            <b>Keterangan</b>
        </p>
        <ol>
            <li>
                Minimal pembayaran pada saat awal perkuliahan (Semester 1) adalah 40% dari total biaya yaitu sebesar
                        Rp {{ number_format(round(($sumBiaya - ($sumPotongan + $jumlahPotonganGelombang)) * 40 / 100), 0, ',', '.') }}
            </li>
            <li>
                Daftar ulang (Heregistrasi) dilaksanakan 1 minggu setelah menerima surat kelulusan dengan pembayaran minimal Rp {{ number_format(round(($jumlahBiayaHeregistrasi)),0,',','.') }}
            </li>
            <li>
                Pembayaran dapat diangsur sampai dengan tanggal {{$tanggalGelombang}}
            </li>
            <li>
                Jika pembayaran dilakukan sekaligus / lunas mendapatkan potongan sebesar 5%
            </li>
            <li>
                Pembayaran dapat dilakukan melalui rekening <b>Bank Mandiri</b> dengan no rek : <b>131.000.7899.415</b> atas nama <b>STMIK Bandung</b>
            </li>
            <li>
                Surat ini adalah bukti surat kelulusan melalui surat elektronik yang tidak memelurkan stample
            </li>
        </ol>
        <img src="data:image/png;base64, {{ base64_encode(QrCode::format('png')->size(150)->generate("pmb.stmik-bandung.online/kelulusan/".$encryptKodePendafaran)) }} " />
        <p align="right">
            Bandung, {{$tanggalSekarang}}<br />
            Wakil ketua II
            <br />
            <br />
            <br />
            Linda Apriyanti, M.T
        </p>
    </body>
</html>
