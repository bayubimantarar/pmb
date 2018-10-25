@extends('prodi.layouts.main')

@section('title')
Dosen &raquo; Soal
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Data Soal</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- .row -->
<div class="row">
    <div class="col-lg-12">
        <ul class="breadcrumb">
            <li><a href="/prodi">Prodi</a></li>
            <li class="active">Data Soal</li>
        </ul>
    </div>
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <p>
            <a href="/prodi/pmb/soal/form-tambah" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah data soal</a>
        </p>
        <div class="panel panel-default">
            <div class="panel-heading">
                Tabel Data Soal
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <table width="100%" class="table table-striped table-bordered table-hover" id="soal-table">
                    <thead>
                        <tr>
                            <th>Kode Soal</th>
                            <th>Token</th>
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
      var soal_table = $('#soal-table').DataTable({
        serverSide: true,
        processing: true,
        ajax: '/prodi/pmb/soal/data',
        columns: [
            {data: 'kode'},
            {data: 'token'},
            {data: 'status'},
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
                url: '/prodi/pmb/soal/hapus/'+id,
                type: 'delete',
                dataType: 'json',
                success: function(result){
                    alert('Data berhasil dihapus!');
                    soal_table.ajax.reload();
                }
            });
        }
    }

    function aktifkan(id, status, kode)
    {
        var tempstatus = status;
        var tempid = id;

        if(tempstatus == 0){
            var confirmation = confirm("Yakin akan mengaktifkan soal ini?");
            if (confirmation) {
                $.ajax({
                    headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '/dosen/soal/aktifkan/'+id,
                    type: 'put',
                    dataType: 'json',
                    success: function(result){
                        alert('Soal berhasil diaktifkan');
                        soal_table.ajax.reload();
                    }
                });
            }
        }else{
            var confirmation = confirm("Yakin akan mengnonaktifkan soal ini?");
            if (confirmation) {
                $.ajax({
                    headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '/dosen/soal/nonaktifkan/'+id,
                    type: 'put',
                    dataType: 'json',
                    success: function(result){
                        alert('Data berhasil dinonaktifkan!');
                        soal_table.ajax.reload();
                    }
                });
            }
        }
      }
    </script>
@endpush
