<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Login Dasbor | Ujian Online STMIK Bandung</title>
    <!-- Bootstrap Core CSS -->
    <link href="/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- MetisMenu CSS -->
    <link href="/assets/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="/assets/dist/css/sb-admin-2.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="/assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Login Dasbor</h3>
                    </div>
                    <div class="panel-body">
                        <div class="panel-group" id="accordion">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">#Tata Cara Penggunaan Aplikasi</a>
                                    </h4>
                                </div>
                                <div id="collapseOne" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <ul class="timeline">
                                            <li>
                                                <div class="timeline-badge"><i class="fa fa-sign-in"></i>
                                                </div>
                                                <div class="timeline-panel">
                                                    <div class="timeline-heading">
                                                        <h4 class="timeline-title"><b>Masuk Ke Aplikasi</b></h4>
                                                    </div>
                                                    <div class="timeline-body">
                                                        <small>Masuk menggunakan email dan password masing-masing pengguna</small>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="timeline-inverted">
                                                <div class="timeline-badge primary"><i class="fa fa-dashboard"></i>
                                                </div>
                                                <div class="timeline-panel">
                                                    <div class="timeline-heading">
                                                        <h4 class="timeline-title"><b>Kelola Data</b></h4>
                                                    </div>
                                                    <div class="timeline-body">
                                                        <small>Kelola semua data pada dasbor, disana tersedia menu-menu data yang bisa dikelola oleh pengguna</small>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form action="/dasbor/autentikasi/login" method="post">
                            @if($errors->has('notification'))
                                <p class="text-danger">{{ $errors->first('notification') }}</p>
                            @endif
                            @csrf
                            <fieldset>
                                <div class="form-group {{$errors->has('email') ? ' has-error' : ''}}">
                                    <label class="label-control">Email</label>
                                    <input class="form-control" placeholder="Email" name="email" type="email" autofocus>
                                    @if($errors->has('email'))
                                        <p class="text-danger"><i>{{ $errors->first('email') }}</i></p>
                                    @endif
                                </div>
                                <div class="form-group {{$errors->has('password') ? ' has-error' : ''}}">
                                    <label class="label-control">Password</label>
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                    @if($errors->has('password'))
                                        <p class="text-danger"><i>{{ $errors->first('password') }}</i></p>
                                    @endif
                                </div>
                                <button type="submit" class="btn btn-lg btn-primary btn-block"><i class="fa fa-sign-in"></i> Masuk</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
