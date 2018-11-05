<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePmbSoalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pmb_soal', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode')->unique(); //form
            $table->string('kode_tahun_ajaran'); //form 
            $table->string('nidn'); //panitia or dosen
            // $table->timestamp('tanggal_mulai_ujian');
            // $table->timestamp('tanggal_selesai_ujian');
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
        Schema::dropIfExists('pmb_soal');
    }
}
