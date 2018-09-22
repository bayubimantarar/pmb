@extends('mahasiswa.layouts.main')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Form Tambah Data Pertanyaan</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <ul class="breadcrumb">
            <li><a href="/dasbor">Dasbor</a></li>
            <li class="active">Ujian</li>
        </ul>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Form jawaban pertanyaan
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form action="#" method="post" enctype="multipart/form-data">
                            @csrf
                            @foreach($dataPertanyaan as $item)
                                @if($item->jenis_pertanyaan == 'essay')
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-12">
                                                @if($item->gambar != null)
                                                    <img src="/uploads/pertanyaan/gambar/{{ $item->gambar }}" />
                                                @endif
                                                <h3><b>{!! $item->pertanyaan !!}</b></h3>
                                                <textarea name="" id="" cols="30" rows="10"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <hr />
                                @else
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-12">
                                                @if($item->gambar != null)
                                                    <img src="/uploads/pertanyaan/gambar/{{ $item->gambar }}" />
                                                @endif
                                                <h3><b>{!! $item->pertanyaan !!}</b></h3>
                                                <p><input type="radio" name="jawaban[{{ $item->id }}]" value="a"> {{ $item->pilihan_a }}</p>
                                                <p><input type="radio" name="jawaban[{{ $item->id }}]" value="b"> {{ $item->pilihan_b }}</p>
                                                <p><input type="radio" name="jawaban[{{ $item->id }}]" value="c"> {{ $item->pilihan_c }}</p>
                                                <p><input type="radio" name="jawaban[{{ $item->id }}]" value="d"> {{ $item->pilihan_d }}</p>
                                                <p><input type="radio" name="jawaban[{{ $item->id }}]" value="e"> {{ $item->pilihan_e }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <hr />
                                @endif
                            @endforeach
                            <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-check"></i> Simpan</button>
                            <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-times"></i> Batal</button>
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
<script src="/assets/vendor/tinymce/js/jquery.tinymce.min.js"></script>
<script src="/assets/vendor/tinymce/js/tinymce.min.js"></script>
<script>
    $(document).ready(function(){
        if($('#jenis-pertanyaan option:selected').val() == 'essay'){
            $('#essat').show();
            $('#pilihan-ganda').hide();
        }else{
            $('#pilihan-ganda').show();
            $('#essay').hide();
        }
    });

    tinymce.init({
        mode: "textareas"
    });

    $('#jenis-pertanyaan').change(function(){
        if($('#jenis-pertanyaan').val() === "essay"){
            $('#essat').show();
            $('#pilihan-ganda').hide();
        }else{
            $('#pilihan-ganda').show();
            $('#essay').hide();
        }
    });

    function readURL(input){
        if(input.files && input.files[0]){
            var reader = new FileReader();
            reader.onload = function(e){
                $("#show-image").attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $("#gambar").change(function(){
        readURL(this);
    });
</script>
@endpush
