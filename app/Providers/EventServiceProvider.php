<?php

namespace GameSheets\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'GameSheets\Events\Event' => [
            'GameSheets\Listeners\EventListener',
        ],
        'GameSheets\Events\GenreSaving' => [
            'GameSheets\Listeners\GenreSaving',
        ]
        ,
        'GameSheets\Events\FicheSaving' => [
            'GameSheets\Listeners\FicheSaving',
        ]

    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
