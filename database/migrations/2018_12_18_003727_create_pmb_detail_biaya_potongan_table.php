<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePmbDetailBiayaPotonganTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pmb_detail_biaya_potongan', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode_biaya')->nullable();
            $table->string('kode_potongan')->nullable();
            $table->string('deskripsi');
            $table->string('jumlah');
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
        Schema::dropIfExists('pmb_detail_biaya_potongan');
    }
}
