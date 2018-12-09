<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePenggunaKeuanganTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengguna_keuangan', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nidn')->unique();
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('nomor_telepon')->unique();
            $table->text('alamat');
            $table->text('password');
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
        Schema::dropIfExists('pengguna_keuangan');
    }
}
