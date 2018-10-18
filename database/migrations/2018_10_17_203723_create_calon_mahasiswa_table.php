<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCalonMahasiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calon_mahasiswa', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode_pendaftaran')->unique(); // [PMB][TAHUN][SEMESTER][count_calon_mahasiswa_table]
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
        Schema::dropIfExists('calon_mahasiswa');
    }
}
