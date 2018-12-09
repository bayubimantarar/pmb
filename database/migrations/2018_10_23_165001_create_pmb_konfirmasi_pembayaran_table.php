<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePmbKonfirmasiPembayaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pmb_konfirmasi_pembayaran', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama');
            $table->string('nomor_telepon');
            $table->string('email');
            $table->text('alamat');
            $table->datetime('tanggal_pembayaran');
            $table->integer('jumlah_pembayaran');
            $table->string('bank_tujuan');
            $table->string('nama_rekening_pengirim');
            $table->string('bukti_transaksi')->nullable();
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
        Schema::dropIfExists('pmb_konfirmasi_pembayaran');
    }
}
