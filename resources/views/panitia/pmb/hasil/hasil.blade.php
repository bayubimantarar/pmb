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
    <div class="col-lg-12">
        <h2>Filter data hasil ujian</h2>
        <div class="form-group">
            <div class="row">
                <div class="col-lg-2 col-md-2 col-xs-12">
                    <label for="">Jurusan</label>
                    <select name="" class="form-control" id="kode-jurusan">
                        <option value="">-- Pilih Jurusan --</option>
                        @foreach($prodi as $item)
                            <option value="{{ $item->kode }}">{{ $item->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-2 col-md-2 col-xs-12">
                    <label for="">Gelombang</label>
                    <select name="" class="form-control" id="kode-gelombang">
                        <option value="">-- Pilih Gelombang --</option>
                        @foreach($gelombang as $item)
                            <option value="{{ $item->kode }}">{{ $item->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-2 col-md-2 col-xs-12">
                    <label for="">Kelas</label>
                    <select name="" class="form-control" id="kode-kelas">
                        <option value="">-- Pilih Kelas --</option>
                        @foreach($biaya as $item)
                            <option value="{{ $item->id }}">{{ $item->kelas }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-2 col-md-2 col-xs-12">
                    <label for="">Tahun</label>
                    <select name="tahun" class="form-control" id="tahun">
                        <option value="">-- Pilih Tahun --</option>
                        @for($i=date('Y'); $i>=1950; $i--)
                            <option value="{{ $i }}">
                                {{ $i }}
                            </option>
                        @endfor
                    </select>
                </div>
                <div class="col-lg-2 col-md-2 col-xs-12">
                    <label for="">Opsi</label>
                    <a href="#cari-data" class="btn btn-primary form-control" id="filter">
                        <i class="fa fa-search"></i> Cari Data
                    </a>
                </div>
            </div>
        </div>
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
                                <th>Kode Gelombang</th>
                                <th>Kode Jurusan</th>
                                <th>Kode Soal</th>
                                <th>Nilai</th>
                                <th>Status</th>
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
      var hasil_ujian_table = $("#hasil-ujian-table").DataTable({
        serverSide: true,
        processing: true,
        ajax: '/panitia/pmb/hasil-ujian/data',
        columns: [
            {data: 'kode_pendaftaran'},
            {data: 'kode_gelombang'},
            {data: 'kode_jurusan'},
            {data: 'kode_soal'},
            {data: 'nilai_angka'},
            {data: 'status'}
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
