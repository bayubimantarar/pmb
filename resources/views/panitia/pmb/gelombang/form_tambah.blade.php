@extends('panitia.layouts.main')

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
                        <form action="/panitia/pmb/gelombang/ubah" method="post">
                            @csrf
                            <input type="hidden" name="_method" value="put" />
                            <div class="form-group {{ $errors->has('kode') ? ' has-error' : ''}}">
                                <div class="row">
                                    <div class="col-lg-5 col-md-5 col-xs-12">
                                        <label class="control-label">Kode Gelombang</label>
                                        <input type="text" name="kode" class="form-control" id="kode" value="{{ old('kode') }}" readonly/>
                                        @if($errors->has('kode'))
                                            <p class="text-danger">
                                                <i>{{ $errors->first('kode') }}</i>
                                            </p>
                                        @endif  
                                    </div>
                                    <div class="col-lg-5 col-md-5 col-xs-12">
                                        <label class="control-label">Nama Gelombang</label>
                                        <select name="nama" class="form-control" id="nama">
                                            <option value="">--- Pilih Nama Gelombang ---</option>
                                            <option value="Gelombang 1" {{ old('nama') == "Gelombang 1" ? "selected" : "" }}>Gelombang 1</option>
                                            <option value="Gelombang 2" {{ old('nama') == "Gelombang 2" ? "selected" : "" }}>Gelombang 2</option>
                                            <option value="Gelombang 3" {{ old('nama') == "Gelombang 3" ? "selected" : "" }}>Gelombang 3</option>
                                        </select>
                                        @if($errors->has('nama'))
                                            <p class="text-danger">
                                                <i>{{ $errors->first('nama') }}</i>
                                            </p>
                                        @endif  
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="form-group {{ $errors->has('nama') ? ' has-error' : ''}}">
                                <div class="row">
                                    
                                </div>
                            </div>
 --}}                            <div class="row">
                                <div class="col-lg-3 col-md-3 col-xs-12">
                                    <div class="form-group {{$errors->has('dari_tanggal') ? ' has-error' : ''}}">
                                        <label class="control-label">Dari Tanggal</label>
                                        <div class='input-group date' id="dari-tanggal">
                                            <input type="text" name="dari_tanggal" class="form-control dari-tanggal" value="{{ old('dari_tanggal') }}" />
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                        @if($errors->has('dari_tanggal'))
                                            <p class="text-danger">
                                                <i>{{ $errors->first('dari_tanggal') }}</i>
                                            </p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-xs-12">
                                    <div class="form-group {{$errors->has('sampai_tanggal') ? ' has-error' : ''}}">
                                        <label class="control-label">Sampai Tanggal</label>
                                        <div class='input-group date' id="sampai-tanggal">
                                            <input type="text" name="sampai_tanggal" class="form-control" value="{{ old('sampai_tanggal') }}" />
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                        @if($errors->has('sampai_tanggal'))
                                            <p class="text-danger">
                                                <i>{{ $errors->first('sampai_tanggal') }}</i>
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-5 col-md-5 col-xs-12">
                                        <label class="control-label">Jumlah Potongan</label>
                                        <input type="number" name="jumlah_potongan" class="form-control" value="{{ old('jumlah_potongan') }}" />
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

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/locale/id.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
<script>
$(document).ready(function(){
    // $("#kode").val("GELOMBANG");
    $('#dari-tanggal').datetimepicker({
        locale: 'id',
        format:'DD-MM-YYYY',
    });
    $('#sampai-tanggal').datetimepicker({
        locale: 'id',
        format:'DD-MM-YYYY',
    });
    $('#nama').change(function(){
        var nama = $("#nama").val();
        var kode_nama = nama.substring(10, 11);
        console.log(kode_nama);
        var kode = "GELOMBANG"+kode_nama;
        $('#kode').val(kode);
    });
});
</script>
@endpush
