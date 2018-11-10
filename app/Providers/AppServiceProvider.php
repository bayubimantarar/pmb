<?php

namespace App\Providers;

use Auth;
use App\Models\PMB\Soal;
use App\Models\PMB\JadwalUjian;
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
            if($view->getName() == 'prodi.layouts.main') {
                $nidn   = Auth::guard('prodi')->User()->nidn;
                $soal   = Soal::AllDataWithRelationship($nidn);
                
                $view->with('soal', $soal);
            }

            if($view->getName() == 'panitia.layouts.main') {
                $jadwalUjian   = JadwalUjian::All();
                
                $view->with('jadwalUjian', $jadwalUjian);
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
