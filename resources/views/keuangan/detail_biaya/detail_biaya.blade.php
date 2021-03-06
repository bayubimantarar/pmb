@extends('keuangan.layouts.main')

@section('title')
Keuangan &raquo; PMB &raquo; Data Biaya
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Data Biaya</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- .row -->
<div class="row">
    <div class="col-lg-12">
        <ul class="breadcrumb">
            <li><a href="/prodi">Keuangan</a></li>
            <li class="active">PMB</li>
            <li class="active">Data Biaya</li>
        </ul>
    </div>
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <p>
            <a href="/keuangan/detail-biaya/{{$kodeBiaya}}/form-tambah" class="btn btn-primary">
                <i class="fa fa-plus"></i> Tambah data biaya
            </a>
        </p>
        <div class="panel panel-default">
            <div class="panel-heading">
                Tabel Data Soal
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="detail-biaya-table">
                        <thead>
                            <tr>
                                <th>Deskripsi</th>
                                <th>Jumlah</th>
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
      var detail_biaya_table = $("#detail-biaya-table").DataTable({
        serverSide: true,
        processing: true,
        ajax: '/keuangan/detail-biaya/{{$kodeBiaya}}/data',
        columns: [
            {data: 'deskripsi'},
            {data: 'jumlah'},
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
                url: '/keuangan/detail-biaya/{{$kodeBiaya}}/hapus/'+id,
                type: 'delete',
                dataType: 'json',
                success: function(result){
                    alert('Data berhasil dihapus!');
                    detail_biaya_table.ajax.reload();
                }
            });
        }
    }
    </script>
@endpush
