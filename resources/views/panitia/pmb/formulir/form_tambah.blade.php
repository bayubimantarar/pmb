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
                        <form action="/panitia/pmb/formulir/simpan" method="post" enctype="multipart/form-data">
                            @csrf
                            <h1>Status dan pilihan</h1>
                            @foreach ($errors->all() as $error) <div>{{ $error }}</div> @endforeach
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-lg-12 {{$errors->has('status_pendaftaran') ? ' has-error' : ''}}">
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
                                    <div class="col-lg-5 col-md-5 col-lg-12">
                                        <label>Daftar Melalui *</label>
                                        <select name="kode_potongan" class="form-control">
                                            @foreach($potongan as $item)
                                                <option value="{{ $item->id }}">{{ $item->deskripsi }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-5 col-md-5 col-lg-12">
                                        <label>Gelombang *</label>
                                        <select name="kode_gelombang" class="form-control">
                                            @foreach($gelombang as $item)
                                                <option value="{{ $item->kode }}">{{ $item->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-5 col-md-5 col-lg-12">
                                        <label for="">Asal Sekolah / Perguruan Tinggi</label>
                                        <input type="text" class="form-control" name="asal_sekolah" value="{{ old('asal_sekolah') }}" />
                                    </div>
                                    <div class="col-lg-5 col-md-5 col-lg-12">
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
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-xs-12">
                                        <label class="control-label">Kelas *</label>
                                        <select name="kelas" class="form-control">
                                            @foreach($biaya as $item)
                                                <option value="{{ $item->id }}" {{ old('kelas') == $item->id ? "selected" : "" }}>
                                                    {{ $item->kelas }}
                                                </option>
                                            @endforeach
                                        </select>
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
                                        <input type="text" name="kecamatan" value="{{ old('kecamatan') }}" class="form-control" />
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
                                                Oktober
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
                                        <input type="text" name="kecamatan_orang_tua" class="form-control" value="{{ old('kecamatan_orang_tua') }}" />
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
                            <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Simpan</button>
                            <a href="/panitia/pmb/formulir" class="btn btn-default"><i class="fa fa-times"></i> Batal</a>
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
