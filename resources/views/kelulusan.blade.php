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
    <link rel="stylesheet" href="/assets/vendor/jquery-confirm-master/dist/jquery-confirm.min.css" />
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
            <div class="col-lg-12 col-md-12 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Data diri
                    </div>
                    <div class="panel-body">
                        @if(session('notification'))
                            <div class="alert alert-success">
                                {{ session('notification') }}
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-xs-12">
                                <p>KODE PENDAFTARAN : {{$kodePendaftaran}}</p>
                                <p>NAMA : {{$nama}}</p>
                                <p>TEMPAT LAHIR : {{$kotaLahir}}</p>
                                <p>TANGGAL LAHIR : {{$bulan}}, {{$tanggal}} {{$tahun}}</p>
                                <p>TANGGAL MULAI UJIAN : {{$tanggalMulaiUjian}}</p>
                                <p>TANGGAL SELESAI UJIAN : {{$tanggalSelesaiUjian}}</p>
                                <p>RUANGAN : {{$ruangan}}</p>
                                <p>NILAI UJIAN : {{$nilai}}</p>
                                <p>STATUS : LULUS</p>
                            </div>
                            <div class="col-lg-6 col-md-6 col-xs-12">
                                @if(!empty($foto4x6))
                                <center><img src="/uploads/pmb/pendaftaran/kelengkapan/{{$foto4x6}}" alt="Foto 4x6" height="150" /></center>
                                @endif
                            </div>
                        </div>
                        <br />
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
    <script src="/assets/vendor/jquery-confirm-master/dist/jquery-confirm.min.js"></script>
<script>
function startExam(){
    $.confirm({
    title: 'Cek kehadiran',
    content: '' +
    '<form action="" class="formName">' +
    '<div class="form-group">' +
    '<input type="number" placeholder="NIDN" class="nidn form-control" required /> <br />' +
    '<input type="hidden" class="kodePendaftaran" value="{{ $encryptKodePendaftaran }}" />' +
    '<input type="hidden" class="token" value="{{ csrf_token() }}" />' +
    '</div>' +
    '</form>',
    buttons: {
        formSubmit: {
            text: 'Cari',
            btnClass: 'btn-blue',
            action: function () {
                var nidn = this.$content.find('.nidn').val();
                var token = this.$content.find('.token').val();
                var kodePendaftaran = this.$content.find('.kodePendaftaran').val();
                if(!nidn){
                    $.alert('NIDN perlu diisi');
                    return false;
                }
                $.ajax({
                    url : '/kehadiran/'+kodePendaftaran+'/cek-panitia/'+nidn,
                    type: 'get',
                    success: function(result){
                        if(result.total == 1){
                            $.confirm({
                                title: 'Cek kehadiran',
                                content: 'Peserta ditemukan, silahkan cek kehadiran.',
                                buttons: {
                                    cek: {
                                        btnClass: 'btn-blue',
                                        action: function(){
                                            $.ajax({
                                                url: "/kehadiran/"+kodePendaftaran+"/simpan",
                                                type: "post",
                                                data: {_token: token, kode_pendaftaran: kodePendaftaran},
                                                dataType: "json",
                                                success: function(result){
                                                    if(result.created == 1){
                                                        if($.alert('Cek kehadiran berhasil!')){
                                                            window.location.replace('/kehadiran/'+kodePendaftaran);
                                                        }
                                                    }
                                                }
                                            })
                                        },
                                    },
                                    batal: {
                                        action: function(){

                                        },
                                    }
                                }
                            });
                        }else{
                            $.alert('Panitia tidak ditemukan!.');
                        }
                    }
                })
            }
        },
        batal: function () {
            //close
        },
    },
    onContentReady: function () {
        // bind to events
        var jc = this;
        this.$content.find('form').on('submit', function (e) {
            // if the user submits the form by pressing enter in the field.
            e.preventDefault();
            jc.$$formSubmit.trigger('click'); // reference the button and click it
        });
    }
});
}
</script>
</body>
</html>
