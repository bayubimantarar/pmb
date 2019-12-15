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
            $table->string('nidn', 150)->unique();
            $table->string('nama', 150);
            $table->string('email', 150);
            $table->string('nomor_telepon', 150);
            $table->text('alamat');
            $table->string('password', 150);
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
