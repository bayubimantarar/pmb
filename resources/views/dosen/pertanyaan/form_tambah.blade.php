@extends('dosen.layouts.main')

@section('title')
Dosen &raquo; Pertanyaan &raquo; Form Ubah Data Pertanyaan
@endsection

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
            <li><a href="/dosen">Dosen</a></li>
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
                        @if($sisapertanyaan == 0)
                            <p><i>Pertanyaan sudah dibuat, jika ingin menambah pertanyaan silahkan ubah jumlah pertanyaan pada data soal</i></p>
                        @else
                            <form action="/dosen/pertanyaan/{{ $kodesoal }}/simpan" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="jumlah_pertanyaan" value="{{$sisapertanyaan}}" />
                                <h1><b>Soal</b></h1>
                                <hr />
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-5 col-xs-12">
                                            <label class="control-label" for="inputError">Nama Mata Kuliah</label>
                                            <input type="text" name="nama_mata_kuliah" class="form-control" value="{{ $namaMataKuliah }}" readonly />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-5 col-xs-12">
                                            <label class="control-label" for="inputError">Jenis Ujian</label>
                                            <input type="text" name="kode_jenis_ujian" class="form-control" value="{{ $namaJenisUjian }}" readonly />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-5 col-xs-12">
                                            <label class="control-label" for="inputError">Kode Soal</label>
                                            <input type="text" name="kode_soal" class="form-control" value="{{ $kodesoal }}" readonly />
                                        </div>
                                    </div>
                                </div>
                                <h1><b>Pertanyaan</b></h1>
                                <hr />
                                @for($i=0; $i<$sisapertanyaan; $i++)
                                    <h3><b>Pertanyaan Nomor {{ $nomor++ }}</b></h3>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-5 col-md-5 col-xs-12">
                                                <label class="control-label" for="inputError">Jenis Pertanyaan</label>
                                                <select name="jenis_pertanyaan[]" id="jenis-pertanyaan-{{$i}}" class="form-control" data="{{$i}}">
                                                    <option value="">-- Pilih jenis pertanyaan --</option>
                                                    <option value="essay">Essay</option>
                                                    <option value="pilihan_ganda">Pilihan Ganda</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group {{$errors->has('gambar.'.$i) ? ' has-error' : ''}}">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-xs-12">
                                                <img id="show-image-{{$i}}" class="img-responsive img-thumbnail" />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-xs-12">
                                                <label class="control-label" for="inputError">Gambar</label>
                                                <input type="file" name="gambar[]" id="gambar-{{$i}}" data="{{$i}}" />
                                                @if($errors->has('gambar.'.$i))
                                                    <p class="text-danger">
                                                        <i>
                                                            {{ $errors->first('gambar.'.$i) }}
                                                        </i>
                                                    </p>
                                                @endif
                                                    <p class="help-block">
                                                        Gambar yang bisa diunggah hanya [JPG|JPEG|PNG] dan maksimal ukuran file 2 MB
                                                    </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group {{$errors->has('pertanyaan.'.$i) ? ' has-error' : ''}}">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-xs-12">
                                                <label class="control-label" for="inputError">Pertanyaan</label>
                                                <textarea name="pertanyaan[]" id="editor" cols="30" rows="10"></textarea>
                                                @if($errors->has('pertanyaan.'.$i))
                                                    <p class="text-danger">
                                                        <i>{{ $errors->first('pertanyaan.'.$i) }}</i>
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div id="pilihan-ganda-{{$i}}">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-xs-12">
                                                    <label class="control-label" for="inputError">Pilihan Ganda Opsi A</label>
                                                    <textarea name="pilihan_a[]" id="editor" cols="30" rows="10"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-xs-12">
                                                    <label class="control-label" for="inputError">Pilihan Ganda Opsi B</label>
                                                    <textarea name="pilihan_b[]" id="editor" cols="30" rows="10"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-xs-12">
                                                    <label class="control-label" for="inputError">Pilihan Ganda Opsi C</label>
                                                    <textarea name="pilihan_c[]" id="editor" cols="30" rows="10"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-xs-12">
                                                    <label class="control-label" for="inputError">Pilihan Ganda Opsi D</label>
                                                    <textarea name="pilihan_d[]" id="editor" cols="30" rows="10"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-xs-12">
                                                    <label class="control-label" for="inputError">Pilihan Ganda Opsi E</label>
                                                    <textarea name="pilihan_e[]" id="editor" cols="30" rows="10"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group {{$errors->has('jawaban_pilihan') ? ' has-error' : ''}}">
                                            <div class="row">
                                                <div class="col-lg-5 col-md-5 col-xs-12">
                                                    <label class="control-label" for="inputError">Jawaban Pilihan</label>
                                                    <select name="jawaban_pilihan[]" id="" class="form-control">
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
                                    <div id="essay-{{$i}}">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-xs-12">
                                                    <label class="control-label" for="inputError">Jawaban Essay</label>
                                                    <textarea name="jawaban_essay[]" id="editor" cols="30" rows="10"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-5 col-md-5 col-xs-12">
                                                <label class="control-label" for="inputError">Bobot Nilai</label>
                                                <input type="number" name="bobot[]" class="form-control" value="10" readonly />
                                                <p class="help-block">Maksimal bobot nilai 10</p>
                                            </div>
                                        </div>
                                    </div>
                                    <hr />
                                @endfor
                                <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Simpan</button>
                                <a href="/dasbor/pertanyaan/{{ $kodesoal }}" class="btn btn-default"><i class="fa fa-times"></i> Batal</a>
                            </form>
                        @endif
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
        for(var i=0; i<={{ $sisapertanyaan}}; i++){
                $('#essay-'+i).hide();
                $('#pilihan-ganda-'+i).hide();
                $('#gambar-'+i).change(function(input){
                    var url = URL.createObjectURL($('#gambar-'+$(this).attr("data")).get(0).files[0]);
                    $("#show-image-"+$(this).attr("data")).attr('src', url).show();
                });
                $('#jenis-pertanyaan-'+i).change(function(){
                    console.log($(this).attr("data"));
                    if($(this).val() === "essay"){
                        $('#essay-'+$(this).attr("data")).show();
                        $('#pilihan-ganda-'+$(this).attr("data")).hide();
                    }else if($(this).val() === "pilihan_ganda"){
                        $('#pilihan-ganda-'+$(this).attr("data")).show();
                        $('#essay-'+$(this).attr("data")).hide();
                    }else{
                        $('#pilihan-ganda-'+$(this).attr("data")).hide();
                        $('#essay-'+$(this).attr("data")).hide();
                    }
                });
        }    
    });
    tinymce.init({
        mode: "textareas"
    });
</script>
@endpush
