<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePmbPertanyaanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pmb_pertanyaan', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode_soal');
            $table->text('pertanyaan');
            $table->string('jenis_pertanyaan');
            $table->text('gambar')->nullable();
            $table->text('pilihan_a')->nullable();
            $table->text('pilihan_b')->nullable();
            $table->text('pilihan_c')->nullable();
            $table->text('pilihan_d')->nullable();
            $table->text('pilihan_e')->nullable();
            $table->text('jawaban_pilihan')->nullable();
            $table->text('jawaban_benar_salah')->nullable();
            $table->integer('bobot')->nullable();
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
        Schema::dropIfExists('pmb_pertanyaan');
    }
}
