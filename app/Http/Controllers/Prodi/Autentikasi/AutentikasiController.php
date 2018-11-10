<?php

namespace App\Http\Controllers\Prodi\Autentikasi;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Prodi\Autentikasi\LoginProdiRequest;

class AutentikasiController extends Controller
{
    public function showFormLogin()
    {
        return view('prodi.autentikasi.form_login');
    }

    public function login(LoginProdiRequest $loginProdiReq)
    {
        $nidn       = $loginProdiReq->nidn;
        $password   = $loginProdiReq->password;

        if(Auth::guard('prodi')->attempt(['nidn' => $nidn, 'password' => $password])){
            return redirect()
                ->intended('/prodi');
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

        return redirect('/prodi');
    }
}
