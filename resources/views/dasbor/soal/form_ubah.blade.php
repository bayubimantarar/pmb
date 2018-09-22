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
            <li><a href="/dasbor/soal">Data Soal</a></li>
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
                        <form action="/dasbor/soal/ubah/{{ $tempsoal->id }}" method="post">
                            @csrf
                            <input type="hidden" name="_method" value="put" />
                            <div class="form-group {{$errors->has('kode') ? ' has-error' : ''}}">
                                <div class="row">
                                    <div class="col-lg-5 col-md-5 col-xs-12">
                                        <label class="control-label" for="inputError">Kode Soal</label>
                                        <input type="text" name="kode" class="form-control" value="{{ $tempsoal->kode }}" />
                                        @if($errors->has('kode'))
                                            <p class="text-danger"><i>{{ $errors->first('kode') }}</i></p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-5 col-md-5 col-xs-12">
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
                                    <div class="col-lg-5 col-md-5 col-xs-12">
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
                                    <div class="col-lg-5 col-md-5 col-xs-12">
                                        <label class="control-label" for="inputError">Sifat Ujian</label>
                                        <input type="text" name="sifat_ujian" class="form-control" value="{{ $tempsoal->sifat_ujian }}" />
                                        @if($errors->has('sifat_ujian'))
                                            <p class="text-danger"><i>{{ $errors->first('sifat_ujian') }}</i></p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group {{$errors->has('tanggal_ujian') ? ' has-error' : ''}}">
                                <div class="row">
                                    <div class="col-lg-5 col-md-5 col-xs-12">
                                        <label class="control-label" for="inputError">Tanggal Ujian</label>
                                        <div class='input-group date' id='datetimepicker1'>
                                            <input type="text" name="tanggal_ujian"  class="form-control" />
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                        @if($errors->has('tanggal_ujian'))
                                            <p class="text-danger">{{ $errors->first('tanggal_ujian') }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group {{$errors->has('durasi_ujian') ? ' has-error' : ''}}">
                                <div class="row">
                                    <div class="col-lg-5 col-md-5 col-xs-12">
                                        <label class="control-label" for="inputError">Durasi Ujian</label>
                                        <input type="number" name="durasi_ujian" class="form-control" value="{{ $tempsoal->durasi_ujian }}" />
                                        @if($errors->has('durasi_ujian'))
                                            <p class="text-danger"><i>{{ $errors->first('durasi_ujian') }}</i></p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Simpan</button>
                            <a href="/dasbor/soal" class="btn btn-default"><i class="fa fa-times"></i> Batal</a>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/locale/id.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
<script>
$(function(){
    $('#datetimepicker1').datetimepicker({
        locale: 'id'
    });
});
</script>
@endpush
