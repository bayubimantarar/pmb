@extends('dasbor.layouts.main')

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
            <li class="active">Data Pertanyaan</li>
            <li class="active">{{ $kodesoal }}</li>
            <li class="active">Form Tambah Data Pertanyaan</li>
        </ul>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Form Data Pertanyaan
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form action="/dasbor/pertanyaan/{{ $kodesoal }}/simpan" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-xs-12">
                                        <label class="control-label" for="inputError">Nama Mata Kuliah</label>
                                        <input type="text" name="nama_mata_kuliah" class="form-control" value="{{ $namaMataKuliah }}" readonly />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-xs-12">
                                        <label class="control-label" for="inputError">Jenis Ujian</label>
                                        <input type="text" name="kode_jenis_ujian" class="form-control" value="{{ $namaJenisUjian }}" readonly />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-xs-12">
                                        <label class="control-label" for="inputError">Kode Soal</label>
                                        <input type="text" name="kode_soal" class="form-control" value="{{ $kodesoal }}" readonly />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-xs-12">
                                        <label class="control-label" for="inputError">Jenis Pertanyaan</label>
                                        <select name="jenis_pertanyaan" id="jenis-pertanyaan" class="form-control">
                                            <option value="essay">Essay</option>
                                            <option value="pilihan_ganda">Pilihan Ganda</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                        <img src="https://via.placeholder.com/350x150" id="show-image">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-xs-12">
                                        <label class="control-label" for="inputError">Gambar</label>
                                        <input type="file" name="gambar" id="gambar" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group {{$errors->has('pertanyaan') ? ' has-error' : ''}}">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                        <label class="control-label" for="inputError">Pertanyaan</label>
                                        <textarea name="pertanyaan" id="editor" cols="30" rows="10"></textarea>
                                        @if($errors->has('pertanyaan'))
                                            <p class="text-danger">{{ $errors->first('pertanyaan') }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div id="pilihan-ganda">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-xs-12">
                                            <label class="control-label" for="inputError">Pilihan Ganda Opsi A</label>
                                            <textarea name="pilihan_a" id="editor" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-xs-12">
                                            <label class="control-label" for="inputError">Pilihan Ganda Opsi B</label>
                                            <textarea name="pilihan_a" id="editor" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-xs-12">
                                            <label class="control-label" for="inputError">Pilihan Ganda Opsi C</label>
                                            <textarea name="pilihan_c" id="editor" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-xs-12">
                                            <label class="control-label" for="inputError">Pilihan Ganda Opsi D</label>
                                            <textarea name="pilihan_d" id="editor" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-xs-12">
                                            <label class="control-label" for="inputError">Pilihan Ganda Opsi E</label>
                                            <textarea name="pilihan_e" id="editor" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group {{$errors->has('jawaban_pilihan') ? ' has-error' : ''}}">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 col-xs-12">
                                            <label class="control-label" for="inputError">Jawaban Pilihan</label>
                                            <select name="jawaban_pilihan" id="" class="form-control">
                                                <option value="a">A</option>
                                                <option value="b">B</option>
                                                <option value="c">C</option>
                                                <option value="d">D</option>
                                                <option value="e">E</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="essay">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-xs-12">
                                            <label class="control-label" for="inputError">Jawaban Essay</label>
                                            <textarea name="jawaban_essay" id="editor" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-xs-12">
                                        <label class="control-label" for="inputError">Bobot Nilai</label>
                                        <input type="number" name="bobot" class="form-control" />
                                    </div>
                                </div>
                            </div>
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
