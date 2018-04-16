<?php

namespace GameSheets\Events;

use Illuminate\ {
    Queue\SerializesModels,
    Database\Eloquent\Model
};

class GenreSaving
{
    use SerializesModels;

    public $model;
    public function __construct(Model $model)
    {
        $this->model = $model;
    }
}
