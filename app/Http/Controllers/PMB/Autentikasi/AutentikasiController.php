<?php

namespace App\Http\Controllers\PMB\Autentikasi;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PMB\Autentikasi\LoginCalonMahasiswaRequest;

class AutentikasiController extends Controller
{
    public function showFormLogin()
    {
        return view('pmb.autentikasi.form_login');
    }

    public function login(LoginCalonMahasiswaRequest $loginCalonMahasiswaReq)
    {
        $kode = $loginCalonMahasiswaReq->kode;
        $password = $loginCalonMahasiswaReq->password;

        if(Auth::guard('calon_mahasiswa')->attempt([
            'kode' => $kode, 
            'password' => $password
        ])) {
            return redirect()
                ->intended('/pmb');
        }
        
        return redirect()
            ->back()
            ->withErrors([
                'notification' => 'Login gagal! cek kembali kode pendaftaran dan password.'
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

        return redirect('/pmb');
    }
}
