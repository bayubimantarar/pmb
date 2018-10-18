<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCalonMahasiswaBiodataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calon_mahasiswa_biodata', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode_pendaftaran');
            $table->string('nama');
            $table->integer('jenis_kelamin');
            $table->text('alamat');
            $table->string('rt_rw')->nullable();
            $table->string('kelurahan')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('kode_pos')->nullable();
            $table->string('kota_kabupaten')->nullable();
            $table->string('provinsi')->nullable();
            $table->string('kota_lahir')->nullable();
            $table->string('tanggal')->nullable();
            $table->string('bulan')->nullable();
            $table->string('tahun')->nullable();
            $table->string('pekerjaan')->nullable();
            $table->string('nomor_telepon_rumah')->nullable();
            $table->string('nomor_telepon')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('website')->nullable();
            $table->string('mengenal_stmik')->nullable();
            $table->string('foto')->nullable();
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
        Schema::dropIfExists('calon_mahasiswa_biodata');
    }
}
