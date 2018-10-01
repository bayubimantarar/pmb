<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSoalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('soal', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode')->unique();
            $table->string('kode_tahun_ajaran');
            $table->string('kode_kelas');
            $table->string('kode_jenis_ujian');
            $table->string('kode_mata_kuliah');
            $table->string('nip');
            $table->string('sifat_ujian')->nullable();
            $table->timestamp('tanggal_mulai_ujian');
            $table->timestamp('tanggal_selesai_ujian');
            $table->integer('durasi_ujian')->nullable();
            $table->integer('jumlah_pertanyaan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('soal');
    }
}
