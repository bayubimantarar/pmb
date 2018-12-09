@extends('panitia.layouts.main')

@section('title')
Panitia &raquo; PMB &raquo; Data Hasil Ujian
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Data Hasil Ujian</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- .row -->
<div class="row">
    <div class="col-lg-12">
        <ul class="breadcrumb">
            <li><a href="/prodi">Panitia</a></li>
            <li class="active">PMB</li>
            <li class="active">Data Hasil Ujian</li>
        </ul>
    </div>
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-6 col-md-6 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Tabel Data Hasil Ujian
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="hasil-ujian-table">
                        <thead>
                            <tr>
                                <th>Kode Pendaftaran</th>
                                <th>Nama</th>
                                <th>Nilai</th>
                                <th>Status</th>
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
    <div class="col-lg-6 col-md-6 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Tabel Data Hasil Ujian UPDATE
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="hasil-ujian-update-table">
                        <thead>
                            <tr>
                                <th>Kode Pendaftaran</th>
                                <th>Nama</th>
                                <th>Nilai</th>
                                <th>Status</th>
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
        var kode_jadwal_ujian = "{{ $kodeJadwalUjian }}";
      var hasil_ujian_table = $("#hasil-ujian-table").DataTable({
        serverSide: true,
        processing: true,
        ajax: '/panitia/pmb/hasil-ujian/'+kode_jadwal_ujian+'/data',
        columns: [
            {data: 'kode_pendaftaran'},
            {data: 'nama'},
            {data: 'nilai_angka'},
            {data: 'status'},
            {data: 'action'},
        ]
      });

      var hasil_ujian_update_table = $("#hasil-ujian-update-table").DataTable({
        serverSide: true,
        processing: true,
        ajax: '/panitia/pmb/hasil-ujian-update/'+kode_jadwal_ujian+'/data',
        columns: [
            {data: 'kode_pendaftaran'},
            {data: 'nama'},
            {data: 'nilai_angka'},
            {data: 'status'},
            {data: 'action'},
        ]
      });

        $("#filter").click(function(){
            var kode_jurusan = $("#kode-jurusan").val();
            var kode_gelombang = $("#kode-gelombang").val();
            var kode_kelas = $("#kode-kelas").val();
            var tahun = $("#tahun").val();

            if(kode_jurusan == ""){
                alert("Pilih Jurusan");
            }else if(kode_gelombang == ""){
                alert("Pilih Gelombang");
            }else if(kode_kelas == ""){
                alert("Pilih Kelas");
            }else if(tahun == ""){
                alert("Pilih Tahun");
            }else{
                var url = "/panitia/pmb/hasil-ujian/data/cari/"+kode_jurusan+"/"+kode_gelombang+"/"+kode_kelas+"/"+tahun;
                $.ajax({
                    url: url,
                    type: "GET",
                    dataType: 'json',
                    success:function(data){
                        $('#hasil-ujian-table').DataTable({
                            serverSide: true,
                            processing: true,
                            destroy: true,
                            ajax: url,
                            columns: [
                                {data: 'kode_pendaftaran'},
                                {data: 'kode_gelombang'},
                                {data: 'kode_jurusan'},
                                {data: 'kode_soal'},
                                {data: 'nilai_angka'},
                                {data: 'status'}
                            ]
                        });
                    }
                });
            }
        });
    </script>
@endpush
