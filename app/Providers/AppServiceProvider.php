<?php

namespace App\Providers;

use Auth;
use App\Soal;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function ($view) {
            if ($view->getName() == 'dosen.layouts.main') {
                $nip    = Auth::guard('dosen')->User()->nip;
                $soal   = Soal::AllDataWithRelationship($nip);
                
                $view->with('soal', $soal);
            }
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
