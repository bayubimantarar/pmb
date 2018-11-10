@extends('dasbor.layouts.main')

@section('title')
Dasbor &raquo; Master &raquo; Prodi
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Form Tambah Data Prodi</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <ul class="breadcrumb">
            <li><a href="/dasbor">Dasbor</a></li>
            <li><a href="/dasbor/master/prodi">Data Prodi</a></li>
            <li class="active">Form Tambah Data Prodi</li>
        </ul>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Form Data Prodi
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form action="/dasbor/master/prodi/simpan" method="post">
                            @csrf
                            <div class="form-group {{$errors->has('kode') ? ' has-error' : ''}}">
                                <div class="row">
                                    <div class="col-lg-5 col-md-5 col-xs-12">
                                        <label class="control-label">Kode Prodi</label>
                                        <input type="text" name="kode" value="{{ old('kode') }}" class="form-control" />
                                        @if($errors->has('kode'))
                                            <p class="text-danger"><i>{{ $errors->first('kode') }}</i></p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group {{$errors->has('nama') ? ' has-error' : ''}}">
                                <div class="row">
                                    <div class="col-lg-5 col-md-5 col-xs-12">
                                        <label class="control-label">Nama Prodi</label>
                                        <input type="text" name="nama" value="{{ old('nama') }}" class="form-control" />
                                        @if($errors->has('nama'))
                                            <p class="text-danger"><i>{{ $errors->first('nama') }}</i></p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Simpan</button>
                            <a href="/dasbor/master/prodi" class="btn btn-default"><i class="fa fa-times"></i> Batal</a>
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
