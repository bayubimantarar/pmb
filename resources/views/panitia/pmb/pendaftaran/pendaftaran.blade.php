@extends('panitia.layouts.main')

@section('title')
Panitia &raquo; PMB &raquo; Data Pendaftaran
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Data Pendaftaran</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- .row -->
<div class="row">
    <div class="col-lg-12">
        <ul class="breadcrumb">
            <li><a href="/prodi">Panitia</a></li>
            <li class="active">Pendaftaran</li>
        </ul>
    </div>
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <p>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                <i class="fa fa-search"></i> Cari konfirmasi pembayaran
            </button>
        </p>
        <div class="panel panel-default">
            <div class="panel-heading">
                Tabel Data Soal
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="pendaftaran-table">
                        <thead>
                            <tr>
                                <th>Nama Lengkap</th>
                                <th>Nomor Telepon</th>
                                <th>Email</th>
                                <th>Alamat</th>
                                <th>Pembayaran</th>
                                <th>Pengisian Formulir</th>
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
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Data Konfirmasi Pembayaran</h4>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
            <table width="100%" class="table table-striped table-bordered table-hover" id="konfirmasi-pembayaran-table">
                <thead>
                    <tr>
                        <th>Nama Lengkap</th>
                        <th>Nomor Telepon</th>
                        <th>Email</th>
                        <th>Alamat</th>
                        <th>Tanggal Pembayaran</th>
                        <th>Jumlah Pembayaran</th>
                        <th>Bank Tujuan</th>
                        <th>Nama Rekening Pengirim</th>
                        <th>Bukti Transaksi</th>
                    </tr>
                </thead>
            </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
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
      var pendaftaran_table = $('#pendaftaran-table').DataTable({
        serverSide: true,
        processing: true,
        ajax: '/panitia/pmb/pendaftaran/data',
        columns: [
            {data: 'nama'},
            {data: 'nomor_telepon'},
            {data: 'email'},
            {data: 'alamat'},
            {data: 'konfirmasi_pembayaran'},
            {data: 'status'},
            {data: 'action', orderable: false, searchable: false}
        ]
      });

      var konfirmasi_pembayaran_table = $('#konfirmasi-pembayaran-table').DataTable({
        serverSide: true,
        processing: true,
        ajax: '/panitia/pmb/konfirmasi-pembayaran/data',
        columns: [
            {data: 'nama'},
            {data: 'nomor_telepon'},
            {data: 'email'},
            {data: 'alamat'},
            {data: 'tanggal_pembayaran'},
            {data: 'jumlah_pembayaran'},
            {data: 'bank_tujuan'},
            {data: 'nama_rekening_pengirim'},
            {data: 'bukti_transaksi'}
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
                url: '/prodi/pmb/pendaftaran/hapus/'+id,
                type: 'delete',
                dataType: 'json',
                success: function(result){
                    alert('Data berhasil dihapus!');
                    pendaftaran_table.ajax.reload();
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
                        pendaftaran_table.ajax.reload();
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
                        pendaftaran_table.ajax.reload();
                    }
                });
            }
        }
      }
    </script>
@endpush
