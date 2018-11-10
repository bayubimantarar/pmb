@extends('prodi.layouts.main')

@section('title')
Dosen &raquo; Pertanyaan &raquo; Form Tambah Data Pertanyaan
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Form Ubah Data Pertanyaan</h1>
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
            <li class="active">Form Ubah Data Pertanyaan</li>
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
                        <form action="/prodi/pmb/soal/pertanyaan/{{ $kodesoal }}/ubah/{{ $pertanyaan->id }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="_method" value="put" />
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-xs-12">
                                        <label class="control-label" for="inputError">Kode Soal</label>
                                        <input type="text" name="kode" class="form-control" value="{{ $kodesoal }}" readonly />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-xs-12">
                                        <label class="control-label" for="inputError">Jenis Pertanyaan</label>
                                        <select name="jenis_pertanyaan" id="jenis-pertanyaan" class="form-control">
                                            @if($pertanyaan->jenis_pertanyaan == "benar_salah")
                                                <option value="">-- Pilih jenis pertanyaan --</option>
                                                <option value="benar_salah" selected>Benar-Salah</option>
                                                <option value="pilihan_ganda">Pilihan Ganda</option>
                                            @else
                                                <option value="">-- Pilih jenis pertanyaan --</option>
                                                <option value="benar_salah">>Benar-Salah</option>
                                                <option value="pilihan_ganda" selected>Pilihan Ganda</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                        @if($pertanyaan->gambar == NULL)
                                            <img id="show-image" class="img-responsive img-thumbnail" />
                                        @else
                                            <img src="/uploads/pertanyaan/gambar/{{ $pertanyaan->gambar }}" id="show-image" / class="img-responsive img-thumbnail" />
                                        @endif
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
                                        <textarea name="pertanyaan" id="editor" cols="30" rows="10">{!! $pertanyaan->pertanyaan !!}</textarea>
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
                                            <textarea name="pilihan_a" id="editor" cols="30" rows="10">{!! $pertanyaan->pilihan_a !!}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-xs-12">
                                            <label class="control-label" for="inputError">Pilihan Ganda Opsi B</label>
                                            <textarea name="pilihan_b" id="editor" cols="30" rows="10">{!! $pertanyaan->pilihan_b !!}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-xs-12">
                                            <label class="control-label" for="inputError">Pilihan Ganda Opsi C</label>
                                            <textarea name="pilihan_c" id="editor" cols="30" rows="10">{!! $pertanyaan->pilihan_c !!}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-xs-12">
                                            <label class="control-label" for="inputError">Pilihan Ganda Opsi D</label>
                                            <textarea name="pilihan_d" id="editor" cols="30" rows="10">{!! $pertanyaan->pilihan_d !!}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-xs-12">
                                            <label class="control-label" for="inputError">Pilihan Ganda Opsi E</label>
                                            <textarea name="pilihan_e" id="editor" cols="30" rows="10">{!! $pertanyaan->pilihan_e !!}</textarea>
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
                            <div id="benar-salah">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-5 col-xs-12">
                                            <label class="control-label" for="inputError">Jawaban Benar Salah</label>
                                            <select name="jawaban_benar_salah" id="" class="form-control">
                                                <option value="benar">Benar</option>
                                                <option value="salah">Salah</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- <div id="essay">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-xs-12">
                                            <label class="control-label" for="inputError">Jawaban Essay</label>
                                            <textarea name="jawaban_essay" id="editor" cols="30" rows="10">{!! $pertanyaan->jawaban_essay !!}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-xs-12">
                                        <label class="control-label" for="inputError">Bobot Nilai</label>
                                        <input type="number" name="bobot" class="form-control" value="{!! $pertanyaan->bobot !!}" readonly />
                                        <p class="help-block">Maksimal bobot nilai 10</p>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Simpan</button>
                            <a href="/dasbor/pertanyaan/{{ $kodesoal }}" class="btn btn-default"><i class="fa fa-times"></i> Batal</a>
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
        tinymce.init({
            mode: "textareas"
        });

        if($('#jenis-pertanyaan option:selected').val() == 'benar_salah'){
            $('#benar-salah').show();
            $('#pilihan-ganda').hide();
        }else if($('#jenis-pertanyaan option:selected').val() == 'pilihan_ganda'){
            $('#pilihan-ganda').show();
            $('#benar-salah').hide();
        }

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
    });
</script>
@endpush
