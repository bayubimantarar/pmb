@extends('dosen.layouts.main')

@section('title')
Dosen &raquo; Pertanyaan &raquo; Form Ubah Data Pertanyaan
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Form Tambah Data Pertanyaan</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <ul class="breadcrumb">
            <li><a href="/dosen">Dosen</a></li>
            <li class="active">Data Pertanyaan</li>
            <li class="active">{{ $kodesoal }}</li>
            <li class="active">Form Tambah Data Pertanyaan</li>
        </ul>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                Jawaban Mahasiswa
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form action="/dosen/periksa/{{$kodesoal}}/{{$nim}}/simpan" method="post">
                        @csrf
                        <input type="hidden" name="jumlah_pertanyaan" value="{{$jumlahpertanyaan}}" />
                        <input type="hidden" name="kode_soal" value="{{$kodesoal}}" />
                        <input type="hidden" name="nim" value="{{$nim}}" />
                        @foreach($dataJawaban as $item)
                            @if($item->jenis_pertanyaan == 'essay')
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h3><b>Pertanyaan Nomor {{$nomorsoal}}</b></h3>
                                            <input type="hidden" name="jenis_pertanyaan[]" value="{{ $item->jenis_pertanyaan }}" />
                                            <input type="hidden" name="nomor_pertanyaan" value="{{$item->id}}" />
                                            @if($item->gambar != null)
                                                <center>
                                                    <img src="/uploads/pertanyaan/gambar/{{ $item->gambar }}" class="img-responsive" />
                                                </center>
                                            @endif
                                            <p>{!! $item->pertanyaan !!}</p>
                                            <p>Jawaban</p>
                                            <p>{!! $item->jawaban_essay !!}</p>
                                            <div class="row">
                                                <div class="col-md-7">
                                                    <div class="form-group">
                                                        <label for="">Bobot Nilai</label>
                                                        <input type="number" class="form-control" name="bobot[]" />
                                                        <p class="help-block"><i>Bobot nilai maksimal 10</i></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr />
                            @else
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h3><b>Pertanyaan Nomor {{$nomorsoal}}</b></h3>
                                            <input type="hidden" name="jenis_pertanyaan[]" value="{{ $item->jenis_pertanyaan }}" />
                                            <input type="hidden" name="nomor_pertanyaan" value="{{$item->id}}" />
                                            @if($item->gambar != null)
                                                <center>
                                                    <img src="/uploads/pertanyaan/gambar/{{ $item->gambar }}" class="img-responsive" />
                                                </center>
                                            @endif
                                            {!! $item->pertanyaan !!}
                                            <p>Jawaban</p>
                                            @if($item->jawaban_pilihan == 'a')
                                                <b>A)</b> {!! $item->pilihan_a !!}
                                                @if($item->jawaban_pilihan == $item->jawaban_pilihan_pertanyaan)
                                                    <div class="row">
                                                        <div class="col-md-7">
                                                            <div class="form-group">
                                                                <label for="">Bobot Nilai</label>
                                                                <input type="number" class="form-control" name="bobot[]" value="10" readonly />
                                                                <p class="help-block"><i>Bobot nilai maksimal 10</i></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @elseif($item->jawaban_pilihan == 'b')
                                                <b>B)</b> {!! $item->pilihan_b !!}
                                                @if($item->jawaban_pilihan == $item->jawaban_pilihan_pertanyaan)
                                                    <div class="row">
                                                        <div class="col-md-7">
                                                            <div class="form-group">
                                                                <label for="">Bobot Nilai</label>
                                                                <input type="number" class="form-control" name="bobot[]" value="10" readonly />
                                                                <p class="help-block"><i>Bobot nilai maksimal 10</i></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @elseif($item->jawaban_pilihan == 'c')
                                                <b>C)</b> {!! $item->pilihan_c !!}
                                                @if($item->jawaban_pilihan == $item->jawaban_pilihan_pertanyaan)
                                                    <div class="row">
                                                        <div class="col-md-7">
                                                            <div class="form-group">
                                                                <label for="">Bobot Nilai</label>
                                                                <input type="number" class="form-control" name="bobot[]" value="10" readonly />
                                                                <p class="help-block"><i>Bobot nilai maksimal 10</i></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="row">
                                                        <div class="col-md-7">
                                                            <div class="form-group">
                                                                <label for="">Bobot Nilai</label>
                                                                <input type="number" class="form-control" name="bobot[]" value="0" readonly />
                                                                <p class="help-block"><i>Bobot nilai maksimal 10</i></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @elseif($item->jawaban_pilihan == 'd')
                                                <b>D)</b> {!! $item->pilihan_d !!}
                                                @if($item->jawaban_pilihan == $item->jawaban_pilihan_pertanyaan)
                                                    <div class="row">
                                                        <div class="col-md-7">
                                                            <div class="form-group">
                                                                <label for="">Bobot Nilai</label>
                                                                <input type="number" class="form-control" name="bobot[]" value="10" readonly />
                                                                <p class="help-block"><i>Bobot nilai maksimal 10</i></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @else
                                                <b>E)</b> {!! $item->pilihan_e !!}
                                                @if($item->jawaban_pilihan == $item->jawaban_pilihan_pertanyaan)
                                                    <div class="row">
                                                        <div class="col-md-7">
                                                            <div class="form-group">
                                                                <label for="">Bobot Nilai</label>
                                                                <input type="number" class="form-control" name="bobot[]" value="10" readonly />
                                                                <p class="help-block"><i>Bobot nilai maksimal 10</i></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <hr />
                            @endif
                            <div class="hidden">{{$nomorsoal++}}</div>
                        @endforeach
                        <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Simpan</button>
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

    <div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                Form Data Pertanyaan
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        @foreach($dataPertanyaan as $item)
                            @if($item->jenis_pertanyaan == 'essay')
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h3><b>Pertanyaan Nomor {{$nomorsoalpertanyaan}}</b></h3>
                                            <input type="hidden" name="jenis_pertanyaan" value="{{ $item->jenis_pertanyaan }}" />
                                            <input type="hidden" name="nomor_pertanyaan" value="{{$item->id}}" />
                                            @if($item->gambar != null)
                                                <center>
                                                    <img src="/uploads/pertanyaan/gambar/{{ $item->gambar }}" class="img-responsive" />
                                                </center>
                                            @endif
                                            <p>{!! $item->pertanyaan !!}</p>
                                            <p>Jawaban</p>
                                            <p>{!! $item->jawaban_essay !!}</p>
                                        </div>
                                    </div>
                                </div>
                                <hr />
                            @else
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h3><b>Pertanyaan Nomor {{$nomorsoalpertanyaan}}</b></h3>
                                            <input type="hidden" name="jenis_pertanyaan" value="{{ $item->jenis_pertanyaan }}" />
                                            <input type="hidden" name="nomor_pertanyaan" value="{{$item->id}}" />
                                            @if($item->gambar != null)
                                                <center>
                                                    <img src="/uploads/pertanyaan/gambar/{{ $item->gambar }}" class="img-responsive" />
                                                </center>
                                            @endif
                                            {!! $item->pertanyaan !!}
                                            <p>Jawaban</p>
                                            @if($item->jawaban_pilihan == 'a')
                                                <b>A)</b> {!! $item->pilihan_a !!}
                                            @elseif($item->jawaban_pilihan == 'b')
                                                <b>B)</b> {!! $item->pilihan_b !!}
                                            @elseif($item->jawaban_pilihan == 'c')
                                                <b>C)</b> {!! $item->pilihan_c !!}
                                            @elseif($item->jawaban_pilihan == 'd')
                                                <b>D)</b> {!! $item->pilihan_d !!}
                                            @else
                                                <b>E)</b> {!! $item->pilihan_e !!}
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <hr />
                            @endif
                            <div class="hidden">{{$nomorsoalpertanyaan++}}</div>
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
