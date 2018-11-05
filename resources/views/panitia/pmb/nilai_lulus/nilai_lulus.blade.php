@extends('panitia.layouts.main')

@section('title')
Panitia &raquo; PMB &raquo; Data nilai
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Data nilai</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- .row -->
<div class="row">
    <div class="col-lg-12">
        <ul class="breadcrumb">
            <li><a href="/prodi">Panitia</a></li>
            <li class="active">PMB</li>
            <li class="active">Data nilai</li>
        </ul>
    </div>
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        @if($nilaiLulus < 0)
        <p>
            <a href="/panitia/pmb/nilai/form-tambah" class="btn btn-primary">
                <i class="fa fa-plus"></i> Tambah data nilai
            </a>
        </p>
        @endif
        <div class="panel panel-default">
            <div class="panel-heading">
                Tabel Data Soal
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="nilai-table">
                        <thead>
                            <tr>
                                <th>Nilai</th>
                                <th>Opsi</th>
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
      var nilai_table = $("#nilai-table").DataTable({
        serverSide: true,
        processing: true,
        ajax: '/panitia/pmb/nilai-kelulusan/data',
        columns: [
            {data: 'nilai'},
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
                url: '/panitia/pmb/nilai/hapus/'+id,
                type: 'delete',
                dataType: 'json',
                success: function(result){
                    alert('Data berhasil dihapus!');
                    nilai_table.ajax.reload();
                }
            });
        }
    }

    function aktifkan(id)
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
                        nilai_table.ajax.reload();
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
                        nilai_table.ajax.reload();
                    }
                });
            }
        }
      }
    </script>
@endpush
