@extends('panitia.layouts.main')

@section('title')
Panitia &raquo; PMB &raquo; Form Tambah Data Jadwal Ujian
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Form Tambah Data Jadwal Ujian</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <ul class="breadcrumb">
            <li><a href="/dosen">Panitia</a></li>
            <li><a href="/dosen/soal">Data Jadwal Ujian</a></li>
            <li class="active">Form Tambah Data Jadwal Ujian</li>
        </ul>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Form Data Jadwal Ujian
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form action="/panitia/pmb/hasil-ujian/{{ $hasil->kode_jadwal_ujian}}/ubah/{{ $hasil->id }}" method="post">
                            @csrf
                            <input type="hidden" name="_method" value="put" />
                            <input type="hidden" name="kode_jadwal_ujian" value="{{ $hasil->kode_jadwal_ujian }}" />
                            <div class="form-group {{$errors->has('kode') ? ' has-error' : ''}}">
                                <div class="row">
                                    <div class="col-lg-5 col-md-5 col-xs-12">
                                        <label class="control-label">Kode Pendaftaran</label>
                                        <input type="text" name="kode" class="form-control" id="kode" value="{{ $hasil->kode_pendaftaran }}" readonly />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group {{$errors->has('kode') ? ' has-error' : ''}}">
                                <div class="row">
                                    <div class="col-lg-5 col-md-5 col-xs-12">
                                        <label class="control-label">Nilai</label>
                                        <input type="number" name="nilai_angka" class="form-control" value="{{ $hasil->nilai_angka }}" />
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
