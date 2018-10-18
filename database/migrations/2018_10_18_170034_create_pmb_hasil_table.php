<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePmbHasilTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pmb_hasil', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode_soal');
            $table->string('kode_pmb');
            $table->float('nilai_angka')->nullable();
            $table->string('nilai_huruf')->nullable();
            $table->string('status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pmb_hasil');
    }
}
