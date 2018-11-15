@extends('panitia.layouts.main')

@section('title')
Panitia &raquo; Data Jawaban &raquo; Data Jawaban
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Data Jawaban</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <ul class="breadcrumb">
            <li><a href="/dosen">Panitia</a></li>
            <li class="active">Data Jawaban</li>
            <li class="active">{{ $kodeSoal }}</li>
            <li class="active">Data Jawaban</li>
        </ul>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                Jawaban Calon Mahasiswa
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        @foreach($jawaban as $item)
                            @if($item->jenis_pertanyaan == 'Benar-Salah')
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h3><b>Pertanyaan Nomor {{$nomorSoal}}</b></h3>
                                            @if($item->gambar != null)
                                                <center>
                                                    <img src="/uploads/pertanyaan/gambar/{{ $item->gambar }}" class="img-responsive" />
                                                </center>
                                            @endif
                                            <p>{!! $item->pertanyaan !!}</p>
                                            <p>Jawaban</p>
                                            <p>{!! $item->jawaban_benar_salah !!}</p>
                                        </div>
                                    </div>
                                </div>
                                <hr />
                            @else
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h3><b>Pertanyaan Nomor {{$nomorSoal}}</b></h3>
                                            <input type="hidden" name="jenis_pertanyaan[]" value="{{ $item->jenis_pertanyaan }}" />
                                            <input type="hidden" name="nomor_pertanyaan" value="{{$item->id}}" />
                                            @if($item->gambar != null)
                                                <center>
                                                    <img src="/uploads/pertanyaan/gambar/{{ $item->gambar }}" class="img-responsive" />
                                                </center>
                                            @endif
                                            {!! $item->pertanyaan !!}
                                            <p>Jawaban</p>
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
                                        </div>
                                    </div>
                                </div>
                                <hr />
                            @endif
                            <div class="hidden">{{$nomorSoal++}}</div>
                        @endforeach
                    </div>
                    <!-- /.col-lg-12 (nested) -->
                </div>
                <!-- /.row (nested) -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>

    <div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                Pertanyaan
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        @foreach($pertanyaan as $item)
                            @if($item->jenis_pertanyaan == 'Benar-Salah')
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h3><b>Pertanyaan Nomor {{$nomorSoalPertanyaan}}</b></h3>
                                            <input type="hidden" name="jenis_pertanyaan" value="{{ $item->jenis_pertanyaan }}" />
                                            <input type="hidden" name="nomor_pertanyaan" value="{{$item->id}}" />
                                            @if($item->gambar != null)
                                                <center>
                                                    <img src="/uploads/pertanyaan/gambar/{{ $item->gambar }}" class="img-responsive" />
                                                </center>
                                            @endif
                                            <p>{!! $item->pertanyaan !!}</p>
                                            <p>Jawaban</p>
                                            <p>{!! $item->jawaban_benar_salah !!}</p>
                                        </div>
                                    </div>
                                </div>
                                <hr />
                            @else
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h3><b>Pertanyaan Nomor {{$nomorSoalPertanyaan}}</b></h3>
                                            <input type="hidden" name="jenis_pertanyaan" value="{{ $item->jenis_pertanyaan }}" />
                                            <input type="hidden" name="nomor_pertanyaan" value="{{$item->id}}" />
                                            @if($item->gambar != null)
                                                <center>
                                                    <img src="/uploads/pertanyaan/gambar/{{ $item->gambar }}" class="img-responsive" />
                                                </center>
                                            @endif
                                            {!! $item->pertanyaan !!}
                                            <p>Jawaban</p>
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
                                        </div>
                                    </div>
                                </div>
                                <hr />
                            @endif
                            <div class="hidden">{{$nomorSoalPertanyaan++}}</div>
                        @endforeach    
                    </div>
                    <!-- /.col-lg-12 (nested) -->
                </div>
                <!-- /.row (nested) -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
</div>
<!-- /.row -->
@endsection

@push('js')
<script src="/assets/vendor/tinymce/js/jquery.tinymce.min.js"></script>
<script src="/assets/vendor/tinymce/js/tinymce.min.js"></script>
@endpush
