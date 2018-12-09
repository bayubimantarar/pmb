@extends('dasbor.layouts.main')

@section('title')
Dasbor &raquo; Tahun Ajaran
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Form Ubah Data Tahun Ajaran</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <ul class="breadcrumb">
            <li><a href="/dasbor">Dasbor</a></li>
            <li><a href="/dasbor/tahun-ajaran">Data Tahun Ajaran</a></li>
            <li class="active">Form Ubah Data Tahun Ajaran</li>
        </ul>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Form Data Tahun Ajaran
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form action="/dasbor/tahun-ajaran/ubah/{{ $tahunajaran->id }}" method="post">
                            @csrf
                            <input type="hidden" name="_method" value="put" />
                            <div class="form-group {{ $errors->has('tahun') ? ' has-error' : '' }}">
                                <div class="row">
                                    <div class="col-lg-5 col-md-5 col-xs-12">
                                        <label>Tahun Ajaran *</label>
                                        <input type="number" class="form-control" name="tahun" value="{{ $tahun }}" />
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Simpan</button>
                            <a href="/dasbor/master/tahun-ajaran" class="btn btn-default"><i class="fa fa-times"></i> Batal</a>
                        </form>
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
<!-- /.row -->
@endsection

@push('js')
<script>
$(document).ready(function(){
    $('#tahun-awal').keyup(function(){
        var temptahunawal   = $('#tahun-awal').val();
        var temptahunakhir  = $('#tahun-akhir').val();
        var tempsemester    = $('#semester option:selected').text().toUpperCase();
        var tahun_awal      = temptahunawal.substring(2, 4);
        var tahun_akhir     = temptahunakhir.substring(2, 4);
        var kode            = tahun_awal+tahun_akhir+tempsemester;
        $('#kode').val(kode);
    });
    $('#tahun-akhir').keyup(function(){
        var temptahunawal   = $('#tahun-awal').val();
        var temptahunakhir  = $('#tahun-akhir').val();
        var tempsemester    = $('#semester option:selected').text().toUpperCase();
        var tahun_awal      = temptahunawal.substring(2, 4);
        var tahun_akhir     = temptahunakhir.substring(2, 4);
        var kode            = tahun_awal+tahun_akhir+tempsemester;
        $('#kode').val(kode);
    });
    $('#semester').change(function(){
        var temptahunawal   = $('#tahun-awal').val();
        var temptahunakhir  = $('#tahun-akhir').val();
        var tempsemester    = $('#semester option:selected').text().toUpperCase();
        var tahun_awal      = temptahunawal.substring(2, 4);
        var tahun_akhir     = temptahunakhir.substring(2, 4);
        var kode            = tahun_awal+tahun_akhir+tempsemester;
        $('#kode').val(kode);
    });
});
</script>
@endpush
