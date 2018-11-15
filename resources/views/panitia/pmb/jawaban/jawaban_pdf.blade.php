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
            <h1>JAWABAN CALON MAHASISWA</h1>
        </div>
        <div class="jawaban">
            @foreach($jawaban as $item)
                <h3 class="status">Nomor pertanyaan {{ $nomorSoal++ }}</h3>
                <p>
                    <img src="<?php echo $_SERVER["DOCUMENT_ROOT"].'/uploads/pertanyaan/gambar/'.$item->gambar.''; ?>" />
                </p>
                <p>{!! $item->pertanyaan !!}</p>
                <p>Jawaban</p>
                @if($item->jenis_pertanyaan == "Benar-Salah")
                    <p>{!! $item->jawaban_benar_salah !!}</p>
                @else
                    @if($item->jawaban_pilihan == 'A')
                        <b>A)</b> {!! $item->pilihan_a !!}
                    @elseif($item->jawaban_pilihan == 'B')
                        <b>B)</b> {!! $item->pilihan_b !!}
                    @elseif($item->jawaban_pilihan == 'C')
                        <b>C)</b> {!! $item->pilihan_c !!}
                    @elseif($item->jawaban_pilihan == 'D')
                        <b>D)</b> {!! $item->pilihan_d !!}
                    @else
                        <b>E)</b> {!! $item->pilihan_e !!}
                    @endif
                @endif
            <hr />
            @endforeach
        </div>
    </body>
</html>
