<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCalonMahasiswaOrangTuaWaliTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calon_mahasiswa_orang_tua_wali', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode_pendaftaran');
            $table->string('nama_ayah');
            $table->string('nama_ibu');
            $table->string('pekerjaan_ayah');
            $table->string('pekerjaan_ibu');
            $table->text('alamat');
            $table->string('rt_rw')->nullable();
            $table->string('kelurahan')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('kode_pos')->nullable();
            $table->string('kota_kabupaten')->nullable();
            $table->string('provinsi')->nullable();
            $table->string('nomor_telepon_rumah')->nullable();
            $table->string('nomor_telepon')->nullable();
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
        Schema::dropIfExists('calon_mahasiswa_orang_tua_wali');
    }
}
