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

// Route::group(['prefix' => 'pmb'], function(){
//     Route::group(['prefix' => 'pendaftaran'], function(){

//     });
// });

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
                Route::get('/kirim-jadwal-ujian/{id}/{kode_soal}/{kode_gelombang}/{kode_jurusan}/{status_pendaftaran}', [
                    'uses' => 'Panitia\PMB\JadwalUjianController@sendEmail',
                    'as' => 'panitia.pmb.jadwal.kirim_email'
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
                Route::get('{kode_jadwal_ujian}/detail/{kode_pendaftaran}', [
                    'uses' => 'Panitia\PMB\JawabanController@show',
                    'as' => 'panitia.pmb.hasil_ujian.detail'
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
                Route::get('/form-ubah/{id}', [
                    'uses' => 'Panitia\PMB\HasilController@edit',
                    'as' => 'panitia.pmb.hasil_ujian.form_edit'
                ]);
                Route::put('/ubah/{id}', [
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
