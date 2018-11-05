<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Pendaftaran Calon Mahasiswa Baru</title>
    <!-- Bootstrap Core CSS -->
    <link href="/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- MetisMenu CSS -->
    <link href="/assets/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="/assets/dist/css/sb-admin-2.css" rel="stylesheet">
    <!-- Morris Charts CSS -->
    <link href="/assets/vendor/morrisjs/morris.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="/assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNIN Respond.js doesn't work if you view the page via fil// -->
    <!--[if lt IE 9]>
        <script src="http//oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="http//oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        body{
            margin-top: 25px;
            margin-bottom: 25px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Formulir calon mahasiswa baru
                    </div>
                    <div class="panel-body">
                        <form action="/pendaftaran/formulir/{{ $encryptID }}/simpan" method="post" enctype="multipart/form-data">
                             @if(session('notification'))
                                <div class="alert alert-success">
                                    {{ session('notification') }}
                                </div>
                            @endif
                            @if($info != NULL)
                                <center>
                                    <h1>
                                        {{ $info }}
                                    </h1>
                                </center>
                            @else
                            @csrf
                            <h1>Status dan pilihan</h1>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-lg-12 {{$errors->has('status_pendaftaran') ? ' has-error' : ''}}">
                                        <label>Pendaftaran *</label>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="status_pendaftaran" value="Baru" {{ old('status_pendaftaran') == "Baru" ? "checked" : "" }}/> Daftar Baru
                                            </label>
                                            <label>
                                                <input type="radio" name="status_pendaftaran" value="Mengulang" {{ old('status_pendaftaran') == "Mengulang" ? "checked" : "" }}/> Daftar Untuk Mengulang Ujian Masuk
                                            </label>
                                        </div>
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
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="status" value="baru" {{ old('status') == "baru" ? "checked" : "" }}/> Baru
                                            </label>
                                            <label>
                                                <input type="radio" name="status" value="pindahan" {{ old('status') == "pindahan" ? "checked" : "" }}/> Pindahan
                                            </label>
                                        </div>
                                        @if($errors->has('status'))
                                            <p class="text-danger"><i>{{ $errors->first('status') }}</i></p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-lg-12">
                                        <label for="">Asal Sekolah / Perguruan Tinggi</label>
                                        <input type="text" class="form-control" name="asal_sekolah" value="{{ old('asal_sekolah') }}" />
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-lg-12">
                                        <label for="">Jurusan</label>
                                        <input type="text" class="form-control" name="asal_jurusan" value="{{ old('asal_jurusan') }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-lg-12 {{$errors->has('jurusan') ? ' has-error' : ''}}">
                                        <label for="">Jurusan Pilihan *</label>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="jurusan" value="IF" {{ old('jurusan') == "IF" ? "checked" : "" }}/> Teknik Informatika
                                            </label>
                                            <label>
                                                <input type="radio" name="jurusan" value="SI" {{ old('jurusan') == "SI" ? "checked" : "" }}/> Sistem Informasi
                                            </label>
                                        </div>
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
                                        <input type="text" name="nama" class="form-control" value="{{ old('nama') }}"/>
                                        @if($errors->has('nama'))
                                            <p class="text-danger"><i>{{ $errors->first('nama') }}</i></p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group {{$errors->has('jenis_kelamin') ? ' has-error' : ''}}">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-lg-12">
                                        <label for="" class="control-label">Jenis Kelamin *</label>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="jenis_kelamin" value="1" {{ old('jenis_kelamin') == "1" ? "checked" : "" }}/> Laki-laki
                                            </label>
                                            <label>
                                                <input type="radio" name="jenis_kelamin" value="2" {{ old('jenis_kelamin') == "2" ? "checked" : "" }}/> Perempuan
                                            </label>
                                        </div>
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
                                        <textarea name="alamat" id="" class="form-control" rows="3">{{ old('alamat') }}</textarea>
                                        @if($errors->has('alamat'))
                                            <p class="text-danger"><i>{{ $errors->first('alamat') }}</i></p>
                                        @endif
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-lg-12">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-xs-12">
                                                <label class="control-label">RT</label>
                                                <input type="number" name="rt" value="{{ old('rt') }}" class="form-control" />  
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-xs-12">
                                                <label for="">RW</label>
                                                <input type="number" name="rw" value="{{ old('rw') }}" class="form-control" />  
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-lg-12">
                                        <label for="">Kelurahan</label>
                                        <input type="text" name="kelurahan" value="{{ old('kelurahan') }}" class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-lg-12">
                                        <label for="">Kecamatan</label>
                                        <input type="text" name="Kecamatan" value="{{ old('kecamatan') }}" class="form-control" />
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-lg-12">
                                        <label for="">Kode Pos</label>
                                        <input type="number" name="kode_pos" value="{{ old('kode_pos') }}" class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-lg-12">
                                        <label for="">Kota / Kabupaten</label>
                                        <input type="text" name="kota_kabupaten" value="{{ old('kota_kabupaten') }}" class="form-control" />
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-lg-12">
                                        <label for="">Provinsi</label>
                                        <input type="text" name="provinsi" value="{{ old('provinsi') }}" class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-lg-12">
                                        <label for="">Kota Kelahiran *</label>
                                        <input type="text" name="kota_lahir" value="{{ old('kota_lahir') }}" class="form-control" />
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-lg-12">
                                        <label class="control-label">Tanggal Lahir</label>
                                        <select name="tanggal_lahir" class="form-control">
                                            @for($i=1; $i<=31; $i++)
                                                <option value="{{ $i }}" {{ old('tanggal_lahir') == $i ? "selected" : "" }}>
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-lg-12">
                                        <label class="control-label">Bulan Lahir</label>
                                        <select name="bulan_lahir" class="form-control">
                                            <option value="1" {{ old('bulan_lahir') == '1' ? "selected" : "" }}>
                                                Januari
                                            </option>
                                            <option value="2" {{ old('bulan_lahir') == '2' ? "selected" : "" }}>
                                                Februari
                                            </option>
                                            <option value="3" {{ old('bulan_lahir') == '3' ? "selected" : "" }}>
                                                Maret
                                            </option>
                                            <option value="4" {{ old('bulan_lahir') == '4' ? "selected" : "" }}>
                                                April
                                            </option>
                                            <option value="5" {{ old('bulan_lahir') == '5' ? "selected" : "" }}>
                                                Mei
                                            </option>
                                            <option value="6" {{ old('bulan_lahir') == '6' ? "selected" : "" }}>
                                                Juni
                                            </option>
                                            <option value="7" {{ old('bulan_lahir') == '7' ? "selected" : "" }}>
                                                Juli
                                            </option>
                                            <option value="8" {{ old('bulan_lahir') == '8' ? "selected" : "" }}>
                                                Agustus
                                            </option>
                                            <option value="9" {{ old('bulan_lahir') == '9' ? "selected" : "" }}>
                                                September
                                            </option>
                                            <option value="10" {{ old('bulan_lahir') == '10' ? "selected" : "" }}>
                                                OKtober
                                            </option>
                                            <option value="11" {{ old('bulan_lahir') == '11' ? "selected" : "" }}>
                                                November
                                            </option>
                                            <option value="12" {{ old('bulan_lahir') == '12' ? "selected" : "" }}>
                                                Desemeber
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-lg-12">
                                        <label class="control-label">Tahun Lahir</label>
                                        <select name="tahun_lahir" class="form-control">
                                            @for($i=date('Y'); $i>=1950; $i--)
                                                <option value="{{ $i }}" {{ old('tahun_lahir') == $i ? "selected" : "" }}>
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-lg-12">
                                        <label class="control-label">Pekerjaan</label>
                                        <select name="pekerjaan" class="form-control">
                                            <option value="Guru / Dosen Pegawai Negeri" {{ old('pekerjaan') == "Guru / Dosen Pegawai Negeri" ? "selected" : "" }}>
                                                Guru / Dosen Pegawai Negeri
                                            </option>
                                            <option value="Pegawai Negeri Bukan Guru" {{ old('pekerjaan') == "Pegawai Negeri Bukan Guru" ? "selected" : "" }}>
                                                Pegawai Negeri Bukan Guru
                                            </option>
                                            <option value="TNI / Polisi" {{ old('pekerjaan') == "TNI / Polisi" ? "selected" : "" }}>
                                                TNI / Polisi
                                            </option>
                                            <option value="Guru / Dosen Swasta" {{ old('pekerjaan') == "Guru / Dosen Swasta" ? "selected" : "" }}>
                                                Guru / Dosen Swasta
                                            </option>
                                            <option value="Pegawai Swasta" {{ old('pekerjaan') == "Pegawai Swasta" ? "selected" : "" }}>
                                                Pegawai Swasta
                                            </option>
                                            <option value="Wiraswasta" {{ old('pekerjaan') == "Wiraswasta" ? "selected" : "" }}>
                                                Wiraswasta
                                            </option>
                                            <option value="Ahli Profesional" {{ old('pekerjaan') == "Ahli Profesional" ? "selected" : "" }}>
                                                Ahli Profesional
                                            </option>
                                            <option value="Petani" {{ old('pekerjaan') == "Petani" ? "selected" : "" }}>
                                                Petani
                                            </option>
                                            <option value="Pensiunan" {{ old('pekerjaan') == "Pensiunan" ? "selected" : "" }}>
                                                Pensiunan
                                            </option>
                                            <option value="Tidak Bekerja" {{ old('pekerjaan') == "Tidak Bekerja" ? "selected" : "" }}>
                                                Tidak Bekerja
                                            </option>
                                            <option value="Lainnya" {{ old('pekerjaan') == "Lainnya" ? "selected" : "" }}>
                                                Lainnya
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-lg-12">
                                        <label for="">Telepon Rumah</label>
                                        <input type="number" name="nomor_telepon_rumah" value="{{ old('nomor_telepon_rumah') }}" class="form-control" />
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-lg-12 {{$errors->has('nomor_telepon') ? ' has-error' : ''}}">
                                        <label class="control-label">Nomor Handphone *</label>
                                        <input type="number" name="nomor_telepon" class="form-control" value="{{ old('nomor_telepon') }}"/>
                                        @if($errors->has('nomor_telepon'))
                                            <p class="text-danger"><i>{{ $errors->first('nomor_telepon') }}</i></p>
                                        @endif
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-lg-12 {{$errors->has('jenis_kelamin') ? ' has-error' : ''}}">
                                        <label class="control-label">Email *</label>
                                        <input type="text" name="email" class="form-control" value="{{ old('email') }}"/>
                                        @if($errors->has('email'))
                                            <p class="text-danger"><i>{{ $errors->first('email') }}</i></p>
                                        @endif
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-lg-12">
                                        <label for="">Website</label>
                                        <input type="text" name="website" value="{{ old('website') }}" class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-lg-12">
                                        <label for="">Mengenal STMIK BANDUNG</label>
                                        <select name="mengenal_stmik" class="form-control">
                                            <option value="Surat Ke Rumah" {{ old('mengenal_stmik') == "Surat Ke Rumah" ? "selected" : "" }}>
                                                Surat Ke Rumah
                                            </option>
                                            <option value="Spanduk" {{ old('mengenal_stmik') == "Spanduk" ? "selected" : "" }}>
                                                Spanduk
                                            </option>
                                            <option value="Radio" {{ old('mengenal_stmik') == "Wiraswasta" ? "selected" : "" }}>
                                                Radio
                                            </option>
                                            <option value="Koran" {{ old('mengenal_stmik') == "Koran" ? "selected" : "" }}>
                                                Koran
                                            </option>
                                            <option value="Teman" {{ old('mengenal_stmik') == "Teman" ? "selected" : "" }}>
                                                Teman
                                            </option>
                                            <option value="Poster" {{ old('mengenal_stmik') == "Poster" ? "selected" : "" }}>
                                                Poster
                                            </option>
                                            <option value="Lewat Kampus" {{ old('mengenal_stmik') == "Lewat Kampus" ? "selected" : "" }}>
                                                Lewat Kampus
                                            </option>
                                            <option value="Telepon" {{ old('mengenal_stmik') == "Telepon" ? "selected" : "" }}>
                                                Telepon
                                            </option>
                                            <option value="Pameran" {{ old('mengenal_stmik') == "Pameran" ? "selected" : "" }}>
                                                Pameran
                                            </option>
                                            <option value="Presentasi di Sekolah" {{ old('mengenal_stmik') == "Presentasi di Sekolah" ? "selected" : "" }}>
                                                Presentasi di Sekolah
                                            </option>
                                            <option value="Website / Internet" {{ old('mengenal_stmik') == "Website / Internet" ? "selected" : "" }}>
                                                Website / Internet
                                            </option>
                                            <option value="Lainnya" {{ old('mengenal_stmik') == "Lainnya" ? "selected" : "" }}>
                                                Lainnya
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <hr />
                            <h1>Biodata Orang Tua / Wali</h1>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-lg-12 {{$errors->has('nama_ayah') ? ' has-error' : ''}}">
                                        <label class="control-label">Nama Lengkap ayah *</label>
                                        <input type="text" name="nama_ayah" class="form-control" value="{{ old('nama_ayah') }}"/>
                                        @if($errors->has('nama_ayah'))
                                            <p class="text-danger"><i>{{ $errors->first('nama_ayah') }}</i></p>
                                        @endif
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-lg-12">
                                        <label for="">Pekerjaan Ayah</label>
                                        <select name="pekerjaan_ayah" class="form-control">
                                            <option value="Guru / Dosen Pegawai Negeri" {{ old('pekerjaan_ayah') == "Guru / Dosen Pegawai Negeri" ? "selected" : "" }}>
                                                Guru / Dosen Pegawai Negeri
                                            </option>
                                            <option value="Pegawai Negeri Bukan Guru" {{ old('pekerjaan_ayah') == "Pegawai Negeri Bukan Guru" ? "selected" : "" }}>
                                                Pegawai Negeri Bukan Guru
                                            </option>
                                            <option value="TNI / Polisi" {{ old('pekerjaan_ayah') == "TNI / Polisi" ? "selected" : "" }}>
                                                TNI / Polisi
                                            </option>
                                            <option value="Guru / Dosen Swasta" {{ old('pekerjaan_ayah') == "Guru / Dosen Swasta" ? "selected" : "" }}>
                                                Guru / Dosen Swasta
                                            </option>
                                            <option value="Pegawai Swasta" {{ old('pekerjaan_ayah') == "Pegawai Swasta" ? "selected" : "" }}>
                                                Pegawai Swasta
                                            </option>
                                            <option value="Wiraswasta" {{ old('pekerjaan_ayah') == "Wiraswasta" ? "selected" : "" }}>
                                                Wiraswasta
                                            </option>
                                            <option value="Ahli Profesional" {{ old('pekerjaan_ayah') == "Ahli Profesional" ? "selected" : "" }}>
                                                Ahli Profesional
                                            </option>
                                            <option value="Petani" {{ old('pekerjaan_ayah') == "Petani" ? "selected" : "" }}>
                                                Petani
                                            </option>
                                            <option value="Pensiunan" {{ old('pekerjaan_ayah') == "Pensiunan" ? "selected" : "" }}>
                                                Pensiunan
                                            </option>
                                            <option value="Tidak Bekerja" {{ old('pekerjaan_ayah') == "Tidak Bekerja" ? "selected" : "" }}>
                                                Tidak Bekerja
                                            </option>
                                            <option value="Lainnya" {{ old('pekerjaan_ayah') == "Lainnya" ? "selected" : "" }}>
                                                Lainnya
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-lg-12 {{$errors->has('nama_ibu') ? ' has-error' : ''}}">
                                        <label class="control-label">Nama Lengkap Ibu *</label>
                                        <input type="text" name="nama_ibu" class="form-control" value="{{ old('nama_ibu') }}"/>
                                        @if($errors->has('nama_ibu'))
                                            <p class="text-danger"><i>{{ $errors->first('nama_ibu') }}</i></p>
                                        @endif
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-lg-12">
                                        <label for="">Pekerjaan Ibu</label>
                                        <select name="pekerjaan_ibu" class="form-control">
                                            <option value="Guru / Dosen Pegawai Negeri" {{ old('pekerjaan_ibu') == "Guru / Dosen Pegawai Negeri" ? "selected" : "" }}>
                                                Guru / Dosen Pegawai Negeri
                                            </option>
                                            <option value="Pegawai Negeri Bukan Guru" {{ old('pekerjaan_ibu') == "Pegawai Negeri Bukan Guru" ? "selected" : "" }}>
                                                Pegawai Negeri Bukan Guru
                                            </option>
                                            <option value="TNI / Polisi" {{ old('pekerjaan_ibu') == "TNI / Polisi" ? "selected" : "" }}>
                                                TNI / Polisi
                                            </option>
                                            <option value="Guru / Dosen Swasta" {{ old('pekerjaan_ibu') == "Guru / Dosen Swasta" ? "selected" : "" }}>
                                                Guru / Dosen Swasta
                                            </option>
                                            <option value="Pegawai Swasta" {{ old('pekerjaan_ibu') == "Pegawai Swasta" ? "selected" : "" }}>
                                                Pegawai Swasta
                                            </option>
                                            <option value="Wiraswasta" {{ old('pekerjaan_ibu') == "Wiraswasta" ? "selected" : "" }}>
                                                Wiraswasta
                                            </option>
                                            <option value="Ahli Profesional" {{ old('pekerjaan_ibu') == "Ahli Profesional" ? "selected" : "" }}>
                                                Ahli Profesional
                                            </option>
                                            <option value="Petani" {{ old('pekerjaan_ibu') == "Petani" ? "selected" : "" }}>
                                                Petani
                                            </option>
                                            <option value="Pensiunan" {{ old('pekerjaan_ibu') == "Pensiunan" ? "selected" : "" }}>
                                                Pensiunan
                                            </option>
                                            <option value="Tidak Bekerja" {{ old('pekerjaan_ibu') == "Tidak Bekerja" ? "selected" : "" }}>
                                                Tidak Bekerja
                                            </option>
                                            <option value="Lainnya" {{ old('pekerjaan_ibu') == "Lainnya" ? "selected" : "" }}>
                                                Lainnya
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-lg-12 {{$errors->has('alamat_orang_tua') ? ' has-error' : ''}}">
                                        <label class="control-label">Alamat *</label>
                                        <textarea name="alamat_orang_tua" id="" class="form-control" rows="3">{{ old('alamat_orang_tua') }}</textarea>
                                        @if($errors->has('alamat_orang_tua'))
                                            <p class="text-danger"><i>{{ $errors->first('alamat_orang_tua') }}</i></p>
                                        @endif
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-lg-12">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-xs-12">
                                                <label for="">RT</label>
                                                <input type="number" name="rt_orang_tua" class="form-control" value="{{ old('rt_orang_tua') }}" />  
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-xs-12">
                                                <label for="">RW</label>
                                                <input type="number" name="rw_orang_tua" class="form-control" value="{{ old('rw_orang_tua') }}" />  
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-lg-12">
                                        <label for="">Kelurahan</label>
                                        <input type="text" name="kelurahan_orang_tua" class="form-control" value="{{ old('kelurahan_orang_tua') }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-lg-12">
                                        <label for="">Kecamatan</label>
                                        <input type="text" name="Kecamatan_orang_tua" class="form-control" value="{{ old('Kecamatan_orang_tua') }}" />
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-lg-12">
                                        <label for="">Kode Pos</label>
                                        <input type="number" name="kode_pos_orang_tua" class="form-control" value="{{ old('kode_pos_orang_tua') }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-lg-12">
                                        <label for="">Kota / Kabupaten</label>
                                        <input type="text" name="kota_kabupaten_orang_tua" class="form-control" value="{{ old('kota_kabupaten_orang_tua') }}" />
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-lg-12">
                                        <label for="">Provinsi</label>
                                        <input type="text" name="provinsi_orang_tua" class="form-control" value="{{ old('provinsi_orang_tua') }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-lg-12">
                                        <label for="">Telepon Rumah</label>
                                        <input type="number" name="nomor_telepon_rumah_orang_tua" class="form-control" value="{{ old('nomor_telepon_rumah_orang_tua') }}" />
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-lg-12 {{$errors->has('nomor_telepon_orang_tua') ? ' has-error' : ''}}">
                                        <label class="control-label">Nomor Handphone *</label>
                                        <input type="number" name="nomor_telepon_orang_tua" class="form-control" value="{{ old('nomor_telepon_orang_tua') }}" />
                                        @if($errors->has('nomor_telepon_orang_tua'))
                                            <p class="text-danger"><i>{{ $errors->first('nomor_telepon_orang_tua') }}</i></p>
                                        @endif
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-lg-12">
                                        <label for="">Email</label>
                                        <input type="text" name="email_orang_tua" class="form-control" value="{{ old('email_orang_tua') }}" />
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-lg-12">
                                        <label for="">Website</label>
                                        <input type="text" name="website_orang_tua" class="form-control" value="{{ old('website_orang_tua') }}" />
                                    </div>
                                </div>
                            </div>
                            <hr />
                            <h1>Kelengkapan Persyaratan</h1>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-lg-12">
                                        <label for="">Fotocopy Raport Kelas XII</label>
                                        <input type="file" name="fotocopy_raport_kelas_xii" />
                                        <p>
                                            <code>
                                                File harus bertipe [PNG/ JPG/ PDF]
                                            </code>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-lg-12">
                                        <label for="">Fotocopy Ijazah SMA/SMK/Aliyah</label>
                                        <input type="file" name="fotocopy_ijazah_sma" />
                                        <p>
                                            <code>
                                                File harus bertipe [PNG/ JPG/ PDF]
                                            </code>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-lg-12">
                                        <label for="">Foto 3x4</label>
                                        <input type="file" name="foto_3x4" />
                                        <p>
                                            <code>
                                                File harus bertipe [PNG/ JPG/ PDF]
                                            </code>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-lg-12">
                                        <label for="">Foto 4x6</label>
                                        <input type="file" name="foto_4x6" />
                                        <p>
                                            <code>
                                                File harus bertipe [PNG/ JPG/ PDF]
                                            </code>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-lg-12">
                                        <label for="">Surat Keterangan Pindah dari Perguruan Tinggi Asal **</label>
                                        <input type="file" name="surat_keterangan_pindah" />
                                        <p>
                                            <code>
                                                File harus bertipe [PNG/ JPG/ PDF]
                                            </code>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-lg-12">
                                        <label for="">Fotocopy Transkrip Nilai **</label>
                                        <input type="file" name="fotocopy_transkrip_nilai" />
                                        <p>
                                            <code>
                                                File harus bertipe [PNG/ JPG/ PDF]
                                            </code>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-lg-12">
                                        <label for="">Fotocopy Ijazah Perguruan Tinggi Asal **</label>
                                        <input type="file" name="fotocopy_ijazah_perguruan_tinggi_asal" />
                                        <p>
                                            <code>
                                                File harus bertipe [PNG/ JPG/ PDF]
                                            </code>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <hr />
                            <h1>Biaya</h1>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-xs-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-stripped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Komponen Biaya</th>
                                                    @foreach($biaya as $item)
                                                        <th>{{$item->kelas}}</th>
                                                    @endforeach
                                                    <th>Keterangan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Biaya Pendaftaran</td>
                                                    @foreach($biaya as $item)
                                                        <td>
                                                            Rp {{ number_format($item->biaya_pendaftaran,0,',','.') }}
                                                        </td>
                                                    @endforeach
                                                    <td>1x pada kali saat pendaftaran</td>
                                                </tr>
                                                <tr>
                                                    <td>Biaya Jaket & Kemeja</td>
                                                    @foreach($biaya as $item)
                                                        <td>
                                                            Rp {{ number_format($item->biaya_jaket_kemeja,0,',','.') }}
                                                        </td>
                                                    @endforeach
                                                    <td>1x pada kali saat daftar ulang</td>
                                                </tr>
                                                <tr>
                                                    <td>Biaya PSPT</td>
                                                    @foreach($biaya as $item)
                                                        <td>
                                                            Rp {{ number_format($item->biaya_pspt,0,',','.') }}
                                                        </td>
                                                    @endforeach
                                                    <td>1x pada kali saat daftar ulang</td>
                                                </tr>
                                                <tr>
                                                    <td>Biaya Pengembangan Institusi</td>
                                                    @foreach($biaya as $item)
                                                        <td>
                                                            Rp {{ number_format($item->biaya_pengembangan_institusi,0,',','.') }}
                                                        </td>
                                                    @endforeach
                                                    <td>Dapat diangsur 12x (12 Bulan)</td>
                                                </tr>
                                                <tr>
                                                    <td>Biaya Kuliah</td>
                                                    @foreach($biaya as $item)
                                                        <td>
                                                            Rp {{ number_format($item->biaya_kuliah,0,',','.') }}
                                                        </td>
                                                    @endforeach
                                                    <td>Dapat diangsur 3x per semester (40:40:20)</td>
                                                </tr>
                                                <tr>
                                                    <td>Biaya Kemahasiswaan</td>
                                                    @foreach($biaya as $item)
                                                        <td>
                                                            Rp {{ number_format($item->biaya_kemahasiswaan,0,',','.') }}
                                                        </td>
                                                    @endforeach
                                                    <td>1x pada saat daftar ulang</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-xs-12">
                                    <h2>Potongan Biaya Pengembangan</h2>
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-stripped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Keterangan</th>
                                                    <th>Jumlah Potongan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($gelombangTable as $item)
                                                <tr>
                                                    <td>
                                                        {{ $item->nama }} ({{ $item->dari_tanggal->formatLocalized('%B') }} - {{ $item->sampai_tanggal->formatLocalized('%B %Y') }}
                                                    </td>
                                                    <td>
                                                        Rp {{ number_format($item->jumlah_potongan,0,',','.') }}
                                                    </td>
                                                </tr>
                                                @endforeach
                                                <tr>
                                                    <td>Pembayaran lunas mendapat potongan</td>
                                                    <td>5%</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <h3>Waktu Pembayaran</h3>
                                    <ol>
                                        <li>Cicilan ke 1 : Dua minggu setelah pendaftaran / sebelum perkuliahan</li>
                                        <li>Cicilan ke 2 : Sebelum UTS</li>
                                        <li>Cicilan ke 3 : UAS</li>
                                    </ol>
                                </div>
                            </div>
                            <hr />
                            <h2>
                                Simulasi Pembayaran Untuk Cicilan Pertama <br />
                                (Pada Saat Daftar Ulang)
                            </h2>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-xs-12 {{$errors->has('kelas') ? ' has-error' : ''}}">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-xs-12">
                                                <label class="control-label">Kelas *</label>
                                                <select name="kelas" id="kelas" class="form-control">
                                                    <option value="">--- Pilih kelas ---</option>
                                                    @foreach($biaya as $item)
                                                        <option value="{{ $item->id }}" {{ old('kelas') == $item->id ? "selected" : "" }}>
                                                            {{ $item->kelas }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @if($tanggalSekarang <= $gelombang[0]['dari_tanggal'] && $tanggalSekarang >= $gelombang[0]['sampai_tanggal'])
                                                    <input type="hidden" name="gelombang" value="{{$gelombang[0]['kode']}}">
                                                @elseif($tanggalSekarang <= $gelombang[1]['dari_tanggal'] && $tanggalSekarang  >= $gelombang[1]['sampai_tanggal'])
                                                <input type="hidden" name="gelombang" value="{{$gelombang[1]['kode']}}">
                                                @elseif(($tanggalSekarang >= $gelombang[2]['dari_tanggal'] && $tanggalSekarang <= $gelombang[2]['sampai_tanggal']))
                                                <input type="hidden" name="gelombang" value="{{$gelombang[2]['kode']}}">
                                                @endif
                                                @if($errors->has('kelas'))
                                                    <p class="text-danger"><i>{{ $errors->first('kelas') }}</i></p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="kelas-pagi">
                                <div class="col-lg-12 col-md-12 col-xs-12">
                                    <h2>Pembayaran Pada Saat Daftar Ulang</h2>
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-stripped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Komponen Biaya</th>
                                                    <th>Jumlah</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Biaya jaket & kemeja</td>
                                                    <td>
                                                        Rp {{ number_format(350000,0,',','.') }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Biaya PSPT</td>
                                                    <td>
                                                        Rp {{ number_format(500000,0,',','.') }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Biaya Kuliah Cicilan 1 (40%)</td>
                                                    <td>
                                                        Rp {{ number_format(1140000,0,',','.') }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Biaya pengembangan (1/12)</td>
                                                    <td>
                                                        @if($tanggalSekarang <= $gelombang[0]['dari_tanggal'] && $tanggalSekarang >= $gelombang[0]['sampai_tanggal'])
                                                            Rp {{ number_format(round((5000000 - $gelombang[0]['jumlah_potongan'])) / 12,0,',','.') }}
                                                        @elseif($tanggalSekarang <= $gelombang[1]['dari_tanggal'] && $tanggalSekarang  >= $gelombang[1]['sampai_tanggal'])
                                                            Rp {{ number_format(round((5000000 - $gelombang[1]['jumlah_potongan'])) / 12,0,',','.') }}
                                                        @elseif(($tanggalSekarang >= $gelombang[2]['dari_tanggal'] && $tanggalSekarang <= $gelombang[2]['sampai_tanggal']))
                                                            Rp {{ number_format(round((5000000 - $gelombang[2]['jumlah_potongan'])) / 12,0,',','.') }}
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Biaya kemahasiswaan</td>
                                                    <td>
                                                        Rp {{ number_format(300000,0,',','.') }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <center>
                                                            <b>Total</b>
                                                        </center>
                                                    </td>
                                                    <td>
                                                        @if($tanggalSekarang <= $gelombang[0]['dari_tanggal'] && $tanggalSekarang >= $gelombang[0]['sampai_tanggal'])
                                                            Rp {{ number_format(round(350000 + 500000 + 1140000 + 300000 + ((5000000 - $gelombang[0]['jumlah_potongan']) / 12)),0,',','.') }}
                                                        @elseif($tanggalSekarang <= $gelombang[1]['dari_tanggal'] && $tanggalSekarang  >= $gelombang[1]['sampai_tanggal'])
                                                        Rp {{ number_format(round(350000 + 500000 + 1140000 + 300000 + ((5000000 - $gelombang[1]['jumlah_potongan']) / 12)),0,',','.') }}
                                                        @elseif(($tanggalSekarang >= $gelombang[2]['dari_tanggal'] && $tanggalSekarang <= $gelombang[2]['sampai_tanggal']))
                                                        Rp {{ number_format(round(350000 + 500000 + 1140000 + 300000 + ((5000000 - $gelombang[2]['jumlah_potongan']) / 12)),0,',','.') }}
                                                        @endif
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="kelas-sore">
                                <div class="col-lg-12 col-md-12 col-xs-12">
                                    <h2>Pembayaran Pada Saat Daftar Ulang</h2>
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-stripped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Komponen Biaya</th>
                                                    <th>Jumlah</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Biaya jaket & kemeja</td>
                                                    <td>
                                                        Rp {{ number_format(350000,0,',','.') }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Biaya PSPT</td>
                                                    <td>
                                                        Rp {{ number_format(500000,0,',','.') }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Biaya Kuliah Cicilan 1 (40%)</td>
                                                    <td>
                                                        Rp {{ number_format(1280000,0,',','.') }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Biaya pengembangan (1/12)</td>
                                                    <td>
                                                        @if($tanggalSekarang <= $gelombang[0]['dari_tanggal'] && $tanggalSekarang >= $gelombang[0]['sampai_tanggal'])
                                                            Rp {{ number_format(round((5000000 - $gelombang[0]['jumlah_potongan'])) / 12,0,',','.') }}
                                                        @elseif($tanggalSekarang <= $gelombang[1]['dari_tanggal'] && $tanggalSekarang  >= $gelombang[1]['sampai_tanggal'])
                                                            Rp {{ number_format(round((5000000 - $gelombang[1]['jumlah_potongan'])) / 12,0,',','.') }}
                                                        @elseif(($tanggalSekarang >= $gelombang[2]['dari_tanggal'] && $tanggalSekarang <= $gelombang[2]['sampai_tanggal']))
                                                            Rp {{ number_format(round((5000000 - $gelombang[2]['jumlah_potongan'])) / 12,0,',','.') }}
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Biaya kemahasiswaan</td>
                                                    <td>
                                                        Rp {{ number_format(300000,0,',','.') }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <center>
                                                            <b>Total</b>
                                                        </center>
                                                    </td>
                                                    <td>
                                                        @if($tanggalSekarang <= $gelombang[0]['dari_tanggal'] && $tanggalSekarang >= $gelombang[0]['sampai_tanggal'])
                                                            Rp {{ number_format(round(350000 + 500000 + 1280000 + 300000 + ((5000000 - $gelombang[0]['jumlah_potongan']) / 12)),0,',','.') }}
                                                        @elseif($tanggalSekarang <= $gelombang[1]['dari_tanggal'] && $tanggalSekarang  >= $gelombang[1]['sampai_tanggal'])
                                                            Rp {{ number_format(round(350000 + 500000 + 1280000 + 300000 + ((5000000 - $gelombang[1]['jumlah_potongan']) / 12)),0,',','.') }}
                                                        @elseif(($tanggalSekarang >= $gelombang[2]['dari_tanggal'] && $tanggalSekarang <= $gelombang[2]['sampai_tanggal']))
                                                            Rp {{ number_format(round(350000 + 500000 + 1280000 + 300000 + ((5000000 - $gelombang[2]['jumlah_potongan']) / 12)),0,',','.') }}
                                                        @endif
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="kelas-eksekutif">
                                <div class="col-lg-12 col-md-12 col-xs-12">
                                    <h2>Pembayaran Pada Saat Daftar Ulang</h2>
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-stripped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Komponen Biaya</th>
                                                    <th>Jumlah</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Biaya jaket & kemeja</td>
                                                    <td>
                                                        Rp {{ number_format(350000,0,',','.') }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Biaya PSPT</td>
                                                    <td>
                                                        Rp {{ number_format(500000,0,',','.') }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Biaya Kuliah Cicilan 1 (40%)</td>
                                                    <td>
                                                        Rp {{ number_format(1280000,0,',','.') }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Biaya pengembangan (1/12)</td>
                                                    <td>
                                                        @if($tanggalSekarang <= $gelombang[0]['dari_tanggal'] && $tanggalSekarang >= $gelombang[0]['sampai_tanggal'])
                                                            Rp {{ number_format(round((5000000 - $gelombang[0]['jumlah_potongan'])) / 12,0,',','.') }}
                                                        @elseif($tanggalSekarang <= $gelombang[1]['dari_tanggal'] && $tanggalSekarang  >= $gelombang[1]['sampai_tanggal'])
                                                            Rp {{ number_format(round((5000000 - $gelombang[1]['jumlah_potongan'])) / 12,0,',','.') }}
                                                        @elseif(($tanggalSekarang >= $gelombang[2]['dari_tanggal'] && $tanggalSekarang <= $gelombang[2]['sampai_tanggal']))
                                                            Rp {{ number_format(round((5000000 - $gelombang[2]['jumlah_potongan'])) / 12,0,',','.') }}
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Biaya kemahasiswaan</td>
                                                    <td>
                                                        Rp {{ number_format(300000,0,',','.') }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <center>
                                                            <b>Total</b>
                                                        </center>
                                                    </td>
                                                    <td>
                                                        @if($tanggalSekarang <= $gelombang[0]['dari_tanggal'] && $tanggalSekarang >= $gelombang[0]['sampai_tanggal'])
                                                            Rp {{ number_format(round(350000 + 500000 + 1540000 + 300000 + ((5000000 - $gelombang[0]['jumlah_potongan']) / 12)),0,',','.') }}
                                                        @elseif($tanggalSekarang <= $gelombang[1]['dari_tanggal'] && $tanggalSekarang  >= $gelombang[1]['sampai_tanggal'])
                                                            Rp {{ number_format(round(350000 + 500000 + 1540000 + 300000 + ((5000000 - $gelombang[1]['jumlah_potongan']) / 12)),0,',','.') }}
                                                        @elseif(($tanggalSekarang >= $gelombang[2]['dari_tanggal'] && $tanggalSekarang <= $gelombang[2]['sampai_tanggal']))
                                                            Rp {{ number_format(round(350000 + 500000 + 1540000 + 300000 + ((5000000 - $gelombang[2]['jumlah_potongan']) / 12)),0,',','.') }}
                                                        @endif
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <p>
                                <code>*) Perlu diisi</code>
                            </p>
                            <p>
                                <code>**) Untuk mahasiswa pindahan/melanjutkan</code>
                            </p>
                            <p>
                                <code>Rincian biaya akan dijelaskan secara detail oleh kampus</code>
                            </p>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Selesai</button>
                            <button type="reser" class="btn btn-danger"><i class="fa fa-times"></i> Hapus</button>
                        </form>
                        @endif            
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /#wrapper -->
    <!-- jQuery -->
    <script src="/assets/vendor/jquery/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="/assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <!-- Metis Menu Plugin JavaScript -->
    <script src="/assets/vendor/metisMenu/metisMenu.min.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="/assets/dist/js/sb-admin-2.js"></script>
    <script>
        $(document).ready(function(){
            var kelas = $("#kelas option:selected").val();
            $("#kelas-pagi").hide();
            $("#kelas-sore").hide();
            $("#kelas-eksekutif").hide();

            if(kelas == "1"){
                $("#kelas-pagi").show();
                $("#kelas-sore").hide();
                $("#kelas-eksekutif").hide();
            }else if(kelas == "2"){
                $("#kelas-pagi").hide();
                $("#kelas-sore").show();
                $("#kelas-eksekutif").hide();
            }else if(kelas == "3"){
                $("#kelas-pagi").hide();
                $("#kelas-sore").hide();
                $("#kelas-eksekutif").show();
            }

            $("#kelas").change(function(){
                var kelas = $("#kelas option:selected").val();
                if(kelas == "1"){
                    $("#kelas-pagi").show();
                    $("#kelas-sore").hide();
                    $("#kelas-eksekutif").hide();
                }else if(kelas == "2"){
                    $("#kelas-pagi").hide();
                    $("#kelas-sore").show();
                    $("#kelas-eksekutif").hide();
                }else if(kelas == "3"){
                    $("#kelas-pagi").hide();
                    $("#kelas-sore").hide();
                    $("#kelas-eksekutif").show();
                }
            });
        });
    </script>
</body>
</html>
