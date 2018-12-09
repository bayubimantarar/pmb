@extends('keuangan.layouts.main')

@section('title')
Keuangan &raquo; PMB &raquo; Form Tambah Data Potongan
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Form Tambah Data Potongan</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <ul class="breadcrumb">
            <li><a href="/dosen">Keuangan</a></li>
            <li><a href="/dosen/soal">Data Potongan</a></li>
            <li class="active">Form Tambah Data Potongan</li>
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
                        <form action="/keuangan/potongan/simpan" method="post">
                            @csrf
                            <div class="form-group {{ $errors->has('deskripsi') ? ' has-error' : ''}}">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-xs-12">
                                        <label class="control-label">Keterangan</label>
                                        <input type="text" name="deskripsi" class="form-control" value="{{ old('deskripsi') }}" />
                                        @if($errors->has('deskripsi'))
                                            <p class="text-danger">
                                                <i>{{ $errors->first('deskripsi') }}</i>
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('jumlah_potongan') ? ' has-error' : ''}}">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-xs-12">
                                        <label class="control-label">Jumlah Potongan</label>
                                        <input type="number" name="jumlah_potongan" class="form-control" value="{{ old('jumlah_potongan') }}" />
                                        @if($errors->has('jumlah_potongan'))
                                            <p class="text-danger">
                                                <i>{{ $errors->first('jumlah_potongan') }}</i>
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Simpan</button>
                            <a href="/keuangan/potongan" class="btn btn-default"><i class="fa fa-times"></i> Batal</a>
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
