<?php

namespace GameSheets\Models;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $fillable = [
        'nom', 'slug',
    ];
}
