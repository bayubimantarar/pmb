<table>
    <thead>
        <tr>
            <th></th>
            <th>Kode Soal :</th>
            <th>Cara memilih Jenis Pertanyaan :</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td></td>
            <td>{{ $data['kode_soal'] }}</td>
            <td> - Ada 2 pilihan Jenis Pertanyaan (Pilihan Ganda / Benar-Salah).</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td> - Pilih salah satu, cukup ketik (Pilihan Ganda / Benar-Salah). </td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td> - Kosongkan Jawaban Benar Salah jika memilih Jenis Pertanyaan Pilihan Ganda.</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td> - kosongkan Jawaban Pilihan Ganda jika memilih Jenis Pertanyaan Benar-Salah</td>
        </tr>
    </tbody>
</table>
<table>
    <thead>
        <tr>
            <th>Nomor</th>
            <th>Jenis Pertanyaan</th>
            <th>Pertanyaan</th>
            <th>Pilihan A</th>
            <th>Pilihan B</th>
            <th>Pilihan C</th>
            <th>Pilihan D</th>
            <th>Pilihan E</th>
            <th>Jawaban Pilihan Ganda</th>
            <th>Jawaban Benar Salah</th>
        </tr>
    </thead>
    <tbody>
        @for($i=1; $i<=$data['jumlah_pertanyaan']; $i++)
            <tr>
                <td>{{$i}}</td>
            </tr>
        @endfor
    </tbody>
</table>
