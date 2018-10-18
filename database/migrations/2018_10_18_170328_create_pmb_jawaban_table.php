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
            $table->string('kode_soal');
            $table->string('kode_pmb');
            $table->string('nomor_pertanyaan');
            $table->string('jawaban_essay')->nullable();
            $table->string('jawaban_pilihan')->nullable();
            $table->string('gambar')->nullable();
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
