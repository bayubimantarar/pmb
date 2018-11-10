@extends('mahasiswa.layouts.main')

@push('css')
<link rel="stylesheet" href="/assets/vendor/jquery-confirm-master/dist/jquery-confirm.min.css" />
@endpush

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
                                            @if($hasExam == 1)
                                                <a href="#mulai-ujian" class="btn btn-primary" onclick="startExam()"><i class="fa fa-edit"></i> Mulai Ujian</a>
                                            @else
                                                <a href="#mulai-ujian" class="btn btn-primary disabled" onclick="startExam()"><i class="fa fa-edit"></i> Mulai Ujian</a>
                                            @endif
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

@push('js')
<script src="/assets/vendor/jquery-confirm-master/dist/jquery-confirm.min.js"></script>
<script>
function startExam(){
    $.confirm({
    title: 'Mulai ujian',
    content: '' +
    '<form action="" class="formName">' +
    '<div class="form-group">' +
    '<label>Masukkan token soal</label>' +
    '<input type="number" placeholder="Token soal" class="token form-control" required />' +
    '</div>' +
    '</form>',
    buttons: {
        formSubmit: {
            text: 'Cari',
            btnClass: 'btn-blue',
            action: function () {
                var token = this.$content.find('.token').val();
                if(!token){
                    $.alert('Token perlu diisi');
                    return false;
                }
                $.ajax({
                    url : '/mahasiswa/ujian/soal/cek-token/'+token,
                    type: 'get',
                    success: function(result){
                        if(result.active == true){
                            var kode_soal   = result.data.kode_soal;
                            var token       = result.data.token;
                            $.confirm({
                                title: 'Mulai ujian',
                                content: 'Soal sudah diaktifkan, klik mulai untuk mengerjakan.',
                                buttons: {
                                    mulai: {
                                        btnClass: 'btn-blue',
                                        action: function(){
                                            window.location.replace('/mahasiswa/ujian/soal/mulai/'+kode_soal+'/'+token);
                                        },
                                    },
                                    batal: {
                                        action: function(){

                                        },
                                    }
                                }
                            });
                        }else{
                            $.alert('Soal belum diaktifkan, silahkan hubungi dosen atau petugas.');
                        }
                    }
                })
            }
        },
        batal: function () {
            //close
        },
    },
    onContentReady: function () {
        // bind to events
        var jc = this;
        this.$content.find('form').on('submit', function (e) {
            // if the user submits the form by pressing enter in the field.
            e.preventDefault();
            jc.$$formSubmit.trigger('click'); // reference the button and click it
        });
    }
});
}
</script>
@endpush
