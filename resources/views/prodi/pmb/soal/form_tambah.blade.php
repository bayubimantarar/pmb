@extends('prodi.layouts.main')

@section('title')
Dosen &raquo; Soal &raquo; Form Tambah Data Soal
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Form Tambah Data Soal</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <ul class="breadcrumb">
            <li><a href="/dosen">Dosen</a></li>
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
                        <form action="/prodi/pmb/soal/simpan" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-lg-5 col-md-5 col-xs-12">
                                    <div class="form-group {{ $errors->has('kode') ? ' has-error' : ''}}">
                                        <label class="control-label">Kode Soal</label>
                                        <input type="hidden" id="prodi" value="{{ Auth::Guard('prodi')->user()->kode_prodi }}" />
                                        <input type="text" name="kode" class="form-control" id="kode-soal" readonly value="{{ old('kode') }}" />
                                        @if($errors->has('kode'))
                                            <p class="text-danger">
                                                <i>{{ $errors->first('kode') }}</i>
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-md-3 col-xs-12">
                                    <div class="form-group {{$errors->has('kode_tahun_ajaran') ? ' has-error' : ''}}">
                                        <label class="control-label">Tahun Ajaran</label>
                                        <select name="kode_tahun_ajaran" class="form-control" class="kode-tahun-ajaran" id="kode-tahun-ajaran">
                                            <option value="">-- Pilih tahun ajaran --</option>
                                            @foreach($tahunAjaran as $item)
                                                <option value="{{ $item->tahun }}" {{ ($item->tahun == old('kode_tahun_ajaran')) ? 'selected' : '' }}>
                                                    {{ $item->tahun }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('kode_tahun_ajaran'))
                                            <p class="text-danger">
                                                <i>{{ $errors->first('kode_tahun_ajaran') }}</i>
                                            </p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-xs-12">
                                    <div class="form-group {{$errors->has('jumlah_pertanyaan') ? ' has-error' : ''}}">
                                        <label class="control-label">Jumlah Pertanyaan</label>
                                        <input type="number" name="jumlah_pertanyaan" class="form-control" value="{{ old('jumlah_pertanyaan') }}" />
                                        @if($errors->has('jumlah_pertanyaan'))
                                            <p class="text-danger">
                                                <i>{{ $errors->first('jumlah_pertanyaan') }}</i>
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

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/locale/id.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
<script>
$(document).ready(function(){
    $('#kode-tahun-ajaran').change(function(){
        var kode_tahun_ajaran   = $('#kode-tahun-ajaran').val();
        var prodi               = $("#prodi").val();
        var kode_soal           = "PMB"+prodi+kode_tahun_ajaran;
        $('#kode-soal').val(kode_soal);
        console.log(kode_tahun_ajaran);
    });
});
</script>
@endpush
