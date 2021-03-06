<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::Routes();

Route::get('/', function(){
    return \Illuminate\Foundation\Inspiring::quote();
});

Route::group(['prefix' => 'pendaftaran'], function(){
    Route::get('/', [
        'uses' => 'PendaftaranController@index',
        'as' => 'pendaftaran'
    ]);
    Route::post('/simpan', [
        'uses' => 'PendaftaranController@store',
        'as' => 'pendaftaran.simpan'
    ]);
    Route::group(['prefix' => 'formulir'], function(){
        Route::get('/{encryptID}', [
            'uses' => 'PMB\PendaftaranController@formPendaftaran',
            'as' => 'pmb.pendaftaran.form_pendaftaran'
        ]);
        Route::post('{encryptID}/simpan', [
            'uses' => 'PMB\PendaftaranController@store',
            'as' => 'pmb.pendaftaran.simpan'
        ]);
    });
});

Route::group(['prefix' => 'konfirmasi-pembayaran'], function(){
    Route::get('/', [
        'uses' => 'KonfirmasiPembayaranController@index',
        'as' => 'konfirmasi_pembayaran'
    ]);
    Route::post('/simpan', [
        'uses' => 'KonfirmasiPembayaranController@store',
        'as' => 'konfirmasi_pembayaran.simpan'
    ]);
});

Route::group(['prefix' => 'kehadiran'], function(){
    Route::get('/{kode_pendaftaran}', [
        'uses' => 'KehadiranController@index',
        'as' => 'kehadiran'
    ]);
    Route::get('/{kode_pendaftaran}/cek-panitia/{nidn}', [
        'uses' => 'KehadiranController@checkPanitia',
        'as' => 'kehadiran.cek_panitia'
    ]);
    Route::post('/{kode_pendaftaran}/simpan', [
        'uses' => 'KehadiranController@store',
        'as' => 'kehadiran.simpan'
    ]);
});

Route::group(['prefix' => 'kelulusan'], function(){
    Route::get('/{kode_pendaftaran}', [
        'uses' => 'KelulusanController@index',
        'as' => 'kelulusan'
    ]);
});

Route::group(['prefix' => 'dasbor'], function() {
    Route::group(['prefix' => 'autentikasi'], function(){
        Route::get('/form-login', [
            'uses' => 'Dasbor\Autentikasi\AutentikasiController@formLogin',
            'as' => 'dasbor.autentikasi.form_login'
        ]);
        Route::post('/login', [
            'uses' => 'Dasbor\Autentikasi\AutentikasiController@login',
            'as' => 'dasbor.autentikasi.login'
        ]);
        Route::post('/logout', [
            'uses' => 'Dasbor\Autentikasi\AutentikasiController@logout',
            'as' => 'dasbor.autentikasi.logout'
        ]);
    });
    Route::group(['middleware' => 'auth:master'], function(){
        Route::get('/', [
            'uses'  => 'Dasbor\DasborController@index',
            'as'    => 'dasbor'
        ]);
        Route::group(['prefix' => 'hasil-ujian'], function(){
                Route::get('{kode_jadwal_ujian}/', [
                    'uses' => 'Dasbor\HasilUpdateController@index',
                    'as' => 'panitia.pmb.hasil_ujian_update'
                ]);
                Route::get('{kode_jadwal_ujian}/data', [
                    'uses' => 'Dasbor\HasilUpdateController@data',
                    'as' => 'panitia.pmb.hasil_ujian_update.data'
                ]);
                Route::post('{kode_jadwal_ujian}/simpan', [
                    'uses' => 'Dasbor\HasilUpdateController@store',
                    'as' => 'panitia.pmb.hasil_ujian_update_table.simpan'
                ]);
                Route::get('{kode_jadwal_ujian}/kirim-email/{id}', [
                    'uses' => 'Dasbor\HasilUpdateController@sendEmail',
                    'as' => 'panitia.pmb.hasil_ujian_update.kirim_email'
                ]);
                Route::get('{kode_jadwal_ujian}/unduh/{id}', [
                    'uses' => 'Dasbor\HasilUpdateController@downloadKelulusanBiaya',
                    'as' => 'panitia.pmb.hasil_ujian_update.unduh'
                ]);
            });
        Route::group(['prefix' => 'master'], function(){
            Route::group(['prefix' => 'prodi'], function(){
                Route::get('/', [
                    'uses'  => 'Dasbor\Master\ProdiController@index',
                    'as'    => 'dasbor.master.tahun_ajaran'
                ]);
                Route::get('/form-tambah', [
                    'uses'  => 'Dasbor\Master\ProdiController@create',
                    'as'    => 'dasbor.master.tahun_ajaran.form_tambah'
                ]);
                Route::get('/form-ubah/{id}', [
                    'uses'  => 'Dasbor\Master\ProdiController@edit',
                    'as'    => 'dasbor.master.tahun_ajaran.form_ubah'
                ]);
                Route::get('/data', [
                    'uses'  => 'Dasbor\Master\ProdiController@data',
                    'as'    => 'dasbor.master.data.tahun_ajaran'
                ]);
                Route::post('/simpan', [
                    'uses'  => 'Dasbor\Master\ProdiController@store',
                    'as'    => 'dasbor.master.tahun_ajaran.simpan'
                ]);
                Route::put('/ubah/{id}', [
                    'uses'  => 'Dasbor\Master\ProdiController@update',
                    'as'    => 'dasbor.master.tahun_ajaran.ubah'
                ]);
                Route::delete('/hapus/{id}', [
                    'uses'  => 'Dasbor\Master\ProdiController@destroy',
                    'as'    => 'dasbor.master.tahun_ajaran.hapus'
                ]);
            });
            Route::group(['prefix' => 'tahun-ajaran'], function(){
                Route::get('/', [
                    'uses'  => 'Dasbor\Master\TahunAjaranController@index',
                    'as'    => 'dasbor.tahun_ajaran'
                ]);
                Route::get('/form-tambah', [
                    'uses'  => 'Dasbor\Master\TahunAjaranController@create',
                    'as'    => 'dasbor.tahun_ajaran.form_tambah'
                ]);
                Route::get('/form-ubah/{id}', [
                    'uses'  => 'Dasbor\Master\TahunAjaranController@edit',
                    'as'    => 'dasbor.tahun_ajaran.form_ubah'
                ]);
                Route::get('/data', [
                    'uses'  => 'Dasbor\Master\TahunAjaranController@data',
                    'as'    => 'dasbor.data.tahun_ajaran'
                ]);
                Route::post('/simpan', [
                    'uses'  => 'Dasbor\Master\TahunAjaranController@store',
                    'as'    => 'dasbor.tahun_ajaran.simpan'
                ]);
                Route::put('/ubah/{id}', [
                    'uses'  => 'Dasbor\Master\TahunAjaranController@update',
                    'as'    => 'dasbor.tahun_ajaran.ubah'
                ]);
                Route::delete('/hapus/{id}', [
                    'uses'  => 'Dasbor\Master\TahunAjaranController@destroy',
                    'as'    => 'dasbor.tahun_ajaran.hapus'
                ]);
            });
        });
        Route::group(['prefix' => 'pengguna'], function(){
            Route::group(['prefix' => 'panitia'], function(){
                Route::get('/', [
                    'uses'  => 'Dasbor\Pengguna\PanitiaController@index',
                    'as'    => 'dasbor.pengguna.panitia'
                ]);
                Route::get('/form-tambah', [
                    'uses'  => 'Dasbor\Pengguna\PanitiaController@create',
                    'as'    => 'dasbor.pengguna.panitia.form_tambah'
                ]);
                Route::get('/form-ubah/{id}', [
                    'uses'  => 'Dasbor\Pengguna\PanitiaController@edit',
                    'as'    => 'dasbor.pengguna.panitia.form_ubah'
                ]);
                Route::get('/data', [
                    'uses'  => 'Dasbor\Pengguna\PanitiaController@data',
                    'as'    => 'dasbor.pengguna.data.panitia'
                ]);
                Route::post('/simpan', [
                    'uses'  => 'Dasbor\Pengguna\PanitiaController@store',
                    'as'    => 'dasbor.pengguna.panitia.simpan'
                ]);
                Route::put('/ubah/{id}', [
                    'uses'  => 'Dasbor\Pengguna\PanitiaController@update',
                    'as'    => 'dasbor.pengguna.panitia.ubah'
                ]);
                Route::delete('/hapus/{id}', [
                    'uses'  => 'Dasbor\Pengguna\PanitiaController@destroy',
                    'as'    => 'dasbor.pengguna.panitia.hapus'
                ]);
            });
         Route::group(['prefix' => 'keuangan'], function(){
            Route::get('/', [
                'uses'  => 'Dasbor\Pengguna\KeuanganController@index',
                'as'    => 'dasbor.pengguna.keuangan'
            ]);
            Route::get('/form-tambah', [
                'uses'  => 'Dasbor\Pengguna\KeuanganController@create',
                'as'    => 'dasbor.pengguna.keuangan.form_tambah'
            ]);
            Route::get('/form-ubah/{id}', [
                'uses'  => 'Dasbor\Pengguna\KeuanganController@edit',
                'as'    => 'dasbor.pengguna.keuangan.form_ubah'
            ]);
            Route::get('/data', [
                'uses'  => 'Dasbor\Pengguna\KeuanganController@data',
                'as'    => 'dasbor.pengguna.data.keuangan'
            ]);
            Route::post('/simpan', [
                'uses'  => 'Dasbor\Pengguna\KeuanganController@store',
                'as'    => 'dasbor.pengguna.keuangan.simpan'
            ]);
            Route::put('/ubah/{id}', [
                'uses'  => 'Dasbor\Pengguna\KeuanganController@update',
                'as'    => 'dasbor.pengguna.keuangan.ubah'
            ]);
            Route::delete('/hapus/{id}', [
                'uses'  => 'Dasbor\Pengguna\KeuanganController@destroy',
                'as'    => 'dasbor.pengguna.keuangan.hapus'
            ]);
        });
        Route::group(['prefix' => 'prodi'], function(){
            Route::get('/', [
                'uses'  => 'Dasbor\Pengguna\ProdiController@index',
                'as'    => 'dasbor.pengguna.prodi'
            ]);
            Route::get('/form-tambah', [
                'uses'  => 'Dasbor\Pengguna\ProdiController@create',
                'as'    => 'dasbor.pengguna.prodi.form_tambah'
            ]);
            Route::get('/form-ubah/{id}', [
                'uses'  => 'Dasbor\Pengguna\ProdiController@edit',
                'as'    => 'dasbor.pengguna.prodi.form_ubah'
            ]);
            Route::get('/data', [
                'uses'  => 'Dasbor\Pengguna\ProdiController@data',
                'as'    => 'dasbor.pengguna.data.prodi'
            ]);
            Route::post('/simpan', [
                'uses'  => 'Dasbor\Pengguna\ProdiController@store',
                'as'    => 'dasbor.pengguna.prodi.simpan'
            ]);
            Route::put('/ubah/{id}', [
                'uses'  => 'Dasbor\Pengguna\ProdiController@update',
                'as'    => 'dasbor.pengguna.prodi.ubah'
            ]);
            Route::delete('/hapus/{id}', [
                'uses'  => 'Dasbor\Pengguna\ProdiController@destroy',
                'as'    => 'dasbor.pengguna.prodi.hapus'
            ]);
        });
        });
    });
});

Route::group(['prefix' => 'prodi'], function(){
   Route::group(['prefix' => 'autentikasi'], function(){
        Route::get('/form-login', [
            'uses' => 'Prodi\Autentikasi\AutentikasiController@showFormLogin',
            'as' => 'prodi.autentikasi.form_login'
        ]);
        Route::post('/login', [
            'uses' => 'Prodi\Autentikasi\AutentikasiController@login',
            'as' => 'prodi.autentikasi.login'
        ]);
        Route::post('/logout', [
            'uses' => 'Prodi\Autentikasi\AutentikasiController@logout',
            'as' => 'prodi.autentikasi.logout'
        ]);
    });
    Route::group(['middleware' => 'auth:prodi'], function(){
        Route::get('/', [
            'uses' => 'Prodi\ProdiController@index',
            'as' => 'prodi.prodi'
        ]);
        Route::group(['prefix' => 'pmb'], function(){
            Route::group(['prefix' => 'soal'], function(){
                Route::get('/', [
                    'uses'  => 'Prodi\PMB\SoalController@index',
                    'as'    => 'prodi.soal'
                ]);
                Route::get('/form-tambah', [
                    'uses'  => 'Prodi\PMB\SoalController@create',
                    'as'    => 'prodi.soal.form_tambah'
                ]);
                Route::get('/form-ubah/{id}', [
                    'uses'  => 'Prodi\PMB\SoalController@edit',
                    'as'    => 'prodi.soal.form_ubah'
                ]);
                Route::get('/data', [
                    'uses'  => 'Prodi\PMB\SoalController@data',
                    'as'    => 'prodi.data.soal'
                ]);
                Route::post('/simpan', [
                    'uses'  => 'Prodi\PMB\SoalController@store',
                    'as'    => 'prodi.soal.simpan'
                ]);
                Route::put('/ubah/{id}', [
                    'uses'  => 'Prodi\PMB\SoalController@update',
                    'as'    => 'prodi.soal.ubah'
                ]);
                Route::put('/aktifkan/{id}', [
                    'uses'  => 'Prodi\PMB\SoalController@activateToken',
                    'as'    => 'prodi.soal.aktifkan'
                ]);
                Route::put('/nonaktifkan/{id}', [
                    'uses'  => 'Prodi\PMB\SoalController@nonactivateToken',
                    'as'    => 'prodi.soal.nonaktifkan'
                ]);
                Route::delete('/hapus/{id}', [
                    'uses'  => 'Prodi\PMB\SoalController@destroy',
                    'as'    => 'prodi.soal.hapus'
                ]);
                Route::get('/unduh/{id}', [
                    'uses'  => 'Prodi\PMB\SoalController@export',
                    'as'    => 'prodi.soal.unduh'
                ]);
                //Group pertanyaan
                Route::group(['prefix' => 'pertanyaan'], function(){
                    Route::get('/{kodesoal}', [
                        'uses'  => 'Prodi\PMB\Pertanyaan\PertanyaanController@index',
                        'as'    => 'prodi.soal.pertanyaan'
                    ]);
                    Route::get('/{kodesoal}/data', [
                        'uses'  => 'Prodi\PMB\Pertanyaan\PertanyaanController@data',
                        'as'    => 'prodi.soal.data.pertanyaan'
                    ]);
                    Route::get('/{kodesoal}/form-tambah', [
                        'uses'  => 'Prodi\PMB\Pertanyaan\PertanyaanController@create',
                        'as'    => 'prodi.soal.pertanyaan.form_tambah'
                    ]);
                    Route::get('/{kodesoal}/form-ubah/{id}', [
                        'uses'  => 'Prodi\PMB\Pertanyaan\PertanyaanController@edit',
                        'as'    => 'prodi.soal.pertanyaan.form_ubah'
                    ]);
                    Route::post('/{kodesoal}/simpan', [
                        'uses'  => 'Prodi\PMB\Pertanyaan\PertanyaanController@store',
                        'as'    => 'prodi.soal.pertanyaan.simpan'
                    ]);
                    Route::put('/{kodesoal}/ubah/{id}', [
                        'uses'  => 'Prodi\PMB\Pertanyaan\PertanyaanController@update',
                        'as'    => 'prodi.soal.pertanyaan.ubah'
                    ]);
                    Route::delete('/{kodesoal}/hapus/{id}', [
                        'uses'  => 'Prodi\PMB\Pertanyaan\PertanyaanController@destroy',
                        'as'    => 'prodi.soal.pertanyaan.hapus'
                    ]);
                });
            });
        });
        Route::group(['prefix' => 'pertanyaan'], function(){
            Route::get('/{kodesoal}', [
                'uses'  => 'Dosen\PertanyaanController@index',
                'as'    => 'dosen.pertanyaan'
            ]);
            Route::get('/{kodesoal}/data', [
                'uses'  => 'Dosen\PertanyaanController@data',
                'as'    => 'dosen.data.pertanyaan'
            ]);
            Route::get('/{kodesoal}/form-tambah', [
                'uses'  => 'Dosen\PertanyaanController@create',
                'as'    => 'dosen.pertanyaan.form_tambah'
            ]);
            Route::get('/{kodesoal}/form-ubah/{id}', [
                'uses'  => 'Dosen\PertanyaanController@edit',
                'as'    => 'dosen.pertanyaan.form_ubah'
            ]);
            Route::post('/{kodesoal}/simpan', [
                'uses'  => 'Dosen\PertanyaanController@store',
                'as'    => 'dosen.pertanyaan.simpan'
            ]);
            Route::put('/{kodesoal}/ubah/{id}', [
                'uses'  => 'Dosen\PertanyaanController@update',
                'as'    => 'dosen.pertanyaan.ubah'
            ]);
            Route::delete('/{kodesoal}/hapus/{id}', [
                'uses'  => 'Dosen\PertanyaanController@destroy',
                'as'    => 'dosen.pertanyaan.hapus'
            ]);
        });
        Route::group(['prefix' => 'periksa'], function(){
            Route::get('/{kodesoal}', [
                'uses'  => 'Dosen\PeriksaController@index',
                'as'    => 'dosen.periksa'
            ]);
            Route::get('/{kodesoal}/data', [
                'uses'  => 'Dosen\PeriksaController@data',
                'as'    => 'dosen.data.periksa'
            ]);
            Route::get('/{kodesoal}/{nim}/form-periksa', [
                'uses'  => 'Dosen\PeriksaController@checkAnswer',
                'as'    => 'dosen.data.form_periksa'
            ]);
            Route::post('/{kodesoal}/{nim}/simpan', [
                'uses'  => 'Dosen\PeriksaController@store',
                'as'    => 'dosen.periksa.simpan'
            ]);
        });
        Route::group(['prefix' => 'nilai'], function(){
            Route::get('/{kodesoal}', [
                'uses'  => 'Dosen\NilaiController@index',
                'as'    => 'dosen.periksa'
            ]);
            Route::get('/{kodesoal}/data', [
                'uses'  => 'Dosen\NilaiController@data',
                'as'    => 'dosen.data.periksa'
            ]);
            Route::get('/{kodesoal}/{nim}/', [
                'uses'  => 'Dosen\NilaiController@checkAnswer',
                'as'    => 'dosen.data.form_periksa'
            ]);
        });
    });
});

Route::group(['prefix' => 'panitia'], function(){
    Route::group(['prefix' => 'autentikasi'], function(){
        Route::get('/form-login', [
            'uses' => 'Panitia\Autentikasi\AutentikasiController@showFormLogin',
            'as' => 'panitia.autentikasi.form_login'
        ]);
        Route::post('/login', [
            'uses' => 'Panitia\Autentikasi\AutentikasiController@login',
            'as' => 'panitia.autentikasi.login'
        ]);
        Route::post('/logout', [
            'uses' => 'Panitia\Autentikasi\AutentikasiController@logout',
            'as' => 'panitia.autentikasi.logout'
        ]);
    });
    Route::group(['middleware' => 'auth:panitia'], function(){
        Route::get('/', [
            'uses' => 'Panitia\PanitiaController@index',
            'as' => 'panitia.panitia'
        ]);
        Route::group(['prefix' => 'pmb'], function(){
            Route::group(['prefix' => 'pendaftaran'], function(){
                Route::get('/', [
                    'uses' => 'Panitia\PMB\PendaftaranController@index',
                    'as' => 'panitia.pmb.pendaftaran'
                ]);
                Route::get('/data', [
                    'uses' => 'Panitia\PMB\PendaftaranController@data',
                    'as' => 'panitia.pmb.pendaftaran.data'
                ]);
                Route::get('/aktifkan/{id}', [
                    'uses' => 'Panitia\PMB\PendaftaranController@active',
                    'as' => 'panitia.pmb.pendaftaran.aktifkan'
                ]);
            });
            Route::group(['prefix' => 'konfirmasi-pembayaran'], function(){
                Route::get('/', [
                    'uses' => 'Panitia\PMB\KonfirmasiPembayaranController@index',
                    'as' => 'panitia.pmb.konfirmasi_pembayaran'
                ]);
                Route::get('/data', [
                    'uses' => 'Panitia\PMB\KonfirmasiPembayaranController@data',
                    'as' => 'panitia.pmb.konfirmasi_pembayaran.data'
                ]);
                Route::get('/unduh/{id}', [
                    'uses' => 'Panitia\PMB\KonfirmasiPembayaranController@download',
                    'as' => 'panitia.pmb.konfirmasi_pembayaran.unduh'
                ]);
            });
            Route::group(['prefix' => 'gelombang'], function(){
                Route::get('/', [
                    'uses' => 'Panitia\PMB\GelombangController@index',
                    'as' => 'panitia.pmb.gelombang'
                ]);
                Route::get('/form-tambah', [
                    'uses' => 'Panitia\PMB\GelombangController@create',
                    'as' => 'panitia.pmb.gelombang.form_tambah'
                ]);
                Route::get('/form-ubah/{id}', [
                    'uses' => 'Panitia\PMB\GelombangController@edit',
                    'as' => 'panitia.pmb.gelombang.form_edit'
                ]);
                Route::post('/simpan', [
                    'uses' => 'Panitia\PMB\GelombangController@store',
                    'as' => 'panitia.pmb.gelombang.simpan'
                ]);
                Route::put('/ubah/{id}', [
                    'uses' => 'Panitia\PMB\GelombangController@update',
                    'as' => 'panitia.pmb.gelombang.ubah'
                ]);
                Route::delete('/hapus/{id}', [
                    'uses'  => 'Panitia\PMB\GelombangController@destroy',
                    'as' => 'panitia.pmb.gelombang.hapus'
                ]);
                Route::get('/data', [
                    'uses' => 'Panitia\PMB\GelombangController@data',
                    'as' => 'panitia.pmb.gelombang.data'
                ]);
            });
            Route::group(['prefix' => 'biaya'], function(){
                Route::get('/', [
                    'uses' => 'Panitia\PMB\BiayaController@index',
                    'as' => 'panitia.pmb.biaya'
                ]);
                Route::get('/form-tambah', [
                    'uses' => 'Panitia\PMB\BiayaController@create',
                    'as' => 'panitia.pmb.biaya.form_tambah'
                ]);
                Route::get('/form-ubah/{id}', [
                    'uses' => 'Panitia\PMB\BiayaController@edit',
                    'as' => 'panitia.pmb.biaya.form_edit'
                ]);
                Route::post('/simpan', [
                    'uses' => 'Panitia\PMB\BiayaController@store',
                    'as' => 'panitia.pmb.biaya.simpan'
                ]);
                Route::put('/ubah/{id}', [
                    'uses' => 'Panitia\PMB\BiayaController@update',
                    'as' => 'panitia.pmb.biaya.ubah'
                ]);
                Route::delete('/hapus/{id}', [
                    'uses'  => 'Panitia\PMB\BiayaController@destroy',
                    'as' => 'panitia.pmb.biaya.hapus'
                ]);
                Route::get('/data', [
                    'uses' => 'Panitia\PMB\BiayaController@data',
                    'as' => 'panitia.pmb.biaya.data'
                ]);
            });
            Route::group(['prefix' => 'potongan'], function(){
                Route::get('/', [
                    'uses' => 'Panitia\PMB\PotonganController@index',
                    'as' => 'panitia.pmb.potongan'
                ]);
                Route::get('/form-tambah', [
                    'uses' => 'Panitia\PMB\PotonganController@create',
                    'as' => 'panitia.pmb.potongan.form_tambah'
                ]);
                Route::get('/form-ubah/{id}', [
                    'uses' => 'Panitia\PMB\PotonganController@edit',
                    'as' => 'panitia.pmb.potongan.form_edit'
                ]);
                Route::post('/simpan', [
                    'uses' => 'Panitia\PMB\PotonganController@store',
                    'as' => 'panitia.pmb.potongan.simpan'
                ]);
                Route::put('/ubah/{id}', [
                    'uses' => 'Panitia\PMB\PotonganController@update',
                    'as' => 'panitia.pmb.potongan.ubah'
                ]);
                Route::delete('/hapus/{id}', [
                    'uses'  => 'Panitia\PMB\PotonganController@destroy',
                    'as' => 'panitia.pmb.potongan.hapus'
                ]);
                Route::get('/data', [
                    'uses' => 'Panitia\PMB\PotonganController@data',
                    'as' => 'panitia.pmb.potongan.data'
                ]);
            });
            Route::group(['prefix' => 'jadwal-ujian'], function(){
                Route::get('/', [
                    'uses' => 'Panitia\PMB\JadwalUjianController@index',
                    'as' => 'panitia.pmb.jadwal'
                ]);
                Route::get('/form-tambah', [
                    'uses' => 'Panitia\PMB\JadwalUjianController@create',
                    'as' => 'panitia.pmb.jadwal.form_tambah'
                ]);
                Route::get('/form-ubah/{id}', [
                    'uses' => 'Panitia\PMB\JadwalUjianController@edit',
                    'as' => 'panitia.pmb.jadwal.form_edit'
                ]);
                Route::post('/simpan', [
                    'uses' => 'Panitia\PMB\JadwalUjianController@store',
                    'as' => 'panitia.pmb.jadwal.simpan'
                ]);
                Route::put('/ubah/{id}', [
                    'uses' => 'Panitia\PMB\JadwalUjianController@update',
                    'as' => 'panitia.pmb.jadwal.ubah'
                ]);
                Route::delete('/hapus/{id}', [
                    'uses'  => 'Panitia\PMB\JadwalUjianController@destroy',
                    'as' => 'panitia.pmb.jadwal.hapus'
                ]);
                Route::get('/data', [
                    'uses' => 'Panitia\PMB\JadwalUjianController@data',
                    'as' => 'panitia.pmb.jadwal.data'
                ]);
                Route::get('/cek/{start_exam}', [
                    'uses' => 'Panitia\PMB\JadwalUjianController@checkData',
                    'as' => 'panitia.pmb.jadwal.cek_data'
                ]);
                Route::get('/kirim-jadwal-ujian/{id}/{kode}', [
                    'uses' => 'Panitia\PMB\JadwalUjianController@sendEmail',
                    'as' => 'panitia.pmb.jadwal.kirim_email'
                ]);
                Route::get('/cek-peserta/{kode_jurusan}/{kode_gelombang}/{status_pendaftaran}', [
                    'uses' => 'Panitia\PMB\JadwalUjianController@checkPeserta',
                    'as' => 'panitia.pmb.jadwal.cek_peserta'
                ]);
                Route::get('/cek-ubah-peserta/{kode_jurusan}/{kode_gelombang}/{status_pendaftaran}', [
                    'uses' => 'Panitia\PMB\JadwalUjianController@checkUbahPeserta',
                    'as' => 'panitia.pmb.jadwal.cek_ubah_peserta'
                ]);
            });
            Route::group(['prefix' => 'nilai-kelulusan'], function(){
                Route::get('/', [
                    'uses' => 'Panitia\PMB\NilaiLulusController@index',
                    'as' => 'panitia.pmb.nilai_lulus'
                ]);
                Route::get('/form-tambah', [
                    'uses' => 'Panitia\PMB\NilaiLulusController@create',
                    'as' => 'panitia.pmb.nilai_lulus.form_tambah'
                ]);
                Route::get('/form-ubah/{id}', [
                    'uses' => 'Panitia\PMB\NilaiLulusController@edit',
                    'as' => 'panitia.pmb.nilai_lulus.form_edit'
                ]);
                Route::post('/simpan', [
                    'uses' => 'Panitia\PMB\NilaiLulusController@store',
                    'as' => 'panitia.pmb.nilai_lulus.simpan'
                ]);
                Route::put('/ubah/{id}', [
                    'uses' => 'Panitia\PMB\NilaiLulusController@update',
                    'as' => 'panitia.pmb.nilai_lulus.ubah'
                ]);
                Route::delete('/hapus/{id}', [
                    'uses'  => 'Panitia\PMB\NilaiLulusController@destroy',
                    'as' => 'panitia.pmb.nilai_lulus.hapus'
                ]);
                Route::get('/data', [
                    'uses' => 'Panitia\PMB\NilaiLulusController@data',
                    'as' => 'panitia.pmb.nilai_lulus.data'
                ]);
            });
            Route::group(['prefix' => 'jawaban-ujian'], function(){
                Route::get('{kode_jadwal_ujian}/', [
                    'uses' => 'Panitia\PMB\JawabanController@index',
                    'as' => 'panitia.pmb.hasil_ujian'
                ]);
                Route::get('{kode_jadwal_ujian}/detail/{kode_pendaftaran}/{kode_soal}', [
                    'uses' => 'Panitia\PMB\JawabanController@show',
                    'as' => 'panitia.pmb.hasil_ujian.detail'
                ]);
                Route::get('{kode_jadwal_ujian}/unduh/{kode_pendaftaran}', [
                    'uses' => 'Panitia\PMB\JawabanController@downloadJawaban',
                    'as' => 'panitia.pmb.hasil_ujian.unduh'
                ]);
                Route::get('{kode_jadwal_ujian}/data', [
                    'uses' => 'Panitia\PMB\JawabanController@data',
                    'as' => 'panitia.pmb.hasil_ujian.data'
                ]);
                Route::get('{kode_jadwal_ujian}/data/cari/{kode_jurusan}/{kode_gelombang}/{kode_kelas}/{tahun}', [
                    'uses' => 'Panitia\PMB\JawabanController@dataFilter',
                    'as' => 'panitia.pmb.hasil_ujian.data_filter'
                ]);
            });
            Route::group(['prefix' => 'hasil-ujian'], function(){
                Route::get('{kode_jadwal_ujian}/', [
                    'uses' => 'Panitia\PMB\HasilController@index',
                    'as' => 'panitia.pmb.hasil_ujian'
                ]);
                Route::get('{JadwalUjian}/form-ubah/{id}', [
                    'uses' => 'Panitia\PMB\HasilController@edit',
                    'as' => 'panitia.pmb.hasil_ujian.form_edit'
                ]);
                Route::put('{JadwalUjian}/ubah/{id}', [
                    'uses' => 'Panitia\PMB\HasilController@update',
                    'as' => 'panitia.pmb.hasil_ujian.ubah'
                ]);
                Route::get('{jadwalUjian}/data', [
                    'uses' => 'Panitia\PMB\HasilController@data',
                    'as' => 'panitia.pmb.hasil_ujian.data'
                ]);
                Route::get('{jadwalUjian}/data/cari/{kode_jurusan}/{kode_gelombang}/{kode_kelas}/{tahun}', [
                    'uses' => 'Panitia\PMB\HasilController@dataFilter',
                    'as' => 'panitia.pmb.hasil_ujian.data_filter'
                ]);
                Route::get('{JadwalUjian}/unduh/{id}', [
                    'uses' => 'Panitia\PMB\HasilController@downloadKelulusan',
                    'as' => 'panitia.pmb.hasil_ujian.unduh'
                ]);
            });
            Route::group(['prefix' => 'hasil-ujian-update'], function(){
                Route::get('{kode_jadwal_ujian}/', [
                    'uses' => 'Panitia\PMB\HasilUpdateController@index',
                    'as' => 'panitia.pmb.hasil_ujian_update'
                ]);
                Route::get('{kode_jadwal_ujian}/data', [
                    'uses' => 'Panitia\PMB\HasilUpdateController@data',
                    'as' => 'panitia.pmb.hasil_ujian_update.data'
                ]);
                Route::post('{kode_jadwal_ujian}/simpan', [
                    'uses' => 'Panitia\PMB\HasilUpdateController@store',
                    'as' => 'panitia.pmb.hasil_ujian_update_table.simpan'
                ]);
                Route::get('{kode_jadwal_ujian}/kirim-email/{id}', [
                    'uses' => 'Panitia\PMB\HasilUpdateController@sendEmail',
                    'as' => 'panitia.pmb.hasil_ujian_update.kirim_email'
                ]);
                Route::get('{kode_jadwal_ujian}/unduh/{id}', [
                    'uses' => 'Panitia\PMB\HasilUpdateController@downloadKelulusanBiaya',
                    'as' => 'panitia.pmb.hasil_ujian_update.unduh'
                ]);
            });
            Route::group(['prefix' => 'kehadiran'], function(){
                Route::get('/', [
                    'uses' => 'Panitia\PMB\KehadiranController@index',
                    'as' => 'panitia.pmb.kehadiran'
                ]);
                Route::get('/data', [
                    'uses' => 'Panitia\PMB\KehadiranController@data',
                    'as' => 'panitia.pmb.kehadiran.data'
                ]);
            });
            Route::group(['prefix' => 'laporan'], function(){
                Route::get('/', [
                    'uses' => 'Panitia\PMB\LaporanController@index',
                    'as' => 'panitia.pmb.laporan'
                ]);
                Route::get('/data', [
                    'uses' => 'Panitia\PMB\LaporanController@data',
                    'as' => 'panitia.pmb.laporan.data'
                ]);
                Route::get('/filter/jurusan/{jurusan}/{tahun}', [
                    'uses' => 'Panitia\PMB\LaporanController@filterJurusan',
                    'as' => 'panitia.pmb.laporan.filter_jurusan'
                ]);
                Route::get('/filter/tahun/{tahun}', [
                    'uses' => 'Panitia\PMB\LaporanController@filterTahun',
                    'as' => 'panitia.pmb.laporan.filter_tahun'
                ]);
                Route::get('/filter/sesi/{sesi}', [
                    'uses' => 'Panitia\PMB\LaporanController@filterSesi',
                    'as' => 'panitia.pmb.laporan.filter_sesi'
                ]);
                Route::get('/filter/pendaftaran/{pendaftaran}', [
                    'uses' => 'Panitia\PMB\LaporanController@filterPendaftaran',
                    'as' => 'panitia.pmb.laporan.filter_pendaftaran'
                ]);
                Route::get('/filter/status/{status}', [
                    'uses' => 'Panitia\PMB\LaporanController@filterStatus',
                    'as' => 'panitia.pmb.laporan.filter_status'
                ]);
                Route::get('/unduh/{tahun}', [
                    'uses' => 'Panitia\PMB\LaporanController@downloadExcel',
                    'as' => 'panitia.pmb.laporan.unduh'
                ]);
                Route::get('/grafik', [
                    'uses' => 'Panitia\PMB\LaporanController@chart',
                    'as' => 'panitia.pmb.grafik'
                ]);
                Route::get('/grafik/filter/{tahun}', [
                    'uses' => 'Panitia\PMB\LaporanController@chartFilterTahun',
                    'as' => 'panitia.pmb.grafik_filter_tahun'
                ]);
            });
            Route::group(['prefix' => 'formulir'], function(){
                Route::get('/', [
                    'uses' => 'Panitia\PMB\FormulirController@index',
                    'as' => 'panitia.pmb.formulir'
                ]);
                Route::get('/form-tambah', [
                    'uses' => 'Panitia\PMB\FormulirController@create',
                    'as' => 'panitia.pmb.formulir.form_tambah'
                ]);
                Route::get('/form-ubah/{id}', [
                    'uses' => 'Panitia\PMB\FormulirController@edit',
                    'as' => 'panitia.pmb.formulir.form_edit'
                ]);
                Route::post('/simpan', [
                    'uses' => 'Panitia\PMB\FormulirController@store',
                    'as' => 'panitia.pmb.formulir.simpan'
                ]);
                Route::put('/ubah/{id}', [
                    'uses' => 'Panitia\PMB\FormulirController@update',
                    'as' => 'panitia.pmb.formulir.ubah'
                ]);
                Route::delete('/hapus/{id}', [
                    'uses'  => 'Panitia\PMB\FormulirController@destroy',
                    'as' => 'panitia.pmb.formulir.hapus'
                ]);
                Route::get('/data', [
                    'uses' => 'Panitia\PMB\FormulirController@data',
                    'as' => 'panitia.pmb.formulir.data'
                ]);
                Route::get('/detail/{id}', [
                    'uses' => 'Panitia\PMB\FormulirController@show',
                    'as' => 'panitia.pmb.formulir.detail'
                ]);
                Route::get('/unduh-formulir/{id}', [
                    'uses' => 'Panitia\PMB\FormulirController@downloadFormulir',
                    'as' => 'panitia.pmb.formulir.download'
                ]);
                Route::get('/unduh-kelengkapan/{id}', [
                    'uses' => 'Panitia\PMB\FormulirController@downloadKelengkapan',
                    'as' => 'panitia.pmb.formulir.download'
                ]);
            });
            Route::group(['prefix' => 'peserta-ujian'], function(){
                Route::get('/{kode_jadwal_ujian}', [
                    'uses' => 'Panitia\PMB\PesertaController@index',
                    'as' => 'panitia.pmb.peserta-ujian'
                ]);
                Route::get('/{kode_jadwal_ujian}/form-tambah', [
                    'uses' => 'Panitia\PMB\PesertaController@create',
                    'as' => 'panitia.pmb.peserta-ujian.form_tambah'
                ]);
                Route::get('/{kode_jadwal_ujian}/form-ubah/{id}', [
                    'uses' => 'Panitia\PMB\PesertaController@edit',
                    'as' => 'panitia.pmb.peserta-ujian.form_edit'
                ]);
                Route::post('/{kode_jadwal_ujian}/simpan', [
                    'uses' => 'Panitia\PMB\PesertaController@store',
                    'as' => 'panitia.pmb.peserta-ujian.simpan'
                ]);
                Route::put('/{kode_jadwal_ujian}/ubah/{id}', [
                    'uses' => 'Panitia\PMB\PesertaController@update',
                    'as' => 'panitia.pmb.peserta-ujian.ubah'
                ]);
                Route::delete('/{kode_jadwal_ujian}/hapus/{id}', [
                    'uses'  => 'Panitia\PMB\PesertaController@destroy',
                    'as' => 'panitia.pmb.peserta-ujian.hapus'
                ]);
                Route::get('/{kode_jadwal_ujian}/data', [
                    'uses' => 'Panitia\PMB\PesertaController@data',
                    'as' => 'panitia.pmb.peserta-ujian.data'
                ]);
                Route::get('/{kode_jadwal_ujian}/kirim-email/{kode_pendaftaran}', [
                    'uses' => 'Panitia\PMB\PesertaController@sendEmail',
                    'as' => 'panitia.pmb.peserta-ujian.kirim_email'
                ]);
                Route::get('/{kode_jadwal_ujian}/broadcast-email/', [
                    'uses' => 'Panitia\PMB\PesertaController@broadcastEmail',
                    'as' => 'panitia.pmb.peserta-ujian.broadcast_email'
                ]);
            });
            Route::group(['prefix' => 'konfirmasi-pembayaran'], function(){
                Route::get('/', [
                    'uses' => 'Panitia\PMB\KonfirmasiPembayaranController@index',
                    'as' => 'panitia.pmb.formulir'
                ]);
                Route::get('/data', [
                    'uses' => 'Panitia\PMB\KonfirmasiPembayaranController@data',
                    'as' => 'panitia.pmb.formulir.data'
                ]);
                Route::get('/unduh-formulir/{id}', [
                    'uses' => 'Panitia\PMB\KonfirmasiPembayaranController@downloadFormulir',
                    'as' => 'panitia.pmb.formulir.download'
                ]);
            });
            Route::group(['prefix' => 'jawaban-ujian'], function(){
                Route::get('/', [
                    'uses' => 'Panitia\PMB\JawabanController@index',
                    'as' => 'panitia.pmb.formulir'
                ]);
                Route::get('/data', [
                    'uses' => 'Panitia\PMB\JawabanController@data',
                    'as' => 'panitia.pmb.formulir.data'
                ]);
                Route::get('/unduh-formulir/{id}', [
                    'uses' => 'Panitia\PMB\JawabanController@downloadFormulir',
                    'as' => 'panitia.pmb.formulir.download'
                ]);
            });
        });
    });
});

Route::group(['prefix' => 'keuangan'], function(){
    Route::group(['prefix' => 'autentikasi'], function(){
        Route::get('/form-login', [
            'uses' => 'Keuangan\Autentikasi\AutentikasiController@showFormLogin',
            'as' => 'keuangan.autentikasi.form_login'
        ]);
        Route::post('/login', [
            'uses' => 'Keuangan\Autentikasi\AutentikasiController@login',
            'as' => 'keuangan.autentikasi.login'
        ]);
        Route::post('/logout', [
            'uses' => 'Keuangan\Autentikasi\AutentikasiController@logout',
            'as' => 'keuangan.autentikasi.logout'
        ]);
    });
    Route::group(['middleware' => 'auth:keuangan'], function(){
        Route::get('/', [
            'uses' => 'Keuangan\KeuanganController@index',
            'as' => 'keuangan.keuangan'
        ]);
        Route::group(['prefix' => 'gelombang'], function(){
            Route::get('/', [
                'uses' => 'Keuangan\GelombangController@index',
                'as' => 'keuangan.gelombang'
            ]);
            Route::get('/form-tambah', [
                'uses' => 'Keuangan\GelombangController@create',
                'as' => 'keuangan.gelombang.form_tambah'
            ]);
            Route::get('/form-ubah/{id}', [
                'uses' => 'Keuangan\GelombangController@edit',
                'as' => 'keuangan.gelombang.form_edit'
            ]);
            Route::post('/simpan', [
                'uses' => 'Keuangan\GelombangController@store',
                'as' => 'keuangan.gelombang.simpan'
            ]);
            Route::put('/ubah/{id}', [
                'uses' => 'Keuangan\GelombangController@update',
                'as' => 'keuangan.gelombang.ubah'
            ]);
            Route::delete('/hapus/{id}', [
                'uses'  => 'Keuangan\GelombangController@destroy',
                'as' => 'keuangan.gelombang.hapus'
            ]);
            Route::get('/data', [
                'uses' => 'Keuangan\GelombangController@data',
                'as' => 'keuangan.gelombang.data'
            ]);
        });
        Route::group(['prefix' => 'biaya'], function(){
            Route::get('/', [
                'uses' => 'Keuangan\BiayaController@index',
                'as' => 'keuangan.pmb.biaya'
            ]);
            Route::get('/form-tambah', [
                'uses' => 'Keuangan\BiayaController@create',
                'as' => 'keuangan.pmb.biaya.form_tambah'
            ]);
            Route::get('/form-ubah/{id}', [
                'uses' => 'Keuangan\BiayaController@edit',
                'as' => 'keuangan.pmb.biaya.form_edit'
            ]);
            Route::post('/simpan', [
                'uses' => 'Keuangan\BiayaController@store',
                'as' => 'keuangan.pmb.biaya.simpan'
            ]);
            Route::put('/ubah/{id}', [
                'uses' => 'Keuangan\BiayaController@update',
                'as' => 'keuangan.pmb.biaya.ubah'
            ]);
            Route::delete('/hapus/{id}', [
                'uses'  => 'Keuangan\BiayaController@destroy',
                'as' => 'keuangan.pmb.biaya.hapus'
            ]);
            Route::get('/data', [
                'uses' => 'Keuangan\BiayaController@data',
                'as' => 'keuangan.pmb.biaya.data'
            ]);
        });
        Route::group(['prefix' => 'biaya-heregistrasi'], function(){
            Route::get('/', [
                'uses' => 'Keuangan\BiayaHeregistrasiController@index',
                'as' => 'keuangan.pmb.biaya'
            ]);
            Route::get('/form-tambah', [
                'uses' => 'Keuangan\BiayaHeregistrasiController@create',
                'as' => 'keuangan.pmb.biaya.form_tambah'
            ]);
            Route::get('/form-ubah/{id}', [
                'uses' => 'Keuangan\BiayaHeregistrasiController@edit',
                'as' => 'keuangan.pmb.biaya.form_edit'
            ]);
            Route::post('/simpan', [
                'uses' => 'Keuangan\BiayaHeregistrasiController@store',
                'as' => 'keuangan.pmb.biaya.simpan'
            ]);
            Route::put('/ubah/{id}', [
                'uses' => 'Keuangan\BiayaHeregistrasiController@update',
                'as' => 'keuangan.pmb.biaya.ubah'
            ]);
            Route::delete('/hapus/{id}', [
                'uses'  => 'Keuangan\BiayaHeregistrasiController@destroy',
                'as' => 'keuangan.pmb.biaya.hapus'
            ]);
            Route::get('/data', [
                'uses' => 'Keuangan\BiayaHeregistrasiController@data',
                'as' => 'keuangan.pmb.biaya.data'
            ]);
        });
        Route::group(['prefix' => 'detail-biaya'], function(){
            Route::get('/{kode_biaya}', [
                'uses' => 'Keuangan\DetailBiayaController@index',
                'as' => 'keuangan.pmb.biaya'
            ]);
            Route::get('/{kode_biaya}/form-tambah', [
                'uses' => 'Keuangan\DetailBiayaController@create',
                'as' => 'keuangan.pmb.biaya.form_tambah'
            ]);
            Route::get('/{kode_biaya}/form-ubah/{id}', [
                'uses' => 'Keuangan\DetailBiayaController@edit',
                'as' => 'keuangan.pmb.biaya.form_edit'
            ]);
            Route::post('/{kode_biaya}/simpan', [
                'uses' => 'Keuangan\DetailBiayaController@store',
                'as' => 'keuangan.pmb.biaya.simpan'
            ]);
            Route::put('/{kode_biaya}/ubah/{id}', [
                'uses' => 'Keuangan\DetailBiayaController@update',
                'as' => 'keuangan.pmb.biaya.ubah'
            ]);
            Route::delete('/{kode_biaya}/hapus/{id}', [
                'uses'  => 'Keuangan\DetailBiayaController@destroy',
                'as' => 'keuangan.pmb.biaya.hapus'
            ]);
            Route::get('/{kode_biaya}/data', [
                'uses' => 'Keuangan\DetailBiayaController@data',
                'as' => 'keuangan.pmb.biaya.data'
            ]);
        });
        Route::group(['prefix' => 'potongan'], function(){
            Route::get('/', [
                'uses' => 'Keuangan\PotonganController@index',
                'as' => 'keuangan.potongan'
            ]);
            Route::get('/form-tambah', [
                'uses' => 'Keuangan\PotonganController@create',
                'as' => 'keuangan.potongan.form_tambah'
            ]);
            Route::get('/form-ubah/{id}', [
                'uses' => 'Keuangan\PotonganController@edit',
                'as' => 'keuangan.potongan.form_edit'
            ]);
            Route::post('/simpan', [
                'uses' => 'Keuangan\PotonganController@store',
                'as' => 'keuangan.potongan.simpan'
            ]);
            Route::put('/ubah/{id}', [
                'uses' => 'Keuangan\PotonganController@update',
                'as' => 'keuangan.potongan.ubah'
            ]);
            Route::delete('/hapus/{id}', [
                'uses'  => 'Keuangan\PotonganController@destroy',
                'as' => 'keuangan.potongan.hapus'
            ]);
            Route::get('/data', [
                'uses' => 'Keuangan\PotonganController@data',
                'as' => 'keuangan.potongan.data'
            ]);
        });
        Route::group(['prefix' => 'detail-potongan'], function(){
            Route::get('/{kode_potongan}', [
                'uses' => 'Keuangan\DetailPotonganController@index',
                'as' => 'keuangan.pmb.detail_potongan'
            ]);
            Route::get('/{kode_potongan}/form-tambah', [
                'uses' => 'Keuangan\DetailPotonganController@create',
                'as' => 'keuangan.pmb.detail_potongan.form_tambah'
            ]);
            Route::get('/{kode_potongan}/form-ubah/{id}', [
                'uses' => 'Keuangan\DetailPotonganController@edit',
                'as' => 'keuangan.pmb.detail_potongan.form_edit'
            ]);
            Route::post('/{kode_potongan}/simpan', [
                'uses' => 'Keuangan\DetailPotonganController@store',
                'as' => 'keuangan.pmb.detail_potongan.simpan'
            ]);
            Route::put('/{kode_potongan}/ubah/{id}', [
                'uses' => 'Keuangan\DetailPotonganController@update',
                'as' => 'keuangan.pmb.detail_potongan.ubah'
            ]);
            Route::delete('/{kode_potongan}/hapus/{id}', [
                'uses'  => 'Keuangan\DetailPotonganController@destroy',
                'as' => 'keuangan.pmb.detail_potongan.hapus'
            ]);
            Route::get('/{kode_potongan}/data', [
                'uses' => 'Keuangan\DetailPotonganController@data',
                'as' => 'keuangan.pmb.detail_potongan.data'
            ]);
        });
        Route::group(['prefix' => 'detail-gelombang'], function(){
            Route::get('/{kode_gelombang}', [
                'uses' => 'Keuangan\DetailGelombangController@index',
                'as' => 'keuangan.pmb.biaya'
            ]);
            Route::get('/{kode_gelombang}/form-tambah', [
                'uses' => 'Keuangan\DetailGelombangController@create',
                'as' => 'keuangan.pmb.detail_gelombang.form_tambah'
            ]);
            Route::get('/{kode_gelombang}/form-ubah/{id}', [
                'uses' => 'Keuangan\DetailGelombangController@edit',
                'as' => 'keuangan.pmb.detail_gelombang.form_edit'
            ]);
            Route::post('/{kode_gelombang}/simpan', [
                'uses' => 'Keuangan\DetailGelombangController@store',
                'as' => 'keuangan.pmb.detail_gelombang.simpan'
            ]);
            Route::put('/{kode_gelombang}/ubah/{id}', [
                'uses' => 'Keuangan\DetailGelombangController@update',
                'as' => 'keuangan.pmb.detail_gelombang.ubah'
            ]);
            Route::delete('/{kode_gelombang}/hapus/{id}', [
                'uses'  => 'Keuangan\DetailGelombangController@destroy',
                'as' => 'keuangan.pmb.detail_gelombang.hapus'
            ]);
            Route::get('/{kode_gelombang}/data', [
                'uses' => 'Keuangan\DetailGelombangController@data',
                'as' => 'keuangan.pmb.detail_gelombang.data'
            ]);
        });
        Route::group(['prefix' => 'pendaftaran'], function(){
            Route::get('/', [
                'uses' => 'Keuangan\PendaftaranController@index',
                'as' => 'keuangan.pendaftaran'
            ]);
            Route::get('/data', [
                'uses' => 'Keuangan\PendaftaranController@data',
                'as' => 'keuangan.pendaftaran.data'
            ]);
            Route::get('/aktifkan/{id}', [
                'uses' => 'Keuangan\PendaftaranController@active',
                'as' => 'keuangan.pendaftaran.aktifkan'
            ]);
        });
        Route::group(['prefix' => 'konfirmasi-pembayaran'], function(){
            Route::get('/', [
                'uses' => 'Keuangan\KonfirmasiPembayaranController@index',
                'as' => 'keuangan.konfirmasi_pembayaran'
            ]);
            Route::get('/data', [
                'uses' => 'Keuangan\KonfirmasiPembayaranController@data',
                'as' => 'keuangan.konfirmasi_pembayaran.data'
            ]);
            Route::get('/unduh/{id}', [
                'uses' => 'Keuangan\KonfirmasiPembayaranController@download',
                'as' => 'keuangan.konfirmasi_pembayaran.unduh'
            ]);
        });
        Route::group(['prefix' => 'formulir'], function(){
            Route::get('/', [
                'uses' => 'Keuangan\FormulirController@index',
                'as' => 'keuangan.formulir'
            ]);
            Route::get('/form-tambah', [
                'uses' => 'Keuangan\FormulirController@create',
                'as' => 'keuangan.formulir.form_tambah'
            ]);
            Route::get('/form-ubah/{id}', [
                'uses' => 'Keuangan\FormulirController@edit',
                'as' => 'keuangan.formulir.form_edit'
            ]);
            Route::post('/simpan', [
                'uses' => 'Keuangan\FormulirController@store',
                'as' => 'keuangan.formulir.simpan'
            ]);
            Route::put('/ubah/{id}', [
                'uses' => 'Keuangan\FormulirController@update',
                'as' => 'keuangan.formulir.ubah'
            ]);
            Route::delete('/hapus/{id}', [
                'uses'  => 'Keuangan\FormulirController@destroy',
                'as' => 'keuangan.formulir.hapus'
            ]);
            Route::get('/data', [
                'uses' => 'Keuangan\FormulirController@data',
                'as' => 'keuangan.formulir.data'
            ]);
            Route::get('/detail/{id}', [
                'uses' => 'Keuangan\FormulirController@show',
                'as' => 'keuangan.formulir.detail'
            ]);
            Route::get('/unduh-formulir/{id}', [
                'uses' => 'Keuangan\FormulirController@downloadFormulir',
                'as' => 'keuangan.formulir.download'
            ]);
            Route::get('/unduh-kelengkapan/{id}', [
                'uses' => 'Keuangan\FormulirController@downloadKelengkapan',
                'as' => 'keuangan.formulir.download'
            ]);
        });
    });
});

Route::group(['prefix' => 'pmb'], function(){
    Route::group(['prefix' => 'autentikasi'], function(){
        Route::get('/form-login', [
            'uses' => 'PMB\Autentikasi\AutentikasiController@showFormLogin',
            'as' => 'pmb.autentikasi.form_login'
        ]);
        Route::post('/login', [
            'uses' => 'PMB\Autentikasi\AutentikasiController@login',
            'as' => 'pmb.autentikasi.login'
        ]);
        Route::post('/logout', [
            'uses' => 'PMB\Autentikasi\AutentikasiController@logout',
            'as' => 'pmb.autentikasi.logout'
        ]);
    });
    Route::group(['middleware' => 'auth:calon_mahasiswa'], function(){
        Route::get('/', [
            'uses' => 'PMB\PMBController@index',
            'as' => 'pmb.pmb'
        ]);
        Route::group(['prefix' => 'ujian'], function(){
            Route::group(['prefix' => 'soal'], function(){
                Route::get('/', [
                    'uses' => 'PMB\SoalController@index',
                    'as' => 'pmb.ujian'
                ]);
                Route::get('/cari', [
                    'uses' => 'PMB\SoalController@find',
                    'as' => 'pmb.ujian.soal.cari'
                ]);
                Route::get('/cek-token/{token}', [
                    'uses' => 'PMB\SoalController@checkToken',
                    'as' => 'pmb.ujian.soal.cektoken'
                ]);
                Route::get('/mulai/{kodesoal}/{token}', [
                    'uses' => 'PMB\SoalController@startExam',
                    'as' => 'pmb.ujian.soal.cari'
                ]);
                Route::post('/selesai', [
                    'uses' => 'PMB\SoalController@store',
                    'as' => 'pmb.ujian.soal.selesai'
                ]);
            });
        });
        Route::group(['prefix' => 'hasil'], function(){
            Route::get('/', [
                'uses' => 'Mahasiswa\HasilController@index',
                'as' => 'mahasiswa.hasil'
            ]);
            Route::get('/data', [
                'uses' => 'Mahasiswa\HasilController@data',
                'as' => 'mahasiswa.hasil.data'
            ]);
        });
    });
});
