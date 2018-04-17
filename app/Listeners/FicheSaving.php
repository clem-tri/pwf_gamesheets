<?php

namespace GameSheets\Listeners;

use GameSheets\Events\FicheSaving as EventFicheSaving;
use Illuminate\Support\Facades\Auth;

class FicheSaving
{
    public function handle(EventFicheSaving $event)
    {
        $event->model->created_by = auth()->id();;
    }
}
