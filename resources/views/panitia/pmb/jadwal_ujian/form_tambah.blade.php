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
                        @if(session('notification'))
                            <div class="alert alert-dismissible alert-danger">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                {{ session('notification') }}
                            </div>
                        @endif
                        <form action="/panitia/pmb/jadwal-ujian/simpan" method="post">
                            @csrf
                            <div class="form-group {{$errors->has('kode') ? ' has-error' : ''}}">
                                <div class="row">
                                    <div class="col-lg-5 col-md-5 col-xs-12">
                                        <label class="control-label">Kode</label>
                                        <input type="text" name="kode" class="form-control" id="kode" value="{{ old('kode') }}" readonly />
                                        @if($errors->has('kode'))
                                            <p class="text-danger">
                                                <i>{{ $errors->first('kode') }}</i>
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-lg-3 col-md-3 col-xs-12">
                                    <div class="form-group {{$errors->has('kode_jurusan') ? ' has-error' : ''}}">
                                        <label class="control-label">Jurusan</label>
                                        <select name="kode_jurusan" class="form-control" id="kode-jurusan">
                                            <option value="">-- Pilih Jurusan --</option>
                                            @foreach($prodi as $item)
                                                <option value="{{ $item->kode }}" {{ ($item->kode == old('kode_jurusan')) ? 'selected' : '' }}>
                                                    {{ $item->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('kode_jurusan'))
                                            <p class="text-danger">
                                                <i>{{ $errors->first('kode_jurusan') }}</i>
                                            </p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-xs-12">
                                    <div class="form-group {{$errors->has('kode_soal') ? ' has-error' : ''}}">
                                        <label class="control-label">Soal</label>
                                        <select name="kode_soal" class="form-control" id="kode-soal">
                                            <option value="">-- Pilih Soal --</option>
                                            @foreach($soal as $item)
                                                <option value="{{ $item->kode }}" {{ ($item->kode == old('kode_soal')) ? 'selected' : '' }}>
                                                    {{ $item->kode }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('kode_soal'))
                                            <p class="text-danger">
                                                <i>{{ $errors->first('kode_soal') }}</i>
                                            </p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-xs-12">
                                    <div class="form-group {{$errors->has('status_pendaftaran') ? ' has-error' : ''}}">
                                        <label class="control-label">Status Pendaftaran *</label>
                                        <select name="status_pendaftaran" class="form-control" id="status-pendaftaran">
                                            <option value="">-- Pilih Status Pendaftaran --</option>
                                            <option value="Baru">Ujian Baru</option>
                                            <option value="Mengulang">Ujian Mengulang</option>
                                        </select>
                                        @if($errors->has('status_pendaftaran'))
                                            <p class="text-danger">
                                                <i>{{ $errors->first('status_pendaftaran') }}</i>
                                            </p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-xs-12">
                                    <div class="form-group {{$errors->has('kode_gelombang') ? ' has-error' : ''}}">
                                        <label class="control-label">Gelombang</label>
                                        <select name="kode_gelombang" class="form-control" id="kode-gelombang">
                                            <option value="">-- Pilih gelombang --</option>
                                            @foreach($gelombang as $item)
                                                <option value="{{ $item->kode }}" {{ ($item->kode == old('kode_gelombang')) ? 'selected' : '' }}>
                                                    {{ $item->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('kode_gelombang'))
                                            <p class="text-danger">
                                                <i>{{ $errors->first('kode_gelombang') }}</i>
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-xs-12">
                                    <div class="form-group {{$errors->has('tahun') ? ' has-error' : ''}}">
                                        <label class="control-label">Tahun</label>
                                        <select name="tahun" class="form-control">
                                            @for($i=date('Y'); $i>=1950; $i--)
                                                <option value="{{ $i }}" {{ old('tahun') == $i ? "selected" : "" }}>
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                        @if($errors->has('tahun'))
                                            <p class="text-danger">
                                                <i>{{ $errors->first('tahun') }}</i>
                                            </p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-xs-12">
                                    <div class="form-group {{$errors->has('total_sesi') ? ' has-error' : ''}}">
                                        <label class="control-label">Jumlah Peserta Per Sesi *</label>
                                        <input type="number" name="total_sesi" class="form-control" />
                                        @if($errors->has('total_sesi'))
                                            <p class="text-danger">
                                                <i>{{ $errors->first('total_sesi') }}</i>
                                            </p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-xs-12">
                                    <div class="form-group {{$errors->has('durasi_jeda') ? ' has-error' : ''}}">
                                        <label class="control-label">Durasi Jeda*</label>
                                        <input type="number" name="durasi_jeda" class="form-control" />
                                        <code>
                                            Dalam satuan menit
                                        </code>
                                        @if($errors->has('durasi_jeda'))
                                            <p class="text-danger">
                                                <i>{{ $errors->first('durasi_jeda') }}</i>
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-xs-12">
                                    <div class="form-group {{$errors->has('tanggal_mulai_ujian') ? ' has-error' : ''}}">
                                        <label class="control-label">Tanggal Mulai Ujian</label>
                                        <div class="input-group date" id="tanggal-mulai-ujian">
                                            <input type="text" name="tanggal_mulai_ujian" class="form-control" value="{{ old('tanggal_mulai_ujian') }}" />
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                        @if($errors->has('tanggal_mulai_ujian'))
                                            <p class="text-danger">
                                                <i>{{ $errors->first('tanggal_mulai_ujian') }}</i>
                                            </p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-xs-12">
                                    <div class="form-group {{$errors->has('tanggal_selesai_ujian') ? ' has-error' : ''}}">
                                        <label class="control-label">Tanggal Selesai Ujian</label>
                                        <div class="input-group date" id="tanggal-selesai-ujian">
                                            <input type="text" name="tanggal_selesai_ujian" class="form-control" value="{{ old('tanggal_selesai_ujian') }}" />
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                        @if($errors->has('tanggal_selesai_ujian'))
                                            <p class="text-danger">
                                                <i>{{ $errors->first('tanggal_selesai_ujian') }}</i>
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
    $('#tanggal-mulai-ujian').datetimepicker({
        locale: 'id',
        format:'DD-MM-YYYY HH:mm:ss',
    });
    $('#tanggal-selesai-ujian').datetimepicker({
        locale: 'id',
        format:'DD-MM-YYYY HH:mm:ss',
    });
    $("#kode-soal").change(function(){
        var kode_soal = $("#kode-soal").val();
        var kode_gelombang = $("#kode-gelombang").val();
        if($("#status-pendaftaran").val() == "Baru"){
            status_pendaftaran = "BARU";
        }else{
            status_pendaftaran = "MENGULANG";
        }
        var kode = kode_soal+kode_gelombang+status_pendaftaran;
        $("#kode").val(kode);
    });
    $("#status-pendaftaran").change(function(){
        var kode_soal = $("#kode-soal").val();
        var kode_gelombang = $("#kode-gelombang").val();
        if($("#status-pendaftaran").val() == "Baru"){
            status_pendaftaran = "BARU";
        }else{
            status_pendaftaran = "MENGULANG";
        }
        var kode = kode_soal+kode_gelombang+status_pendaftaran;
        $("#kode").val(kode);
    });
    $("#kode-gelombang").change(function(){
        var kode_soal = $("#kode-soal").val();
        var kode_gelombang = $("#kode-gelombang").val();
        if($("#status-pendaftaran").val() == "Baru"){
            status_pendaftaran = "BARU";
        }else{
            status_pendaftaran = "MENGULANG";
        }
        var kode = kode_soal+kode_gelombang+status_pendaftaran;
        $("#kode").val(kode);
    });
});
</script>
@endpush
