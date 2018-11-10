<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePmbCalonMahasiswaKelengkapanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pmb_calon_mahasiswa_kelengkapan', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode_pendaftaran');
            $table->string('fotocopy_raport_kelas_xii')->nullable();
            $table->string('fotocopy_ijazah_sma')->nullable();
            $table->string('foto_3x4')->nullable();
            $table->string('foto_4x6')->nullable();
            $table->string('surat_keterangan_pindah')->nullable();
            $table->string('fotocopy_transkrip_nilai')->nullable();
            $table->string('fotocopy_ijazah_perguruan_tinggi_asal')->nullable();
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
        Schema::dropIfExists('pmb_calon_mahasiswa_kelengkapan');
    }
}
