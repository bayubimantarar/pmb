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
                        Pendaftaran
                    </div>
                    <div class="panel-body">
                        @if(session('notification'))
                            <div class="alert alert-success">
                                {{ session('notification') }}
                            </div>
                        @endif
                        <form action="/pendaftaran/simpan" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group {{ $errors->has('nama') ? ' has-error' : '' }}">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                        <label class="control-label">Nama Lengkap *</label>
                                        <input type="text" class="form-control" name="nama" />
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
                                        <input type="number" class="form-control" name="nomor_telepon" />
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
                                        <input type="text" class="form-control" name="email" />
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
                                        <textarea name="alamat" class="form-control" id="" cols="30" rows="5"></textarea>
                                        @if($errors->has('alamat'))
                                            <p class="text-danger">
                                                <i>{{ $errors->first('alamat') }}</i>
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <p>
                                <b>Pastikan nomor telepon, email, dan alamat aktif dan bisa dihubungi.</b> <br />
                                *) Perlu diisi
                            </p>
                            <p>
                                <code>
                                    Pendaftaran akan dikenakan biaya Rp 250.000,-
                                </code>
                            </p>
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-check"></i> Selesai
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
</body>
</html>
