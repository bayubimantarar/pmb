<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if ($exception instanceof \Illuminate\Http\Exceptions\PostTooLargeException){
            return redirect('/konfirmasi-pembayaran')
                ->with([
                    'ukuran' => 'Ukuran file terlalu besar'
                ]);
        }

        if($exception instanceof \illuminate\Contracts\Encryption\DecryptException){
            abort(404);
        }

        return parent::render($request, $exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function unauthenticated($request, AuthenticationException $exception)
    {
        $guard = array_get($exception->guards(), 0);
        switch ($guard) {
            case 'master':
                $login = 'dasbor.autentikasi.form_login';
                break;
            case 'prodi':
                $login = 'prodi.autentikasi.form_login';
                break;
            case 'mahasiswa':
                $login = 'mahasiswa.autentikasi.form_login';
                break;
            case 'panitia':
                $login = 'panitia.autentikasi.form_login';
                break;
            case 'dosen':
                $login = 'dosen.autentikasi.form_login';
                break;
            case 'keuangan':
                $login = 'keuangan.autentikasi.form_login';
                break;
            case 'calon_mahasiswa':
                $login = 'pmb.autentikasi.form_login';
                break;
        }
        return redirect()->guest(route($login));
    }
}
