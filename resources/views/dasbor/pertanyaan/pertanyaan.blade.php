@extends('dasbor.layouts.main')

@push('meta')
<meta name="kode-soal" content="{{ $kodesoal }}">
@endpush

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Data Pertanyaan</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- .row -->
<div class="row">
    <div class="col-lg-12">
        <ul class="breadcrumb">
            <li><a href="/dasbor">Dasbor</a></li>
            <li class="active">Data Pertanyaan</li>
        </ul>
    </div>
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <p>
            <a href="/dasbor/pertanyaan/{{ $kodesoal }}/form-tambah" class="btn btn-sm btn-info"><i class="fa fa-plus"></i> Tambah Data Pertanyaan</a>
        </p>
        <div class="panel panel-default">
            <div class="panel-heading">
                Tabel Data Pertanyaan
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <table width="100%" class="table table-striped table-bordered table-hover" id="pertanyaan-table">
                    <thead>
                        <tr>
                            <th>Kode Soal</th>
                            <th>Jenis Ujian</th>
                            <th>Mata Kuliah</th>
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

        var pertanyaan_table = $('#pertanyaan-table').DataTable({
            serverSide: true,
            processing: true,
            ajax: '/dasbor/pertanyaan/'+kodesoal+'/data',
            columns: [
                {data: 'kode_soal'},
                {data: 'nama_jenis_ujian'},
                {data: 'nama_mata_kuliah'},
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
                    url: '/dasbor/soal/hapus/'+id,
                    type: 'delete',
                    dataType: 'json',
                    success: function(result){
                        alert('Data berhasil dihapus!');
                        pertanyaan_table.ajax.reload();
                    }
                });
            }
        }
    </script>
@endpush
