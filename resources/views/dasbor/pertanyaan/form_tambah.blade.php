@extends('dasbor.layouts.main')

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
            <li><a href="/dasbor">Dasbor</a></li>
            <li class="active">Data Pertanyaan</li>
            <li class="active">{{ $kodesoal }}</li>
            <li class="active">Form Tambah Data Pertanyaan</li>
        </ul>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Form Data Pertanyaan
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form action="/dasbor/soal/simpan" method="post">
                            @csrf
                            <div class="form-group {{$errors->has('kode') ? ' has-error' : ''}}">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-xs-12">
                                        <label class="control-label" for="inputError">Nama Mata Kuliah</label>
                                        <input type="text" name="kode_soal" class="form-control" value="{{ $pertanyaan->nama_mata_kuliah }}" readonly />
                                        @if($errors->has('kode'))
                                            <p class="text-danger">{{ $errors->first('kode') }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group {{$errors->has('kode') ? ' has-error' : ''}}">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-xs-12">
                                        <label class="control-label" for="inputError">Jenis Ujian</label>
                                        <input type="text" name="kode_soal" class="form-control" value="{{ $pertanyaan->nama_jenis_ujian }}" readonly />
                                        @if($errors->has('kode'))
                                            <p class="text-danger">{{ $errors->first('kode') }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group {{$errors->has('kode') ? ' has-error' : ''}}">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-xs-12">
                                        <label class="control-label" for="inputError">Kode Soal</label>
                                        <input type="text" name="kode_soal" class="form-control" value="{{ $pertanyaan->kode_soal }}" readonly />
                                        @if($errors->has('kode'))
                                            <p class="text-danger">{{ $errors->first('kode') }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group {{$errors->has('kode') ? ' has-error' : ''}}">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                        <label class="control-label" for="inputError">Pertanyaan</label>
                                        <textarea name="pertanyaan" id="editor" cols="30" rows="10"></textarea>
                                        @if($errors->has('kode'))
                                            <p class="text-danger">{{ $errors->first('kode') }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group {{$errors->has('kode') ? ' has-error' : ''}}">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                        <label class="control-label" for="inputError">Pilihan Ganda Opsi A</label>
                                        <textarea name="pertanyaan" id="editor" cols="30" rows="10"></textarea>
                                        @if($errors->has('kode'))
                                            <p class="text-danger">{{ $errors->first('kode') }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group {{$errors->has('kode') ? ' has-error' : ''}}">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                        <label class="control-label" for="inputError">Pilihan Ganda Opsi B</label>
                                        <textarea name="pertanyaan" id="editor" cols="30" rows="10"></textarea>
                                        @if($errors->has('kode'))
                                            <p class="text-danger">{{ $errors->first('kode') }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group {{$errors->has('kode') ? ' has-error' : ''}}">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                        <label class="control-label" for="inputError">Pilihan Ganda Opsi C</label>
                                        <textarea name="pertanyaan" id="editor" cols="30" rows="10"></textarea>
                                        @if($errors->has('kode'))
                                            <p class="text-danger">{{ $errors->first('kode') }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group {{$errors->has('kode') ? ' has-error' : ''}}">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                        <label class="control-label" for="inputError">Pilihan Ganda Opsi D</label>
                                        <textarea name="pertanyaan" id="editor" cols="30" rows="10"></textarea>
                                        @if($errors->has('kode'))
                                            <p class="text-danger">{{ $errors->first('kode') }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group {{$errors->has('kode') ? ' has-error' : ''}}">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                        <label class="control-label" for="inputError">Pilihan Ganda Opsi E</label>
                                        <textarea name="pertanyaan" id="editor" cols="30" rows="10"></textarea>
                                        @if($errors->has('kode'))
                                            <p class="text-danger">{{ $errors->first('kode') }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group {{$errors->has('kode') ? ' has-error' : ''}}">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                        <label class="control-label" for="inputError">Jawaban</label>
                                        <textarea name="pertanyaan" id="editor" cols="30" rows="10"></textarea>
                                        @if($errors->has('kode'))
                                            <p class="text-danger">{{ $errors->first('kode') }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-check"></i> Simpan</button>
                            <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-times"></i> Batal</button>
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
<script src='https://cloud.tinymce.com/stable/tinymce.min.js'></script>
<script>
    tinymce.init({
        mode: "textareas"
    });
</script>
@endpush
