@extends('mahasiswa.layouts.main')

@push('css')
<style>
.sticky {
    position: -webkit-sticky;
    position: sticky;
    background-color: rgba(255, 0, 0, 0.3);
    top: 20px;
    text-align: center;
}
</style>
@endpush

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Soal </h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <ul class="breadcrumb">
            <li><a href="/dasbor">Dasbor</a></li>
            <li class="active">Ujian</li>
        </ul>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Form jawaban pertanyaan
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form action="/mahasiswa/ujian/soal/selesai" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="total_pertanyaan" value="{{ $totalPertanyaan }}" />
                            <input type="hidden" name="kode_soal" value="{{ $kodesoal }}" />
                            <input type="hidden" name="nim" value="{{ Auth::Guard('mahasiswa')->User()->nim }}">
                            <center>
                                <h1><b>
                                    {{ $jenisujian }} {{ $semester }} <br />
                                    Tahun Ajaran {{ $tahun }}
                                </b></h1>
                            </center>
                            <hr />
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6 col-md-12 col-xs-12">
                                        <div class="pull-left">
                                        <p><b>Mata Kuliah : {{ $matakuliah }}</b></p>
                                        <p><b>Kelas : {{ $kelas }}</b></p>
                                    </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-xs-12">
                                        <div class="pull-right">
                                        <p><b>Tanggal Ujian: {{ $tanggalujian }}</b></p>
                                        <p><b>Durasi Ujian : {{ $durasi }} menit</b></p>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <hr />
                            <div class="sticky">
                                Sisa waktu <input id="minutes" type="text" style="width: 27px; border: none; background-color:rgba(255, 0, 0, 0); font-size: 16px; font-weight: bold;" readonly> menit <input id="seconds" type="text" style="width: 20px; border: none; background-color:rgba(255, 0, 0, 0); font-size: 16px; font-weight: bold;" readonly>detik
                            </div>
                            @foreach($dataPertanyaan as $item)
                                @if($item->jenis_pertanyaan == 'essay')
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h3><b>Pertanyaan Nomor {{$nomorsoal}}</b></h3>
                                                <input type="hidden" name="jenis_pertanyaan[{{$i}}]" value="{{ $item->jenis_pertanyaan }}" />
                                                <input type="hidden" name="nomor_pertanyaan[{{$i}}]" value="{{$item->id}}" />
                                                @if($item->gambar != null)
                                                    <center>
                                                        <img src="/uploads/pertanyaan/gambar/{{ $item->gambar }}" class="img-responsive" />
                                                    </center>
                                                @endif
                                                {!! $item->pertanyaan !!}
                                                <textarea name="jawaban_essay[{{$i}}]" id="" cols="30" rows="10"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group {{$errors->has('gambar.'.$i) ? ' has-error' : ''}}">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-xs-12">
                                                <input type="file" name="gambar[{{$i}}]" id="gambar-{{$i}}" data="{{$i}}" />
                                                @if($errors->has('gambar.'.$i))
                                                    <p class="text-danger">
                                                        <i>
                                                            {{ $errors->first('gambar.'.$i) }}
                                                        </i>
                                                    </p>
                                                @endif
                                                <p class="help-block">
                                                    <i>Kosongkan jika tidak memerlukan jawaban bergambar</i>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-xs-12">
                                                <img id="show-image-{{$i}}" class="img-responsive img-thumbnail"/>
                                            </div>
                                        </div>
                                    </div>
                                    <hr />
                                @else
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h3><b>Pertanyaan Nomor {{$nomorsoal}}</b></h3>
                                                <input type="hidden" name="jenis_pertanyaan[{{$i}}]" value="{{ $item->jenis_pertanyaan }}" />
                                                <input type="hidden" name="nomor_pertanyaan[{{$i}}]" value="{{$item->id}}" />
                                                @if($item->gambar != null)
                                                    <center>
                                                        <img src="/uploads/pertanyaan/gambar/{{ $item->gambar }}" class="img-responsive" />
                                                    </center>
                                                @endif
                                                {!! $item->pertanyaan !!}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-xs-12">
                                                <div class="form-group">
                                                    <label class="control-label">
                                                        A) <input type="radio" name="jawaban_pilihan[{{$i}}]" value="a" />
                                                    </label>
                                                    {!! $item->pilihan_a !!}
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-xs-12">
                                                <div class="form-group">
                                                    <label class="control-label">
                                                        B) <input type="radio" name="jawaban_pilihan[{{$i}}]" value="b" />
                                                    </label>
                                                    {!! $item->pilihan_b !!}
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-xs-12">
                                                <div class="form-group">
                                                    <label class="control-label">
                                                        C) <input type="radio" name="jawaban_pilihan[{{$i}}]" value="c" readonly />
                                                    </label>
                                                    {!! $item->pilihan_c !!}
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-xs-12">
                                                <div class="form-group">
                                                    <label class="control-label">
                                                        D) <input type="radio" name="jawaban_pilihan[{{$i}}]" value="d" />
                                                    </label>
                                                    {!! $item->pilihan_d !!}
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-xs-12">
                                                <div class="form-group">
                                                    <label class="control-label">
                                                        E) <input type="radio" name="jawaban_pilihan[{{$i}}]" value="e" />
                                                    </label>
                                                    {!! $item->pilihan_e !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr />
                                @endif
                                <div class="hidden">{{$nomorsoal++}}</div>
                                <div class="hidden">{{$i++}}</div>
                            @endforeach
                            <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Selesai</button>
                        </form>
                    </div>
                    <!-- /.col-lg-12 (nested) -->
                </div>
                <!-- /.row (nested) -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
@endsection

@push('js')
<script src="/assets/vendor/tinymce/js/jquery.tinymce.min.js"></script>
<script src="/assets/vendor/tinymce/js/tinymce.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    // window.onbeforeunload = function () {
    //     return "Do you want to leave this ?";
    // };
    tinymce.init({
        mode: "textareas",
        readonly: 0
    });

    for(var i=0; i<{{ $totalPertanyaan}}; i++){
        $('#gambar-'+i).change(function(input){
            var url = URL.createObjectURL($('#gambar-'+$(this).attr("data")).get(0).files[0]);
            $("#show-image-"+$(this).attr("data")).attr('src', url).show();
        });
    }
    
});
// set minutes
var mins = {{ \Carbon\Carbon::now()->diffInMinutes($tanggalselesaiujian) }};
 
// calculate the seconds (don't change this! unless time progresses at a different speed for you...)
var secs = mins * 60;
function countdown() {
    setTimeout('Decrement()',1000);
}
function Decrement() {
    if (document.getElementById) {
        minutes = document.getElementById("minutes");
        seconds = document.getElementById("seconds");
        // if less than a minute remaining
        if (seconds < 59) {
            seconds.value = secs;
        } else {
            minutes.value = getminutes();
            seconds.value = getseconds();
        }

        if(minutes.value == 0 && seconds.value == 0){
            alert('Waktu sudah habis, silahkan simpan ujiannya.');
            $(':radio:not(:checked)').attr('disabled', true);
            tinymce.activeEditor.getBody().setAttribute('contenteditable', false);
        }else{
            secs--;
            setTimeout('Decrement()',1000);
        }
    }
}
function getminutes() {
    // minutes is seconds divided by 60, rounded down
    mins = Math.floor(secs / 60);
    return mins;
}
function getseconds() {
    // take mins remaining (as seconds) away from total seconds remaining
    return secs-Math.round(mins *60);
}
countdown();
</script>
@endpush
