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

Route::group(['prefix' => 'pmb'], function(){
    Route::group(['prefix' => 'pendaftaran'], function(){
        Route::get('/', [
            'uses' => 'pmb\PendaftaranController@formPendaftaran',
            'as' => 'pmb.pendaftaran.form_pendaftaran'
        ]);
        Route::post('/simpan', [
            'uses' => 'pmb\PendaftaranController@store',
            'as' => 'pmb.pendaftaran.simpan'
        ]);
    });
    // Route::group([
    //     'prefix' => 'ujian',
    //     'middleware' => 'auth:calon_mahasiswa'
    // ], function(){
        
    // });
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

Route::group(['prefix' => 'mahasiswa'], function(){
    Route::group(['prefix' => 'autentikasi'], function(){
        Route::get('/form-login', [
            'uses' => 'Mahasiswa\Autentikasi\AutentikasiController@showFormLogin',
            'as' => 'mahasiswa.autentikasi.form_login'
        ]);
        Route::post('/login', [
            'uses' => 'Mahasiswa\Autentikasi\AutentikasiController@login',
            'as' => 'mahasiswa.autentikasi.login'
        ]);
        Route::post('/logout', [
            'uses' => 'Mahasiswa\Autentikasi\AutentikasiController@logout',
            'as' => 'mahasiswa.autentikasi.logout'
        ]);
    });
    Route::group(['middleware' => 'auth:mahasiswa'], function(){
        Route::get('/', [
            'uses' => 'Mahasiswa\MahasiswaController@index',
            'as' => 'mahasiswa.mahasiswa'
        ]);
        Route::group(['prefix' => 'ujian'], function(){
            Route::group(['prefix' => 'soal'], function(){
                Route::get('/', [
                    'uses' => 'Mahasiswa\SoalController@index',
                    'as' => 'mahasiswa.ujian'
                ]);
                Route::get('/cari', [
                    'uses' => 'Mahasiswa\SoalController@find',
                    'as' => 'mahasiswa.ujian.soal.cari'
                ]);
                Route::get('/cek-token/{token}', [
                    'uses' => 'Mahasiswa\SoalController@checkToken',
                    'as' => 'mahasiswa.ujian.soal.cektoken'
                ]);
                Route::get('/mulai/{kodesoal}/{token}', [
                    'uses' => 'Mahasiswa\SoalController@startExam',
                    'as' => 'mahasiswa.ujian.soal.cari'
                ]);
                Route::post('/selesai', [
                    'uses' => 'Mahasiswa\SoalController@store',
                    'as' => 'mahasiswa.ujian.soal.selesai'
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


Route::group(['prefix' => 'prodi'], function(){
   Route::group(['prefix' => 'autentikasi'], function(){
        Route::get('/form-login', [
            'uses' => 'Dosen\Autentikasi\AutentikasiController@showFormLogin',
            'as' => 'dosen.autentikasi.form_login'
        ]);
        Route::post('/login', [
            'uses' => 'Dosen\Autentikasi\AutentikasiController@login',
            'as' => 'dosen.autentikasi.login'
        ]);
        Route::post('/logout', [
            'uses' => 'Dosen\Autentikasi\AutentikasiController@logout',
            'as' => 'dosen.autentikasi.logout'
        ]);
    });
    Route::group(['middleware' => 'auth:panitia'], function(){
        Route::get('/', [
            'uses' => 'Dosen\DosenController@index',
            'as' => 'dosen.dosen'
        ]);
        Route::group(['prefix' => 'soal'], function(){
            Route::get('/', [
                'uses'  => 'Dosen\SoalController@index',
                'as'    => 'dosen.soal'
            ]);
            Route::get('/form-tambah', [
                'uses'  => 'Dosen\SoalController@create',
                'as'    => 'dosen.soal.form_tambah'
            ]);
            Route::get('/form-ubah/{id}', [
                'uses'  => 'Dosen\SoalController@edit',
                'as'    => 'dosen.soal.form_ubah'
            ]);
            Route::get('/data', [
                'uses'  => 'Dosen\SoalController@data',
                'as'    => 'dosen.data.soal'
            ]);
            Route::post('/simpan', [
                'uses'  => 'Dosen\SoalController@store',
                'as'    => 'dosen.soal.simpan'
            ]);
            Route::put('/ubah/{id}', [
                'uses'  => 'Dosen\SoalController@update',
                'as'    => 'dosen.soal.ubah'
            ]);
            Route::put('/aktifkan/{id}', [
                'uses'  => 'Dosen\SoalController@activateToken',
                'as'    => 'dosen.soal.aktifkan'
            ]);
            Route::put('/nonaktifkan/{id}', [
                'uses'  => 'Dosen\SoalController@nonactivateToken',
                'as'    => 'dosen.soal.nonaktifkan'
            ]);
            Route::delete('/hapus/{id}', [
                'uses'  => 'Dosen\SoalController@destroy',
                'as'    => 'dosen.soal.hapus'
            ]);
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
