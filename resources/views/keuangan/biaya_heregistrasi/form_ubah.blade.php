@extends('keuangan.layouts.main')

@section('title')
Keuangan &raquo; PMB &raquo; Form Tambah Data Gelombang
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
            <li><a href="/keuangan">Keuangan</a></li>
            <li><a href="/keuangan/biaya">Data Biaya</a></li>
            <li class="active">Form Tambah Data Biaya</li>
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
                        <form action="/keuangan/biaya-heregistrasi/ubah/{{$biayaHeregistrasi->id}}" method="post">
                            @csrf
                            <input type="hidden" name="_method" value="put" />
                            <div class="form-group {{ $errors->has('kelas') ? ' has-error' : ''}}">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-xs-12">
                                        <label class="control-label">Kelas</label>
                                        <input type="number" name="jumlah" class="form-control" value="{{$biayaHeregistrasi->jumlah}}" />
                                        @if($errors->has('kelas'))
                                            <p class="text-danger">
                                                <i>{{ $errors->first('kelas') }}</i>
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Simpan</button>
                            <a href="/dosen/soal" class="btn btn-default"><i class="fa fa-times"></i> Batal</a>
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
