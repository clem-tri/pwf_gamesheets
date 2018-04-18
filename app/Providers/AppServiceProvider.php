<?php

namespace GameSheets\Providers;

use GameSheets\Models\Developpeur;
use GameSheets\Models\Editeur;
use GameSheets\Models\Fiche;
use GameSheets\Models\Genre;
use GameSheets\Models\Pictogramme;
use Illuminate\Support\Facades\Blade;
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
        Blade::if('admin', function () {
            return auth()->check() && auth()->user()->role === 'admin';
        });

        if(request()->server("SCRIPT_NAME") !== 'artisan') {
            view ()->share ('genres', Genre::all ());
            view()->share('editeurs', Editeur::all());
            view()->share('developpeurs', Developpeur::all());
            view()->share('pictogrammes', Pictogramme::all());
            view()->share('fiches', Fiche::all());
        }
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
