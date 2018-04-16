<?php

namespace GameSheets\Models;

use GameSheets\Events\GenreSaving;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $fillable = [
        'nom', 'slug',
    ];

    protected $dispatchesEvents = [
        'saving' => GenreSaving::class,
    ];

    public function fiches()
    {
        return $this->hasMany(Fiche::class);
    }
}
