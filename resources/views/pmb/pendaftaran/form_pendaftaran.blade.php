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
                        <form action="/pmb/pendaftaran/simpan" method="post" enctype="multipart/form-data">
                            @csrf
                            <h1>Status dan pilihan</h1>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-lg-12">
                                        <label for="">Status Calon Mahasiswa *</label>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="status" value="option1" /> Baru
                                            </label>
                                            <label>
                                                <input type="radio" name="status" value="option2" /> Pindahan
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-lg-12">
                                        <label for="">Asal Sekolah / Perguruan Tinggi</label>
                                        <input type="text" class="form-control" name="asal_sekolah" />
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-lg-12">
                                        <label for="">Jurusan</label>
                                        <input type="text" class="form-control" name="asal_jurusan" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-lg-12">
                                        <label for="">Jurusan Pilihan *</label>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="jurusan" value="IF" /> Teknik Informatika
                                            </label>
                                            <label>
                                                <input type="radio" name="jurusan" value="SI" /> Sistem Informasi
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr />
                            <h1>Biodata calon mahasiswa</h1>
                            <div class="form-group {{$errors->has('nama') ? ' has-error' : ''}}">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-lg-12">
                                        <label class="control-label">Nama Lengkap *</label>
                                        <input type="text" name="nama" class="form-control" />
                                        @if($errors->has('nama'))
                                            <p class="text-danger"><i>{{ $errors->first('nama') }}</i></p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-lg-12">
                                        <label for="">Jenis Kelamin *</label>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="jenis_kelamin" value="1" /> Laki-laki
                                            </label>
                                            <label>
                                                <input type="radio" name="jenis_kelamin" value="2" /> Perempuan
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-lg-12">
                                        <label for="">Alamat</label>
                                        <textarea name="" id="" class="form-control" rows="3"></textarea>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-lg-12">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-xs-12">
                                                <label for="">RT</label>
                                                <input type="number" name="rt" class="form-control" />  
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-xs-12">
                                                <label for="">RW</label>
                                                <input type="number" name="rw" class="form-control" />  
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-lg-12">
                                        <label for="">Kelurahan</label>
                                        <input type="text" name="kelurahan" class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-lg-12">
                                        <label for="">Kecamatan</label>
                                        <input type="text" name="Kecamatan" class="form-control" />
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-lg-12">
                                        <label for="">Kode Pos</label>
                                        <input type="number" name="kode_pos" class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-lg-12">
                                        <label for="">Kota / Kabupaten</label>
                                        <input type="text" name="kota_kabupaten" class="form-control" />
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-lg-12">
                                        <label for="">Provinsi</label>
                                        <input type="text" name="provinsi" class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-lg-12">
                                        <label for="">Pekerjaan</label>
                                        <select name="pekerjaan" class="form-control">
                                            <option value="Guru / Dosen Pegawai Negeri">Guru / Dosen Pegawai Negeri</option>
                                            <option value="Pegawai Negeri Bukan Guru">Pegawai Negeri Bukan Guru</option>
                                            <option value="TNI / Polisi">TNI / Polisi</option>
                                            <option value="Guru / Dosen Swasta">Guru / Dosen Swasta</option>
                                            <option value="Pegawai Swasta">Pegawai Swasta</option>
                                            <option value="Wiraswasta">Wiraswasta</option>
                                            <option value="Ahli Profesional">Ahli Profesional</option>
                                            <option value="Petani">Petani</option>
                                            <option value="Pensiunan">Pensiunan</option>
                                            <option value="Tidak Bekerja">Tidak Bekerja</option>
                                            <option value="Lainnya">Lainnya</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-lg-12">
                                        <label for="">Telepon Rumah</label>
                                        <input type="number" name="nomor_telepon_rumah" class="form-control" />
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-lg-12">
                                        <label for="">Nomor Handphone</label>
                                        <input type="number" name="nomor_telepon" class="form-control" />
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-lg-12">
                                        <label for="">Email</label>
                                        <input type="text" name="email" class="form-control" />
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-lg-12">
                                        <label for="">Website</label>
                                        <input type="text" name="website" class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-lg-12">
                                        <label for="">Mengenal STMIK BANDUNG</label>
                                        <select name="mengenal_stmik" class="form-control">
                                            <option value="Surat Ke Rumah">Surat Ke Rumah</option>
                                            <option value="Spanduk">Spanduk</option>
                                            <option value="Radio">Radio</option>
                                            <option value="Koran">Koran</option>
                                            <option value="Teman">Teman</option>
                                            <option value="Poster">Poster</option>
                                            <option value="Lewat Kampus">Lewat Kampus</option>
                                            <option value="Telepon">Telepon</option>
                                            <option value="Pameran">Pameran</option>
                                            <option value="Presentasi di Sekolah">Presentasi di Sekolah</option>
                                            <option value="Website / Internet">Website / Internet</option>
                                            <option value="Lainnya">Lainnya</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <hr />
                            <h1>Biodata Orang Tua / Wali</h1>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-lg-12">
                                        <label for="">Nama Lengkap ayah</label>
                                        <input type="text" name="nama_ayah" class="form-control" />
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-lg-12">
                                        <label for="">Pekerjaan Ayah</label>
                                        <select name="pekerjaan_ayah" class="form-control">
                                            <option value="Guru / Dosen Pegawai Negeri">Guru / Dosen Pegawai Negeri</option>
                                            <option value="Pegawai Negeri Bukan Guru">Pegawai Negeri Bukan Guru</option>
                                            <option value="TNI / Polisi">TNI / Polisi</option>
                                            <option value="Guru / Dosen Swasta">Guru / Dosen Swasta</option>
                                            <option value="Pegawai Swasta">Pegawai Swasta</option>
                                            <option value="Wiraswasta">Wiraswasta</option>
                                            <option value="Ahli Profesional">Ahli Profesional</option>
                                            <option value="Petani">Petani</option>
                                            <option value="Pensiunan">Pensiunan</option>
                                            <option value="Tidak Bekerja">Tidak Bekerja</option>
                                            <option value="Lainnya">Lainnya</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-lg-12">
                                        <label for="">Nama Lengkap Ibu</label>
                                        <input type="text" name="nama_ibu" class="form-control" />
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-lg-12">
                                        <label for="">Pekerjaan Ibu</label>
                                        <select name="pekerjaan_ibu" class="form-control">
                                            <option value="Guru / Dosen Pegawai Negeri">Guru / Dosen Pegawai Negeri</option>
                                            <option value="Pegawai Negeri Bukan Guru">Pegawai Negeri Bukan Guru</option>
                                            <option value="TNI / Polisi">TNI / Polisi</option>
                                            <option value="Guru / Dosen Swasta">Guru / Dosen Swasta</option>
                                            <option value="Pegawai Swasta">Pegawai Swasta</option>
                                            <option value="Wiraswasta">Wiraswasta</option>
                                            <option value="Ahli Profesional">Ahli Profesional</option>
                                            <option value="Petani">Petani</option>
                                            <option value="Pensiunan">Pensiunan</option>
                                            <option value="Tidak Bekerja">Tidak Bekerja</option>
                                            <option value="Lainnya">Lainnya</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-lg-12">
                                        <label for="">Alamat</label>
                                        <textarea name="alamat_orang_tua" id="" class="form-control" rows="3"></textarea>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-lg-12">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-xs-12">
                                                <label for="">RT</label>
                                                <input type="number" name="rt_orang_tua" class="form-control" />  
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-xs-12">
                                                <label for="">RW</label>
                                                <input type="number" name="rw_orang_tua" class="form-control" />  
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-lg-12">
                                        <label for="">Kelurahan</label>
                                        <input type="text" name="kelurahan_orang_tua" class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-lg-12">
                                        <label for="">Kecamatan</label>
                                        <input type="text" name="Kecamatan_orang_tua" class="form-control" />
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-lg-12">
                                        <label for="">Kode Pos</label>
                                        <input type="number" name="kode_pos_orang_tua" class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-lg-12">
                                        <label for="">Kota / Kabupaten</label>
                                        <input type="text" name="kota_kabupaten_orang_tua" class="form-control" />
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-lg-12">
                                        <label for="">Provinsi</label>
                                        <input type="text" name="provinsi_orang_tua" class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-lg-12">
                                        <label for="">Telepon Rumah</label>
                                        <input type="number" name="nomor_telepon_rumah_orang_tua" class="form-control" />
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-lg-12">
                                        <label for="">Nomor Handphone</label>
                                        <input type="number" name="nomor_telepon_orang_tua" class="form-control" />
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-lg-12">
                                        <label for="">Email</label>
                                        <input type="text" name="email_orang_tua" class="form-control" />
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-lg-12">
                                        <label for="">Website</label>
                                        <input type="text" name="website_orang_tua" class="form-control" />
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
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-lg-12">
                                        <label for="">Fotocopy Ijazah SMA/SMK/Aliyah</label>
                                        <input type="file" name="fotocopy_ijazah_sma" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-lg-12">
                                        <label for="">Foto 3x4, 4x6</label>
                                        <input type="file" name="foto_tigakali" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-lg-12">
                                        <label for="">Surat Keterangan Pindah dari Perguruan Tinggi Asal **</label>
                                        <input type="file" name="surat_keterangan_pindah" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-lg-12">
                                        <label for="">Fotocopy Transkrip Nilai **</label>
                                        <input type="file" name="fotocopy_transkrip_nilai" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-lg-12">
                                        <label for="">Fotocopy Ijazah Perguruan Tinggi Asal **</label>
                                        <input type="file" name="fotocopy_ijzaha_perguruan_tinggi" />
                                    </div>
                                </div>
                            </div>
                            <hr />
                            <p>
                                *) Perlu diisi <br />
                                **) Untuk mahasiswa pindahan/melanjutkan
                            </p>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Selesai</button>
                        </form>                  
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
</body>
</html>
