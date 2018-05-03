<?php

namespace GameSheets\Providers;

use GameSheets\Models\Fiche;
use GameSheets\Policies\FichePolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'GameSheets\Model' => 'GameSheets\Policies\ModelPolicy',
        Fiche::class => FichePolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
