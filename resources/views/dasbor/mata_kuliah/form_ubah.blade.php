@extends('dasbor.layouts.main')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Form Ubah Data Mata Kuliah</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <ul class="breadcrumb">
            <li><a href="/dasbor">Dasbor</a></li>
            <li><a href="/dasbor/mata-kuliah">Data Mata Kuliah</a></li>
            <li class="active">Form Ubah Data Mata Kuliah</li>
        </ul>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Form Data Mata Kuliah
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form action="/dasbor/mata-kuliah/ubah/{{ $matakuliah->id }}" method="post">
                            @csrf
                            <input type="hidden" name="_method" value="put" />
                            <div class="form-group {{$errors->has('kode') ? ' has-error' : ''}}">
                                <div class="row">
                                    <div class="col-lg-2 col-md-2 col-xs-12">
                                        <label class="control-label" for="inputError">Kode Mata Kuliah</label>
                                        <input type="text" name="kode" class="form-control" value="{{ $matakuliah->kode }}" />
                                        @if($errors->has('nim'))
                                            <p class="text-danger">{{ $errors->first('kode') }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('nama') ? ' has-error' : '' }}">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-xs-12">
                                        <label class="control-label" for="inputError">Nama Mata Kuliah</label>
                                        <input type="text" name="nama" class="form-control" value="{{ $matakuliah->nama }}" />
                                        @if($errors->has('nama'))
                                            <p class="text-danger">{{ $errors->first('nama') }}</p>
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