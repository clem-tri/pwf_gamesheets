<?php

namespace GameSheets\Listeners;

use GameSheets\Events\GenreSaving as EventGenreSaving;

class GenreSaving
{

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(EventGenreSaving $event)
    {
        $event->model->slug = str_slug($event->model->nom, '-');
    }
}
