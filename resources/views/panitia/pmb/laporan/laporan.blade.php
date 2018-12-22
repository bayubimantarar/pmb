@extends('panitia.layouts.main')

@section('title')
Panitia &raquo; PMB &raquo; Data laporan
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Data laporan</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- .row -->
<div class="row">
    <div class="col-lg-12">
        <ul class="breadcrumb">
            <li><a href="/prodi">Panitia</a></li>
            <li class="active">PMB</li>
            <li class="active">Data laporan</li>
        </ul>
    </div>
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-md-12">
                <h3>Filter laporan</h3>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-xs-12">
                            <select name="" id="tahun" class="form-control">
                                <option value="null">Tahun</option>
                                @for($i=date('Y'); $i>=1950; $i--)
                                    <option value="{{ $i }}">
                                        {{ $i }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <br />
                    <p>
                        <a href="#cetak" id="cetak" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Cetak laporan</a><br />
                        <input type="hidden" name="tahun" id="temp_tahun" />
                        <code>
                            Laporan dicetak sesuai filter
                        </code>
                    </p>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                Tabel Data laporan
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="laporan-table">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Jurusan</th>
                                <th>Tahun</th>
                                <th>Sesi</th>
                                <th>Pendaftaran</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                    </table>
                    <!-- /.table-responsive -->
                </div>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="row">
    <div class="col-lg-12 col-md-12 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Grafik Laporan
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div id="morris-bar-chart"></div>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
</div>
<!-- /.row -->
@endsection

@push('css')
    <!-- DataTables CSS -->
    <link href="/assets/vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">
    <!-- DataTables Responsive CSS -->
    <link href="/assets/vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">
@endpush

@push('js')
    <!-- DataTables JavaScript -->
    <script src="/assets/vendor/raphael/raphael.min.js"></script>
    <script src="/assets/vendor/morrisjs/morris.min.js"></script>
    <script src="/assets/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="/assets/vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="/assets/vendor/datatables-responsive/dataTables.responsive.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/locale/id.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
    <script>
        $('#tanggal').datetimepicker({
            locale: 'id',
            format:'DD-MM-YYYY'
        });

        $.ajax({
            url: '/panitia/pmb/laporan/grafik',
            type: 'get',
            dataType: 'json',
            success: function(result){
                console.log(result);
                Morris.Bar({
                    element: 'morris-bar-chart',
                    data: [
                        {
                            jurusan: 'Teknik Informatika',
                            lulus: result.if_lulus,
                            tidak_lulus: result.if_tidak_lulus
                        },
                        {
                            jurusan: 'Sistem Informasi',
                            lulus: result.si_lulus,
                            tidak_lulus: result.si_tidak_lulus
                        }
                    ],
                    xkey: 'jurusan',
                    ykeys: ['lulus', 'tidak_lulus'],
                    labels: ['Lulus', 'Tidak Lulus'],
                    hideHover: 'auto',
                    resize: true
                });
            }
        });

        var laporan_table = $("#laporan-table").DataTable({
            serverSide: true,
            processing: true,
            ajax: '/panitia/pmb/laporan/data',
            columns: [
                {data: 'nama'},
                {data: 'jurusan'},
                {data: 'tahun'},
                {data: 'sesi'},
                {data: 'status_pendaftaran'},
                {data: 'status'},
                {data: 'created_at'}
            ]
        });

        $("#tahun").change(function(){
            laporan_table.destroy();
            var tahun = $("#tahun").val();
            $("#temp_tahun").val(tahun);

            laporan_table = $("#laporan-table").DataTable({
                serverSide: true,
                processing: true,
                ajax: '/panitia/pmb/laporan/filter/tahun/'+tahun,
                columns: [
                    {data: 'nama'},
                    {data: 'jurusan'},
                    {data: 'tahun'},
                    {data: 'sesi'},
                    {data: 'status_pendaftaran'},
                    {data: 'status'},
                    {data: 'created_at'}
                ]
            });
        });

        $("#tahun-grafik").change(function(){
            var tahun = $("#tahun-grafik").val();
            $("#temp_tahun").val(tahun);

            $.ajax({
                url: '/panitia/pmb/laporan/grafik/filter/{tahun}',
                type: 'get',
                dataType: 'json',
                success: function(result){
                    console.log(result);
                    Morris.Bar({
                        element: 'morris-bar-chart',
                        data: [
                            {
                                jurusan: 'Teknik Informatika',
                                lulus: result[0].if_lulus,
                                tidak_lulus: result[0].if_tidak_lulus
                            },
                            {
                                jurusan: 'Sistem Informasi',
                                lulus: result[0].si_lulus,
                                tidak_lulus: result[0].si_tidak_lulus
                            }
                        ],
                        xkey: 'jurusan',
                        ykeys: ['lulus', 'tidak_lulus'],
                        labels: ['Lulus', 'Tidak Lulus'],
                        hideHover: 'auto',
                        resize: true
                    });
                }
            });
        });

        $("#cetak").click(function(){
            var temp_tahun = $("#temp_tahun").val();
            window.location.replace('/panitia/pmb/laporan/unduh/'+temp_tahun);
        });
    </script>
@endpush
