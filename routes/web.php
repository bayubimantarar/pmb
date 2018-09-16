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

Route::group(['prefix' => 'dasbor'], function(){
    Route::get('/', [
        'uses'  => 'Dasbor\DasborController@index',
        'as'    => 'dasbor'
    ]);
    Route::group(['prefix' => 'dosen'], function(){
        Route::get('/', [
            'uses'  => 'Dasbor\DosenController@index',
            'as'    => 'dasbor.dosen'
        ]);
        Route::get('/form-tambah', [
            'uses'  => 'Dasbor\DosenController@create',
            'as'    => 'dasbor.dosen.form_tambah'
        ]);
        Route::get('/form-ubah/{id}', [
            'uses'  => 'Dasbor\DosenController@edit',
            'as'    => 'dasbor.dosen.form_ubah'
        ]);
        Route::get('/data', [
            'uses'  => 'Dasbor\DosenController@data',
            'as'    => 'dasbor.data.dosen'
        ]);
        Route::post('/simpan', [
            'uses'  => 'Dasbor\DosenController@store',
            'as'    => 'dasbor.dosen.simpan'
        ]);
        Route::put('/ubah/{id}', [
            'uses'  => 'Dasbor\DosenController@update',
            'as'    => 'dasbor.dosen.ubah'
        ]);
        Route::delete('/hapus/{id}', [
            'uses'  => 'Dasbor\DosenController@destroy',
            'as'    => 'dasbor.dosen.hapus'
        ]);
    });
    Route::group(['prefix' => 'mahasiswa'], function(){
        Route::get('/', [
            'uses'  => 'Dasbor\MahasiswaController@index',
            'as'    => 'dasbor.mahasiswa'
        ]);
        Route::get('/form-tambah', [
            'uses'  => 'Dasbor\MahasiswaController@create',
            'as'    => 'dasbor.mahasiswa.form_tambah'
        ]);
        Route::get('/form-ubah/{id}', [
            'uses'  => 'Dasbor\MahasiswaController@edit',
            'as'    => 'dasbor.mahasiswa.form_ubah'
        ]);
        Route::get('/data', [
            'uses'  => 'Dasbor\MahasiswaController@data',
            'as'    => 'dasbor.data.mahasiswa'
        ]);
        Route::post('/simpan', [
            'uses'  => 'Dasbor\MahasiswaController@store',
            'as'    => 'dasbor.mahasiswa.simpan'
        ]);
        Route::put('/ubah/{id}', [
            'uses'  => 'Dasbor\MahasiswaController@update',
            'as'    => 'dasbor.mahasiswa.ubah'
        ]);
        Route::delete('/hapus/{id}', [
            'uses'  => 'Dasbor\MahasiswaController@destroy',
            'as'    => 'dasbor.mahasiswa.hapus'
        ]);
    });
    Route::group(['prefix' => 'mata-kuliah'], function(){
        Route::get('/', [
            'uses'  => 'Dasbor\MataKuliahController@index',
            'as'    => 'dasbor.mata_kuliah'
        ]);
        Route::get('/form-tambah', [
            'uses'  => 'Dasbor\MataKuliahController@create',
            'as'    => 'dasbor.mata_kuliah.form_tambah'
        ]);
        Route::get('/form-ubah/{id}', [
            'uses'  => 'Dasbor\MataKuliahController@edit',
            'as'    => 'dasbor.mata_kuliah.form_ubah'
        ]);
        Route::get('/data', [
            'uses'  => 'Dasbor\MataKuliahController@data',
            'as'    => 'dasbor.data.mata_kuliah'
        ]);
        Route::post('/simpan', [
            'uses'  => 'Dasbor\MataKuliahController@store',
            'as'    => 'dasbor.mata_kuliah.simpan'
        ]);
        Route::put('/ubah/{id}', [
            'uses'  => 'Dasbor\MataKuliahController@update',
            'as'    => 'dasbor.mata_kuliah.ubah'
        ]);
        Route::delete('/hapus/{id}', [
            'uses'  => 'Dasbor\MataKuliahController@destroy',
            'as'    => 'dasbor.mata_kuliah.hapus'
        ]);
    });
});
