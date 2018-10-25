<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePmbPendaftaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pmb_pendaftaran', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama');
            $table->string('nomor_telepon');
            $table->string('email');
            $table->text('alamat');
            $table->string('status');
            $table->string('konfirmasi_pembayaran');
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
        Schema::dropIfExists('pmb_pendaftaran');
    }
}
