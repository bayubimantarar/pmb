@extends('mahasiswa.layouts.main')

@section('title')
Mahasiswa &raquo; Hasil
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Data Hasil</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- .row -->
<div class="row">
    <div class="col-lg-12">
        <ul class="breadcrumb">
            <li><a href="/mahasiswa">Mahasiswa</a></li>
            <li class="active">Data Hasil</li>
        </ul>
    </div>
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        @if(session('notification'))
            <div class="alert alert-dismissible alert-success">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                {{ session('notification') }}
            </div>
        @endif
        <div class="panel panel-default">
            <div class="panel-heading">
                Tabel Data Hasil
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <table width="100%" class="table table-striped table-bordered table-hover" id="hasil-table">
                    <thead>
                        <tr>
                            <th>Kode Soal</th>
                            <th>Mata Kuliah</th>
                            <th>Tahun Ajaran</th>
                            <th>Ujian</th>
                            <th>Nilai</th>
                        </tr>
                    </thead>
                </table>
                <!-- /.table-responsive -->
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
      var hasil_table = $('#hasil-table').DataTable({
        serverSide: true,
        processing: true,
        ajax: '/mahasiswa/hasil/data',
        columns: [
            {data: 'kode_soal'},
            {data: 'nama_mata_kuliah'},
            {data: 'tahun_ajaran'},
            {data: 'nama_jenis_ujian'},
            {data: 'nilai_angka'}
        ]
      });
    </script>
@endpush
