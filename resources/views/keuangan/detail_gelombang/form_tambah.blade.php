@extends('keuangan.layouts.main')

@section('title')
Panitia &raquo; PMB &raquo; Form Tambah Data Gelombang
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Form Tambah Data Gelombang</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <ul class="breadcrumb">
            <li><a href="/dosen">Panitia</a></li>
            <li><a href="/dosen/soal">Data Soal</a></li>
            <li class="active">Form Tambah Data Soal</li>
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
                        <form action="/keuangan/detail-gelombang/{{$kodeGelombang}}/simpan" method="post">
                            @csrf
                            <input type="hidden" name="kode_potongan" value="{{$kodeGelombang}}" />
                            <div class="form-group {{ $errors->has('deskripsi') ? ' has-error' : ''}}">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-xs-12">
                                        <label class="control-label">Deskripsi Biaya *</label>
                                        <textarea name="deskripsi" class="form-control" rows="5"></textarea>
                                        @if($errors->has('deskripsi'))
                                            <p class="text-danger">
                                                <i>{{ $errors->first('deskripsi') }}</i>
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('jumlah') ? ' has-error' : ''}}">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-xs-12">
                                        <label class="control-label">Jumlah *</label>
                                        <input type="number" name="jumlah" class="form-control" />
                                        @if($errors->has('jumlah'))
                                            <p class="text-danger">
                                                <i>{{ $errors->first('jumlah') }}</i>
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Simpan</button>
                            <a href="/keuangan/detail-gelombang/{{$kodeGelombang}}" class="btn btn-default"><i class="fa fa-times"></i> Batal</a>
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
