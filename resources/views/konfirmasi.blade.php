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
            <div class="col-lg-6 col-lg-offset-3 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Konfirmasi Pembayaran
                    </div>
                    <div class="panel-body">
                        @if(session('notification'))
                            <div class="alert alert-success">
                                {{ session('notification') }}
                            </div>
                        @endif
                        <form action="/konfirmasi-pembayaran/simpan" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group {{ $errors->has('nama') ? ' has-error' : '' }}">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                        <label class="control-label">Nama Lengkap *</label>
                                        <input type="text" class="form-control" name="nama" value="{{ old('nama') }}" />
                                        @if($errors->has('nama'))
                                            <p class="text-danger">
                                                <i>{{ $errors->first('nama') }}</i>
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('nomor_telepon') ? ' has-error' : '' }}">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                        <label class="control-label">Nomor Telepon *</label>
                                        <input type="number" class="form-control" name="nomor_telepon" value="{{ old('nomor_telepon') }}"/>
                                        @if($errors->has('nomor_telepon'))
                                            <p class="text-danger">
                                                <i>{{ $errors->first('nomor_telepon') }}</i>
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                        <label class="control-label">Email *</label>
                                        <input type="text" class="form-control" name="email" value="{{ old('email') }}"/>
                                        @if($errors->has('email'))
                                            <p class="text-danger">
                                                <i>{{ $errors->first('email') }}</i>
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('alamat') ? ' has-error' : '' }}">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                        <label class="control-label">Alamat *</label>
                                        <textarea name="alamat" class="form-control" cols="30" rows="5">{{ old('alamat') }}</textarea>
                                        @if($errors->has('alamat'))
                                            <p class="text-danger">
                                                <i>{{ $errors->first('alamat') }}</i>
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group {{$errors->has('tanggal_pembayaran') ? ' has-error' : ''}}">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                        <label class="control-label">Tanggal Pembayaran *</label>
                                        <div class="input-group date" id="tanggal-bayar">
                                            <input type="text" name="tanggal_pembayaran" class="form-control" value="{{ old('tanggal_pembayaran') }}" />
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                        @if($errors->has('tanggal_pembayaran'))
                                            <p class="text-danger">
                                                <i>{{ $errors->first('tanggal_pembayaran') }}</i>
                                            </p>
                                        @endif  
                                    </div>
                                </div>
                            </div>
                            <div class="form-group {{$errors->has('jumlah_pembayaran') ? ' has-error' : ''}}">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                        <label class="control-label">Jumlah Pembayaran *</label>
                                        <input type="number" name="jumlah_pembayaran" value="{{ old('jumlah_pembayaran') }}" class="form-control" />
                                        @if($errors->has('jumlah_pembayaran'))
                                            <p class="text-danger">
                                                <i>{{ $errors->first('jumlah_pembayaran') }}</i>
                                            </p>
                                        @endif  
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                        <label class="control-label">BANK Tujuan</label>
                                        <select name="bank_tujuan" class="form-control" id="">
                                            <option value="mandiri">Mandiri</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group {{$errors->has('nama_rekening_pengirim') ? ' has-error' : ''}}">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                        <label class="control-label">Nama Rekening Pengirim *</label>
                                        <input type="text" name="nama_rekening_pengirim" value="{{ old('nama_rekening_pengirim') }}" class="form-control" />
                                        @if($errors->has('nama_rekening_pengirim'))
                                            <p class="text-danger">
                                                <i>{{ $errors->first('nama_rekening_pengirim') }}</i>
                                            </p>
                                        @endif  
                                    </div>
                                </div>
                            </div>
                            <div class="form-group {{$errors->has('bukti_transaksi') ? ' has-error' : ''}}">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                        <label class="control-label">Bukti Transaksi (Opsional)</label>
                                        <input type="file" name="bukti_transaksi" />
                                        <p>
                                            <code>
                                                Maksimal 2MB (JPG, PNG, GIF & PDF)
                                            </code>
                                        </p>
                                        @if($errors->has('bukti_transaksi'))
                                            <p class="text-danger">
                                                <i>{{ $errors->first('bukti_transaksi') }}</i>
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <p>
                                <b>Pastikan nomor telepon, email, dan alamat aktif dan bisa dihubungi.</b> <br />
                                *) Perlu diisi
                            </p>
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-paper-plane-o"></i> Selesai
                            </button>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/locale/id.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
    <script>
        $('#tanggal-bayar').datetimepicker({
            locale: 'id',
            format:'DD-MM-YYYY',
        });
    </script>
</body>
</html>
