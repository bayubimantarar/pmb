<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePmbBiayaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pmb_biaya', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kelas')->unique();
            $table->integer('biaya_pendaftaran');
            $table->integer('biaya_jaket_kemeja');
            $table->integer('biaya_pspt');
            $table->integer('biaya_pengembangan_institusi');
            $table->integer('biaya_kuliah');
            $table->integer('biaya_kemahasiswaan');
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
        Schema::dropIfExists('pmb_biaya');
    }
}
