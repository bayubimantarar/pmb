@extends('panitia.layouts.main')

@section('title')
Panitia &raquo; PMB &raquo; Data Biaya
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
            <li><a href="/prodi">Panitia</a></li>
            <li class="active">PMB</li>
            <li class="active">Data Biaya</li>
        </ul>
    </div>
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <p>
            <a href="/panitia/pmb/biaya/form-tambah" class="btn btn-primary">
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
                    <table width="100%" class="table table-striped table-bordered table-hover" id="biaya-table">
                        <thead>
                            <tr>
                                <th>Kelas</th>
                                <th>Biaya pendaftaran</th>
                                <th>Biaya jaket & kemeja</th>
                                <th>Biaya PSPT</th>
                                <th>Biaya pengembangan institusi</th>
                                <th>Biaya kuliah</th>
                                <th>Biaya kemahasiswaan</th>
                                <th>Keterangan</th>
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
      var biaya_table = $("#biaya-table").DataTable({
        serverSide: true,
        processing: true,
        ajax: '/panitia/pmb/biaya/data',
        columns: [
            {data: 'kelas'},
            {data: 'biaya_pendaftaran'},
            {data: 'biaya_jaket_kemeja'},
            {data: 'biaya_pspt'},
            {data: 'biaya_pengembangan_institusi'},
            {data: 'biaya_kuliah'},
            {data: 'biaya_kemahasiswaan'},
            {data: 'keterangan'},
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
                url: '/panitia/pmb/biaya/hapus/'+id,
                type: 'delete',
                dataType: 'json',
                success: function(result){
                    alert('Data berhasil dihapus!');
                    biaya_table.ajax.reload();
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
                        biaya_table.ajax.reload();
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
                        biaya_table.ajax.reload();
                    }
                });
            }
        }
      }
    </script>
@endpush
