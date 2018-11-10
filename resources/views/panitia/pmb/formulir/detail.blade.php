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
                            <h1>Status dan pilihan</h1>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-lg-12 {{$errors->has('status_pendaftaran') ? ' has-error' : ''}}">
                                        <label>Pendaftaran *</label>
                                        <input type="text" class="form-control" value="{{ $formulir->status_pendaftaran }}" readonly />
                                        @if($errors->has('status_pendaftaran'))
                                            <p class="text-danger"><i>{{ $errors->first('status_pendaftaran') }}</i></p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-lg-12 {{$errors->has('status') ? ' has-error' : ''}}">
                                        <label>Status Calon Mahasiswa *</label>
                                        <input type="text" class="form-control" value="{{ $formulir->status }}" readonly />
                                        @if($errors->has('status'))
                                            <p class="text-danger"><i>{{ $errors->first('status') }}</i></p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-lg-12">
                                        <label for="">Asal Sekolah / Perguruan Tinggi</label>
                                        <input type="text" class="form-control" name="asal_sekolah" value="{{ $formulir->asal_sekolah }}" readonly />
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-lg-12">
                                        <label for="">Jurusan</label>
                                        <input type="text" class="form-control" name="asal_jurusan" value="{{ $formulir->asal_jurusan }}" readonly />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-lg-12 {{$errors->has('jurusan') ? ' has-error' : ''}}">
                                        <label for="">Jurusan Pilihan *</label>
                                        <input type="text" class="form-control" value="@if($formulir->kode_jurusan == "IF") Teknik Informatika @else Sistem Informasi @endif" readonly />
                                        @if($errors->has('jurusan'))
                                            <p class="text-danger"><i>{{ $errors->first('jurusan') }}</i></p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <hr />
                            <h1>Biodata calon mahasiswa</h1>
                            <div class="form-group {{$errors->has('nama') ? ' has-error' : ''}}">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-lg-12">
                                        <label class="control-label">Nama Lengkap *</label>
                                        <input type="text" name="nama" class="form-control" value="{{ $formulir->nama }}" readonly />
                                        @if($errors->has('nama'))
                                            <p class="text-danger"><i>{{ $errors->first('nama') }}</i></p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group {{$errors->has('jenis_kelamin') ? ' has-error' : ''}}">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-lg-12">
                                        <label for="" class="control-label">Jenis Kelamin *</label>
                                        <input type="text" name="nama" class="form-control" value="@if($formulir->jenis_kelamin == "1") Laki-laki @else Perempuan @endif" readonly />
                                        @if($errors->has('jenis_kelamin'))
                                            <p class="text-danger"><i>{{ $errors->first('jenis_kelamin') }}</i></p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-lg-12 {{$errors->has('alamat') ? ' has-error' : ''}}">
                                        <label class="control-label">Alamat *</label>
                                        <textarea name="alamat" id="" class="form-control" rows="3" readonly>{{ $formulir->alamat }}</textarea>
                                        @if($errors->has('alamat'))
                                            <p class="text-danger"><i>{{ $errors->first('alamat') }}</i></p>
                                        @endif
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-lg-12">
                                        <label class="control-label">RT/RW</label>
                                        <input type="text" name="rt" value="{{ $formulir->rt_rw }}" class="form-control" readonly />
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-lg-12">
                                        <label for="">Kelurahan</label>
                                        <input type="text" name="kelurahan" value="{{ $formulir->kelurahan }}" class="form-control" readonly />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-lg-12">
                                        <label for="">Kecamatan</label>
                                        <input type="text" name="Kecamatan" value="{{ $formulir->kecamatan }}" class="form-control" readonly />
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-lg-12">
                                        <label for="">Kode Pos</label>
                                        <input type="number" name="kode_pos" value="{{ $formulir->kode_pos }}" class="form-control" readonly />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-lg-12">
                                        <label for="">Kota / Kabupaten</label>
                                        <input type="text" name="kota_kabupaten" value="{{ $formulir->kota_kabupaten }}" class="form-control" readonly />
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-lg-12">
                                        <label for="">Provinsi</label>
                                        <input type="text" name="provinsi" value="{{ $formulir->provinsi }}" class="form-control" readonly />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-lg-12">
                                        <label for="">Kota Kelahiran *</label>
                                        <input type="text" name="kota_lahir" value="{{ $formulir->kota_lahir }}" class="form-control" readonly />
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-lg-12">
                                        <label class="control-label">Tanggal Lahir</label>
                                        <input type="text" name="kota_lahir" value="{{ $formulir->tanggal }}" class="form-control" readonly />
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-lg-12">
                                        <label class="control-label">Bulan Lahir</label>
                                        @if($formulir->bulan == "1")
                                            <input type="text" value="Januari" class="form-control" readonly />
                                        @elseif($formulir->bulan == "2")
                                            <input type="text" value="Februari" class="form-control" readonly />
                                        @elseif($formulir->bulan == "3")
                                            <input type="text" value="Maret" class="form-control" readonly />
                                        @elseif($formulir->bulan == "4")
                                            <input type="text" value="April" class="form-control" readonly />
                                        @elseif($formulir->bulan == "5")
                                            <input type="text" value="Mei" class="form-control" readonly />
                                        @elseif($formulir->bulan == "6")
                                            <input type="text" value="Juni" class="form-control" readonly />
                                        @elseif($formulir->bulan == "7")
                                            <input type="text" value="Juli" class="form-control" readonly />
                                        @elseif($formulir->bulan == "8")
                                            <input type="text" value="Agustus" class="form-control" readonly />
                                        @elseif($formulir->bulan == "9")
                                            <input type="text" value="September" class="form-control" readonly />
                                        @elseif($formulir->bulan == "10")
                                            <input type="text" value="Oktober" class="form-control" readonly />
                                        @elseif($formulir->bulan == "11")
                                            <input type="text" value="November" class="form-control" readonly />
                                        @elseif($formulir->bulan == "12")
                                            <input type="text" value="Desember" class="form-control" readonly />
                                        @endif
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-lg-12">
                                        <label class="control-label">Tahun Lahir</label>
                                        <input type="text" value="{{ $formulir->tahun }}" class="form-control" readonly />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-lg-12">
                                        <label class="control-label">Pekerjaan</label>
                                        <input type="text" value="{{ $formulir->pekerjaan }}" class="form-control" readonly />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-lg-12">
                                        <label for="">Telepon Rumah</label>
                                        <input type="number" name="nomor_telepon_rumah" value="{{ $formulir->nomor_telepon_rumah }}" class="form-control" readonly />
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-lg-12 {{$errors->has('nomor_telepon') ? ' has-error' : ''}}">
                                        <label class="control-label">Nomor Handphone *</label>
                                        <input type="number" name="nomor_telepon" class="form-control" value="{{ $formulir->nomor_telepon }}" readonly />
                                        @if($errors->has('nomor_telepon'))
                                            <p class="text-danger"><i>{{ $errors->first('nomor_telepon') }}</i></p>
                                        @endif
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-lg-12 {{$errors->has('jenis_kelamin') ? ' has-error' : ''}}">
                                        <label class="control-label">Email *</label>
                                        <input type="text" name="email" class="form-control" value="{{ $formulir->email }}" readonly />
                                        @if($errors->has('email'))
                                            <p class="text-danger"><i>{{ $errors->first('email') }}</i></p>
                                        @endif
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-lg-12">
                                        <label for="">Website</label>
                                        <input type="text" name="website" value="{{ $formulir->website }}" class="form-control" readonly />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-lg-12">
                                        <label for="">Mengenal STMIK BANDUNG</label>
                                        <input type="text" value="{{ $formulir->mengenal_stmik }}" class="form-control" readonly />
                                    </div>
                                </div>
                            </div>
                            <hr />
                            <h1>Biodata Orang Tua / Wali</h1>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-lg-12 {{$errors->has('nama_ayah') ? ' has-error' : ''}}">
                                        <label class="control-label">Nama Lengkap ayah *</label>
                                        <input type="text" name="nama_ayah" class="form-control" value="{{ $formulir->nama_ayah }}" readonly />
                                        @if($errors->has('nama_ayah'))
                                            <p class="text-danger"><i>{{ $errors->first('nama_ayah') }}</i></p>
                                        @endif
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-lg-12">
                                        <label for="">Pekerjaan Ayah</label>
                                        <input type="text" name="nama_ayah" class="form-control" value="{{ $formulir->pekerjaan_ayah }}" readonly />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-lg-12 {{$errors->has('nama_ibu') ? ' has-error' : ''}}">
                                        <label class="control-label">Nama Lengkap Ibu *</label>
                                        <input type="text" name="nama_ayah" class="form-control" value="{{ $formulir->nama_ibu }}" readonly />
                                        @if($errors->has('nama_ibu'))
                                            <p class="text-danger"><i>{{ $errors->first('nama_ibu') }}</i></p>
                                        @endif
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-lg-12">
                                        <label for="">Pekerjaan Ibu</label>
                                        <input type="text" name="nama_ayah" class="form-control" value="{{ $formulir->pekerjaan_ibu }}" readonly />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-lg-12 {{$errors->has('alamat_orang_tua') ? ' has-error' : ''}}">
                                        <label class="control-label">Alamat *</label>
                                        <textarea name="alamat_orang_tua" id="" class="form-control" rows="3" readonly>{{ $formulir->alamat_orang_tua }}</textarea>
                                        @if($errors->has('alamat_orang_tua'))
                                            <p class="text-danger"><i>{{ $errors->first('alamat_orang_tua') }}</i></p>
                                        @endif
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-lg-12">
                                        <label class="control-label">RT/RW</label>
                                        <input type="text" name="rt" value="{{ $formulir->rt_rw_orang_tua }}" class="form-control" readonly />
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-lg-12">
                                        <label for="">Kelurahan</label>
                                        <input type="text" name="kelurahan" value="{{ $formulir->kelurahan_orang_tua }}" class="form-control" readonly />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-lg-12">
                                        <label for="">Kecamatan</label>
                                        <input type="text" name="Kecamatan_orang_tua" class="form-control" value="{{ $formulir->kecamatan_orang_tua }}" readonly />
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-lg-12">
                                        <label for="">Kode Pos</label>
                                        <input type="number" name="kode_pos_orang_tua" class="form-control" value="{{ $formulir->kode_pos_orang_tua }}" readonly />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-lg-12">
                                        <label for="">Kota / Kabupaten</label>
                                        <input type="text" name="kota_kabupaten_orang_tua" class="form-control" value="{{ $formulir->kota_kabupaten_orang_tua }}" readonly />
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-lg-12">
                                        <label for="">Provinsi</label>
                                        <input type="text" name="provinsi_orang_tua" class="form-control" value="{{ $formulir->provinsi_orang_tua }}" readonly />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-lg-12">
                                        <label for="">Telepon Rumah</label>
                                        <input type="number" name="nomor_telepon_rumah_orang_tua" class="form-control" value="{{ $formulir->nomor_telepon_rumah_orang_tua }}" readonly />
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-lg-12 {{$errors->has('nomor_telepon_orang_tua') ? ' has-error' : ''}}">
                                        <label class="control-label">Nomor Handphone *</label>
                                        <input type="number" name="nomor_telepon_orang_tua" class="form-control" value="{{ $formulir->nomor_telepon_orang_tua }}" readonly />
                                        @if($errors->has('nomor_telepon_orang_tua'))
                                            <p class="text-danger"><i>{{ $errors->first('nomor_telepon_orang_tua') }}</i></p>
                                        @endif
                                    </div>
                                </div>
                            </div>
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
