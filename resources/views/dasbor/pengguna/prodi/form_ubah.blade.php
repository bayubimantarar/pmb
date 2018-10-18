@extends('dasbor.layouts.main')

@section('title')
Dasbor &raquo; Pengguna &raquo; Prodi &raquo; Form Tambah Data Prodi
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Form Ubah Data Prodi</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <ul class="breadcrumb">
            <li><a href="/dasbor">Dasbor</a></li>
            <li><a href="/dasbor/pengguna/prodi">Data Prodi</a></li>
            <li class="active">Form Ubah Data Prodi</li>
        </ul>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Form Data Prodi
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form action="/dasbor/pengguna/prodi/ubah/{{ $prodi->id }}" method="post">
                            @csrf
                            <h1>Data Diri</h1>
                            <hr />
                            <input type="hidden" name="_method" value="put" />
                            <div class="form-group {{$errors->has('nidn') ? ' has-error' : ''}}">
                                <div class="row">
                                    <div class="col-lg-5 col-md-5 col-xs-12">
                                        <label class="control-label" for="inputError">NIDN</label>
                                        <input type="text" name="nidn" class="form-control" id="nidn" value="{{ $prodi->nidn }}" />
                                        @if($errors->has('nidn'))
                                            <p class="text-danger">{{ $errors->first('nidn') }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-5 col-md-5 col-xs-12">
                                        <label class="control-label" for="inputError">Prodi</label>
                                        <select name="kode_prodi" class="form-control" id="kode-jenis-ujian">
                                            @foreach($prodiMaster as $item)
                                                <option value="{{ $item->kode }}" {{ ($item->kode == $prodi->kode_prodi ) ? 'selected' : '' }}>
                                                    {{ $item->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('nama') ? ' has-error' : '' }}">
                                <div class="row">
                                    <div class="col-lg-5 col-md-5 col-xs-12">
                                        <label class="control-label" for="inputError">Nama Lengkap</label>
                                        <input type="text" name="nama" class="form-control" value="{{ $prodi->nama }}" />
                                        @if($errors->has('nama'))
                                            <p class="text-danger">{{ $errors->first('nama') }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group {{$errors->has('nomor_telepon') ? ' has-error' : ''}}">
                                <div class="row">
                                    <div class="col-lg-5 col-md-5 col-xs-12">
                                        <label class="control-label">
                                            Nomor Telepon
                                        </label>
                                        <input type="number" name="nomor_telepon" class="form-control" value="{{ $prodi->nomor_telepon }}" />
                                        @if($errors->has('nomor_telepon'))
                                            <p class="text-danger">{{ $errors->first('nomor_telepon') }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group {{$errors->has('email') ? ' has-error' : ''}}">
                                <div class="row">
                                    <div class="col-lg-5 col-md-5 col-xs-12">
                                        <label class="control-label">
                                            Email
                                        </label>
                                        <input type="text" name="email" class="form-control" value="{{ $prodi->email }}" />
                                        @if($errors->has('email'))
                                            <p class="text-danger">{{ $errors->first('email') }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('alamat') ? ' has-error' : '' }}">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-xs-12">
                                        <label class="control-label" for="inputError">Alamat</label>
                                        <textarea name="alamat" class="form-control" rows="5">{{ $prodi->alamat }}</textarea>
                                        @if($errors->has('alamat'))
                                            <p class="text-danger">{{ $errors->first('alamat') }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <h1>Akun Akses Aplikasi</h1>
                            <hr />
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-5 col-md-5 col-xs-12">
                                        <label class="control-label" >NIDN</label>
                                        <input class="form-control" id="nidn-account" value="{{ $prodi->nidn }}" readonly />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                                <div class="row">
                                    <div class="col-lg-5 col-md-5 col-xs-12">
                                        <label class="control-label" >Kata Sandi</label>
                                        <input type="password" name="password" class="form-control" />
                                        @if($errors->has('password'))
                                            <p class="text-danger"><i>{{ $errors->first('password') }}</i></p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <div class="row">
                                    <div class="col-lg-5 col-md-5 col-xs-12">
                                        <label class="control-label" >Ulangi Kata Sandi</label>
                                        <input type="password" name="password_confirmation" class="form-control" value="{{ old('password_confirmation') }}" />
                                        @if($errors->has('password_confirmation'))
                                            <p class="text-danger"><i>{{ $errors->first('password_confirmation') }}</i></p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Simpan</button>
                            <a href="/dasbor/mahasiswa" class="btn btn-default"><i class="fa fa-times"></i> Batal</a>
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
<script>
    $("#nidn").keyup(function(){
        $("#nidn-account").val($("#nidn").val());
    });
</script>
@endpush
