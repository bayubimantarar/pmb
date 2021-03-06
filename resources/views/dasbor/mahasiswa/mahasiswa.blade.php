@extends('dasbor.layouts.main')

@section('title')
Dasbor &raquo; Mahasiswa
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Data Mahasiswa</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- .row -->
<div class="row">
    <div class="col-lg-12">
        <ul class="breadcrumb">
            <li><a href="/dasbor">Dasbor</a></li>
            <li class="active">Data Mahasiswa</li>
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
        <p>
            <a href="/dasbor/mahasiswa/form-tambah" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Data Mahasiswa</a>
        </p>
        <div class="panel panel-default">
            <div class="panel-heading">
                Tabel Data Mahasiswa
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <table width="100%" class="table table-striped table-bordered table-hover" id="mahasiswa-table">
                    <thead>
                        <tr>
                            <th>NIP</th>
                            <th>Nama Lengkap</th>
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
      var mahasiswa_table = $('#mahasiswa-table').DataTable({
        serverSide: true,
        processing: true,
        ajax: '/dasbor/mahasiswa/data',
        order: [[ 1, 'asc' ]],
        columns: [
            {data: 'nim'},
            {data: 'nama'},
            {data: 'action', orderable: false, searchable: false}
        ]
      });
      
      function destroy(id)
      {
        var confirmation = confirm("Yakin akan menghapus data ini?");

        if (confirmation) {
            $.ajax({
                headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/dasbor/mahasiswa/hapus/'+id,
                type: 'delete',
                dataType: 'json',
                success: function(result){
                    alert('Data berhasil dihapus!');
                    mahasiswa_table.ajax.reload();
                }
            });
        }
      }
    </script>
@endpush
