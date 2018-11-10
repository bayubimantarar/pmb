<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePmbCalonMahasiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pmb_calon_mahasiswa', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode')->unique();
            $table->string('kode_jurusan');
            $table->string('kode_kelas');
            $table->string('kode_gelombang');
            $table->string('status_pendaftaran');
            $table->string('password')->nullable();
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
        Schema::dropIfExists('pmb_calon_mahasiswa');
    }
}
