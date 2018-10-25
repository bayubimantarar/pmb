<?php

namespace App\Providers;

use Auth;
use App\Models\PMB\Soal;
use Illuminate\Support\Facades\Schema;
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
        Schema::defaultStringLength(191);
        
        view()->composer('*', function ($view) {
            if ($view->getName() == 'prodi.layouts.main') {
                $nidn    = Auth::guard('prodi')->User()->nidn;
                $soal   = Soal::AllDataWithRelationship($nidn);
                
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
