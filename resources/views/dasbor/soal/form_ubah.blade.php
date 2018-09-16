@extends('dasbor.layouts.main')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Form Ubah Data Soal</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <ul class="breadcrumb">
            <li><a href="/dasbor">Dasbor</a></li>
            <li><a href="/dasbor/mata-kuliah">Data Soal</a></li>
            <li class="active">Form Ubah Data Soal</li>
        </ul>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Form Data Soal
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form action="/dasbor/soal/ubah/{{ $soal->id }}" method="post">
                            @csrf
                            <input type="hidden" name="_method" value="put" />
                            <div class="form-group {{$errors->has('kode') ? ' has-error' : ''}}">
                                <div class="row">
                                    <div class="col-lg-2 col-md-2 col-xs-12">
                                        <label class="control-label" for="inputError">Kode Soal</label>
                                        <input type="text" name="kode" class="form-control" value="{{ $soal->kode }}" />
                                        @if($errors->has('kode'))
                                            <p class="text-danger">{{ $errors->first('kode') }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-xs-12">
                                        <label for="">Jenis Ujian</label>
                                        <select name="kode_jenis_ujian" class="form-control">
                                            @foreach($jenisujian as $item)
                                                <option value="{{ $item->kode }}">{{ $item->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-xs-12">
                                        <label for="">Mata Kuliah</label>
                                        <select name="kode_mata_kuliah" class="form-control">
                                            @foreach($matakuliah as $item)
                                                <option value="{{ $item->kode }}">{{ $item->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group {{$errors->has('sifat_ujian') ? ' has-error' : ''}}">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-xs-12">
                                        <label class="control-label" for="inputError">Sifat Ujian</label>
                                        <input type="text" name="sifat_ujian" class="form-control" value="{{ $soal->sifat_ujian }}" />
                                        @if($errors->has('sifat_ujian'))
                                            <p class="text-danger">{{ $errors->first('sifat_ujian') }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group {{$errors->has('tanggal_ujian') ? ' has-error' : ''}}">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-xs-12">
                                        <label class="control-label" for="inputError">Tanggal Ujian</label>
                                        <input type="date" name="tanggal_ujian" class="form-control" value="{{ $soal->tanggal_ujian }}" />
                                        @if($errors->has('tanggal_ujian'))
                                            <p class="text-danger">{{ $errors->first('tanggal_ujian') }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group {{$errors->has('durasi_ujian') ? ' has-error' : ''}}">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-xs-12">
                                        <label class="control-label" for="inputError">Durasi Ujian</label>
                                        <input type="number" name="durasi_ujian" class="form-control" value="{{ $soal->durasi_ujian }}" />
                                        @if($errors->has('durasi_ujian'))
                                            <p class="text-danger">{{ $errors->first('durasi_ujian') }}</p>
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
