<?php

namespace GameSheets\Models;

use Illuminate\Database\Eloquent\Model;

class Developpeur extends Model
{
    protected $fillable = [
        'nom', 'logo'
    ];

    public function fiches()
    {
        return $this->hasMany(Fiche::class);
    }
}
