<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePmbJawabanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pmb_jawaban', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode_jadwal_ujian');
            $table->string('kode_pendaftaran');
            $table->string('kode_soal');
            $table->string('nomor_pertanyaan');
            $table->string('jenis_pertanyaan');
            $table->string('jawaban_pilihan')->nullable();
            $table->string('jawaban_benar_salah')->nullable();
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
        Schema::dropIfExists('pmb_jawaban');
    }
}
