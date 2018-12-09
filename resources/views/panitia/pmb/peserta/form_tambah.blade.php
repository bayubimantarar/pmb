@extends('panitia.layouts.main')

@section('title')
Panitia &raquo; PMB &raquo; Form Tambah Data Perserta
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Form Tambah Data Peserta</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <ul class="breadcrumb">
            <li><a href="/dosen">Panitia</a></li>
            <li><a href="/dosen/soal">Data Pesert</a></li>
            <li class="active">Form Tambah Data Peserta</li>
        </ul>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Form Data Peserta
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        @if($total == 0)
                            <p><i> Peserta ujian sudah sesuai jumlah jika ingin menambah peserta silahkan ubah jumlah peserta pada data jadwal ujian</i></p>
                        @else
                            <form action="/panitia/pmb/peserta-ujian/{{$kodeJadwalUjian}}/simpan" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="total" value="{{$total}}" />
                                @for($a=0; $a<$total; $a++)
                                <h1>
                                    Peserta Ke {{$nomorPeserta++}}
                                </h1>
                                <hr />
                                <h1>Status dan pilihan</h1>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-5 col-lg-12">
                                            <label>Gelombang *</label>
                                            <input type="text" name="kode_gelombang[]" class="form-control" value="{{$peserta->nama_gelombang}}" readonly />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-5 col-lg-12 {{$errors->has('status_pendaftaran.'.$a) ? ' has-error' : ''}}">
                                            <label>Pendaftaran *</label>
                                            @if($peserta->status_pendaftaran == "Baru")
                                                <input type="text" name="status_pendaftaran[]" class="form-control" value="Baru" readonly />
                                            @elseif($peserta->status_pendaftaran == "Mengulang")
                                                <input type="text" name="status_pendaftaran[]" class="form-control" value="Mengulang" readonly />
                                            @endif
                                            @if($errors->has('status_pendaftaran.'.$a))
                                                <p class="text-danger"><i>{{ $errors->first('status_pendaftaran.'.$a) }}</i></p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-lg-12 {{$errors->has('status.'.$a) ? ' has-error' : ''}}">
                                            <label>Status Calon Mahasiswa *</label>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="status[{{$a}}]" value="baru" {{ old('status.'.$a) == "baru" ? "checked" : "" }}/> Baru
                                                </label>
                                                <label>
                                                    <input type="radio" name="status[{{$a}}]" value="pindahan" {{ old('status.'.$a) == "pindahan" ? "checked" : "" }}/> Pindahan
                                                </label>
                                            </div>
                                            @if($errors->has('status.'.$a))
                                                <p class="text-danger"><i>{{ $errors->first('status.'.$a) }}</i></p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-5 col-lg-12">
                                            <label>Daftar Melalui *</label>
                                            <select name="kode_potongan[]" class="form-control">
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
                                            <label for="">Asal Sekolah / Perguruan Tinggi</label>
                                            <input type="text" class="form-control" name="asal_sekolah[]" value="{{ old('asal_sekolah') }}" />
                                        </div>
                                        <div class="col-lg-5 col-md-5 col-lg-12">
                                            <label for="">Jurusan</label>
                                            <input type="text" class="form-control" name="asal_jurusan[]" value="{{ old('asal_jurusan') }}" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-5 col-lg-12 {{$errors->has('jurusan.'.$a) ? ' has-error' : ''}}">
                                            <label for="">Jurusan Pilihan *</label>
                                            <input type="text" name="kode_jurusan[]" class="form-control" value="{{$peserta->nama_jurusan}}" readonly />
                                            @if($errors->has('jurusan.'.$a))
                                                <p class="text-danger"><i>{{ $errors->first('jurusan.'.$a) }}</i></p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-xs-12">
                                            <label class="control-label">Kelas *</label>
                                            <select name="kode_kelas[]" class="form-control">
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
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-lg-12">
                                            <label class="control-label">Nama Lengkap *</label>
                                            <input type="text" name="nama[]" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group {{$errors->has('jenis_kelamin.'.$a) ? ' has-error' : ''}}">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-lg-12">
                                            <label for="" class="control-label">Jenis Kelamin *</label>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="jenis_kelamin[{{$a}}]" value="1" {{ old('jenis_kelamin') == "1" ? "checked" : "" }}/> Laki-laki
                                                </label>
                                                <label>
                                                    <input type="radio" name="jenis_kelamin[{{$a}}]" value="2" {{ old('jenis_kelamin') == "2" ? "checked" : "" }}/> Perempuan
                                                </label>
                                            </div>
                                            @if($errors->has('jenis_kelamin.'.$a))
                                                <p class="text-danger"><i>{{ $errors->first('jenis_kelamin.'.$a) }}</i></p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-lg-12 {{$errors->has('alamat.'.$a) ? ' has-error' : ''}}">
                                            <label class="control-label">Alamat *</label>
                                            <textarea name="alamat[]" id="" class="form-control" rows="5">{{ old('alamat.'.$a) }}</textarea>
                                            @if($errors->has('alamat.'.$a))
                                                <p class="text-danger"><i>{{ $errors->first('alamat.'.$a) }}</i></p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-lg-12 {{$errors->has('kota_lahir.'.$a) ? ' has-error' : ''}}">
                                            <label for="">Kota Kelahiran *</label>
                                            <input type="text" name="kota_lahir[]" value="{{ old('kota_lahir.'.$a) }}" class="form-control" />
                                            @if($errors->has('kota_lahir.'.$a))
                                                <p class="text-danger"><i>{{ $errors->first('kota_lahir.'.$a) }}</i></p>
                                            @endif
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-lg-12">
                                            <label class="control-label">Tanggal Lahir</label>
                                            <select name="tanggal_lahir[]" class="form-control">
                                                @for($i=1; $i<=31; $i++)
                                                    <option value="{{ $i }}" {{ old('tanggal_lahir') == $i ? "selected" : "" }}>
                                                        {{ $i }}
                                                    </option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-lg-12">
                                            <label class="control-label">Bulan Lahir</label>
                                            <select name="bulan_lahir[]" class="form-control">
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
                                            <select name="tahun_lahir[]" class="form-control">
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
                                            <select name="pekerjaan[]" class="form-control">
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
                                            <input type="number" name="nomor_telepon_rumah[]" value="{{ old('nomor_telepon_rumah') }}" class="form-control" />
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-lg-12 {{$errors->has('nomor_telepon.'.$a) ? ' has-error' : ''}}">
                                            <label class="control-label">Nomor Handphone *</label>
                                            <input type="number" name="nomor_telepon[]" class="form-control" value="{{ old('nomor_telepon') }}"/>
                                            @if($errors->has('nomor_telepon.'.$a))
                                                <p class="text-danger"><i>{{ $errors->first('nomor_telepon.'.$a) }}</i></p>
                                            @endif
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-lg-12 {{$errors->has('email.'.$a) ? ' has-error' : ''}}">
                                            <label class="control-label">Email *</label>
                                            <input type="text" name="email[]" class="form-control" value="{{ old('email.'.$a) }}"/>
                                            @if($errors->has('email.'.$a))
                                                <p class="text-danger"><i>{{ $errors->first('email.'.$a) }}</i></p>
                                            @endif
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-lg-12">
                                            <label for="">Website</label>
                                            <input type="text" name="website[]" value="{{ old('website') }}" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-lg-12">
                                            <label for="">Mengenal STMIK BANDUNG</label>
                                            <select name="mengenal_stmik[{{$a}}]" class="form-control">
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
                                <h1>Kelengkapan Persyaratan</h1>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-lg-12">
                                            <label for="">Foto 4x6</label>
                                            <input type="file" name="foto_4x6[]" />
                                            <p>
                                                <code>
                                                    File harus bertipe [PNG/ JPG/ JPEG]
                                                </code>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <hr />
                                @endfor
                                <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Simpan</button>
                                <a href="/panitia/pmb/formulir" class="btn btn-default"><i class="fa fa-times"></i> Batal</a>
                            </form>
                        @endif
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
