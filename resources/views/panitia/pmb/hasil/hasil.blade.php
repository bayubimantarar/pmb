@extends('panitia.layouts.main')

@section('title')
Panitia &raquo; PMB &raquo; Data hasil-ujian
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Data hasil-ujian</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- .row -->
<div class="row">
    <div class="col-lg-12">
        <ul class="breadcrumb">
            <li><a href="/prodi">Panitia</a></li>
            <li class="active">PMB</li>
            <li class="active">Data hasil-ujian</li>
        </ul>
    </div>
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Tabel Data Soal
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="hasil-ujian-table">
                        <thead>
                            <tr>
                                <th>Kode Pendaftaran</th>
                                <th>Kode Gelombang</th>
                                <th>Kode Jurusan</th>
                                <th>Kode Soal</th>
                                <th>Nilai</th>
                                <th>Status</th>
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
    <script src="/assets/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="/assets/vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="/assets/vendor/datatables-responsive/dataTables.responsive.js"></script>
    <script>
      var hasil_ujian_table = $("#hasil-ujian-table").DataTable({
        serverSide: true,
        processing: true,
        ajax: '/panitia/pmb/hasil-ujian/data',
        columns: [
            {data: 'kode_pendaftaran'},
            {data: 'kode_gelombang'},
            {data: 'kode_jurusan'},
            {data: 'kode_soal'},
            {data: 'nilai_angka'},
            {data: 'status'}
        ]
      });
    </script>
@endpush
