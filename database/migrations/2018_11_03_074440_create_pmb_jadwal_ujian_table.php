<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePmbJadwalUjianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pmb_jadwal_ujian', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode')->unique();
            $table->string('kode_soal');
            $table->string('kode_gelombang');
            $table->string('kode_jurusan');
            $table->string('status_pendaftaran');
            $table->string('tahun');
            $table->timestamp('tanggal_mulai_ujian');
            $table->timestamp('tanggal_selesai_ujian');
            $table->string('status');
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
        Schema::dropIfExists('pmb_jadwal_ujian');
    }
}
