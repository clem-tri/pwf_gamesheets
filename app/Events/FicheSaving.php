<?php

namespace GameSheets\Events;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Queue\SerializesModels;


class FicheSaving
{
    use SerializesModels;
    public $model;
    public function __construct(Model $model)
    {
        $this->model = $model;
    }
}
