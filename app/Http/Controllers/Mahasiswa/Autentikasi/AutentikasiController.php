<?php

namespace App\Http\Controllers\Mahasiswa\Autentikasi;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Mahasiswa\LoginMahasiswaRequest;

class AutentikasiController extends Controller
{
    public function showFormLogin()
    {
        return view('mahasiswa.autentikasi.form_login');
    }

    public function login(LoginMahasiswaRequest $loginMahasiswaReq)
    {
        $nim = $loginMahasiswaReq->nim;
        $password = $loginMahasiswaReq->password;

        if(Auth::guard('mahasiswa')->attempt(['nim' => $nim, 'password' => $password])){
            return redirect()
                ->intended('/mahasiswa');
        }
        
        return redirect()
            ->back()
            ->withErrors([
                'notification' => 'Login gagal! cek kembali nim dan password.'
            ]);
    }

    /**
     * Display a login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $request
            ->session()
            ->flush();
            
        $request
            ->session()
            ->regenerate();

        return redirect('/mahasiswa');
    }
}
