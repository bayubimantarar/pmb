@extends('mahasiswa.layouts.main')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Cari Soal</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Cari Soal
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form action="/mahasiswa/ujian/soal/cari" method="get">
                            <div class="form-group {{$errors->has('token') ? ' has-error' : ''}}">
                                <div class="row">
                                    <div class="col-lg-5 col-md-5 col-xs-12">
                                        <label class="control-label" for="inputError">Kode Soal</label>
                                        <input type="text" name="kode_soal" class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-search"></i> Cari Soal</button>
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
@endsection
