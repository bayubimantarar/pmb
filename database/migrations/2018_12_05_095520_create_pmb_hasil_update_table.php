<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePmbHasilUpdateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pmb_hasil_update', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode_jadwal_ujian');
            $table->string('kode_pendaftaran');
            $table->string('kode_gelombang');
            $table->string('kode_jurusan');
            $table->string('kode_soal');
            $table->string('kode_kelas');
            $table->integer('nilai_angka');
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
        Schema::dropIfExists('pmb_hasil_update');
    }
}
