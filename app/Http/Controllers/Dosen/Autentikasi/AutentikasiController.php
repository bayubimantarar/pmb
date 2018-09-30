<?php

namespace App\Http\Controllers\Dosen\Autentikasi;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dosen\LoginDosenRequest;

class AutentikasiController extends Controller
{
    public function showFormLogin()
    {
        return view('dosen.autentikasi.form_login');
    }

    public function login(LoginDosenRequest $loginDosenReq)
    {
        $nip        = $loginDosenReq->nip;
        $password   = $loginDosenReq->password;

        if(Auth::guard('dosen')->attempt(['nip' => $nip, 'password' => $password])){
            return redirect()
                ->intended('/');
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

        return redirect('/dosen');
    }
}
