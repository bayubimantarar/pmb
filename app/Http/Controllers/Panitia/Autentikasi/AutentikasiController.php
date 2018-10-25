<?php

namespace App\Http\Controllers\Panitia\Autentikasi;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Panitia\Autentikasi\LoginPanitiaRequest;

class AutentikasiController extends Controller
{
    public function showFormLogin()
    {
        return view('panitia.autentikasi.form_login');
    }

    public function login(LoginPanitiaRequest $loginPanitiaReq)
    {
        $nidn       = $loginPanitiaReq->nidn;
        $password   = $loginPanitiaReq->password;

        if(Auth::guard('panitia')->attempt(['nidn' => $nidn, 'password' => $password])){
            return redirect()
                ->intended('/panitia');
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

        return redirect('/panitia');
    }
}
