<?php

namespace App\Http\Controllers\Dasbor\Autentikasi;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AutentikasiRequest;

class AutentikasiController extends Controller
{
    /**
     * Display a login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function formLogin()
    {
        return view('dasbor.autentikasi.form_login');
    }

    /**
     * Display a login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(AutentikasiRequest $autentikasiReq)
    {
        $email      = $autentikasiReq->email;
        $password   = $autentikasiReq->password;
        
        if(Auth::guard('master')->attempt([
            'email' => $email, 'password' => $password
        ])) {
            return redirect()
                ->intended('/dasbor');
        }
        
        return redirect()
            ->back()
            ->withErrors([
                'notification' => 'Login gagal, cek kembali email dan password.'
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

        return redirect('/dasbor');
    }
}
