@extends('mahasiswa.layouts.main')

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
                                                        C) <input type="radio" name="jawaban_pilihan[{{$i}}]" value="c" />
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
<script>
$(document).ready(function(){
    // window.onbeforeunload = function () {
    //     return "Do you want to leave this page?";
    // };
    tinymce.init({
        mode: "textareas"
    });
});
</script>
@endpush
