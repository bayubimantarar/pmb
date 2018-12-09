<?php

namespace App\Http\Controllers\Keuangan\Autentikasi;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Keuangan\Autentikasi\LoginKeuanganRequest;

class AutentikasiController extends Controller
{
    public function showFormLogin()
    {
        return view('keuangan.autentikasi.form_login');
    }

    public function login(LoginKeuanganRequest $loginKeuanganReq)
    {
        $nidn       = $loginKeuanganReq->nidn;
        $password   = $loginKeuanganReq->password;

        if(Auth::guard('keuangan')->attempt(['nidn' => $nidn, 'password' => $password])){
            return redirect()
                ->intended('/keuangan');
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

        return redirect('/keuangan');
    }
}
