<html>
    <head>
        <title></title>
    </head>
    <body>
        <center>
            <h1>RINCIAN BIAYA KULIAH</h1>
            <h1>TAHUN AKADEMIK 2018 / 2019</h1>
            <h1>GELOMBANG III</h1>
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
                    <td width="200">
                        <center>
                            <b>Komponen Biaya</b>
                        </center>
                    </td>
                    <td width="150">
                        <center>
                            <b>Jumlah (Rp)</b>
                        </center>
                    </td>
                    <td width="150">
                        <center>
                            <b>Potongan (Rp)</b>
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
                        @if($item->potongan == NULL)
                            Rp {{ number_format(round(0), 0, ',', '.') }}
                        @else
                            <div style="display: none;">{{ $sumPotongan += $item->potongan}}</div>
                            Rp {{ number_format(round($item->potongan), 0, ',', '.') }}
                        @endif
                    </td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="3">
                        <center>Jumlah potongan</center>
                    </td>
                    <td align="right">Rp {{ number_format(round($sumPotongan), 0, ',', '.') }}</td>
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
                </tr>
                <tr>
                    <td colspan="2">
                        <center>
                            Total Kewajiban Semester 1
                        </center>
                    </td>
                    <td colspan="2" align="right">
                        Rp {{ number_format(round($sumBiaya - $sumPotongan), 0, ',', '.') }}
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
                        Rp {{ number_format(round(($sumBiaya - $sumPotongan) * 40 / 100), 0, ',', '.') }}
            </li>
            <li>
                Daftar ulang (Heregistrasi) dilaksanakan 1 minggu setelah menerima surat kelulusan dengan pembayaran minimal Rp {{ number_format((1000000),0,',','.') }}
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
        </ol>
        <p align="right">
            Bandung, {{$tanggalSekarang}}<br />
            Wakil ketua II
            <br />
            <br />
            <br />
            Linda Apriliyanti. S.kom, M.T
        </p>
    </body>
</html>
