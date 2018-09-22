@extends('dasbor.layouts.main')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Form Tambah Data Tahun Ajaran</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <ul class="breadcrumb">
            <li><a href="/dasbor">Dasbor</a></li>
            <li><a href="/dasbor/tahun-ajaran">Data Tahun Ajaran</a></li>
            <li class="active">Form Tambah Data Tahun Ajaran</li>
        </ul>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Form Data Dosen
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form action="/dasbor/tahun-ajaran/simpan" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Tahun Ajaran</label>
                                <div class="form-inline">
                                    <div class="form-group {{ $errors->has('tahun_awal') ? ' has-error' : '' }}">
                                        <div class="row">
                                            <div class="col-lg-5 col-md-5 col-xs-12">
                                                <input type="number" class="form-control" name="tahun_awal" value="{{ old('tahun_awal') }}"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>-</label>
                                    </div>
                                    <div class="form-group {{ $errors->has('tahun_akhir') ? ' has-error' : '' }}">
                                        <div class="row">
                                            <div class="col-lg-5 col-md-5 col-xs-12">
                                                <input type="number" class="form-control" name="tahun_akhir" value="{{ old('tahun_akhir') }}" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if($errors->has('tahun_awal'))
                                    <p class="text-danger"><i>{{ $errors->first('tahun_awal') }}</i></p>
                                @endif
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-5 col-md-5 col-xs-12">
                                        <label class="control-label">Semester</label>
                                        <select name="semester" class="form-control">
                                            <option value="1">Ganjil</option>
                                            <option value="2">Genap</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Simpan</button>
                            <a href="/dasbor/dosen" class="btn btn-default"><i class="fa fa-times"></i> Batal</a>
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
