@extends('mahasiswa.layouts.main')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Dashboard</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Soal
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Kode Soal</th>
                                    <th>Soal</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $kodesoal }}</td>
                                    <td>{{ $matakuliah }}</td>
                                    <td>
                                        <center>
                                            <a href="/mahasiswa/ujian/soal/mulai/{{$token}}" class="btn btn-primary disabled" onclick="return confirm('Mulai ujian?')"><i class="fa fa-edit" disabled></i> Mulai Ujian</a>
                                        </center>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.col-lg-12 (nested) -->
                </div>
                <!-- /.row (nested) -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
@endsection
