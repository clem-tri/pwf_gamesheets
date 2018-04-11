<?php

namespace GameSheets\Models;

use Illuminate\Database\Eloquent\Model;

class Plateforme extends Model
{
    protected $fillable = [
        'nom', 'logo'
    ];
}
