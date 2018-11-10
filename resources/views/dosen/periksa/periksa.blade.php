@extends('dosen.layouts.main')

@section('title')
Dosen &raquo; Periksa
@endsection

@push('meta')
    <meta name="kode-soal" content="{{ $kodesoal }}">
@endpush

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Periksa Jawaban</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- .row -->
<div class="row">
    <div class="col-lg-12">
        <ul class="breadcrumb">
            <li><a href="/dasbor">Dosen</a></li>
            <li class="active">Periksa Jawaban</li>
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
                Tabel Data Periksa
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <table width="100%" class="table table-striped table-bordered table-hover" id="jawaban-table">
                    <thead>
                        <tr>
                            <th>Kode Soal</th>
                            <th>NIM</th>
                            <th>Nama Mahasiswa</th>
                            <th>Status</th>
                            <th>Opsi</th>
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
    var kodesoal = $('meta[name="kode-soal"]').attr('content');

    var jawaban_table = $('#jawaban-table').DataTable({
        serverSide: true,
        processing: true,
        ajax: '/dosen/periksa/'+kodesoal+'/data/',
        columns: [
            {data: 'kode'},
            {data: 'nim'},
            {data: 'nama_mahasiswa'},
            {data: 'status'},
            {data: 'action', orderable: false, searchable: false}
        ]
    });
    </script>
@endpush
