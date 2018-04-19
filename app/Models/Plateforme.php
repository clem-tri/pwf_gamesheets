<?php

namespace GameSheets\Models;

use Illuminate\Database\Eloquent\Model;

class Plateforme extends Model
{
    protected $fillable = [
        'nom'
    ];

    public function fiches(){
        return $this->belongsToMany(Fiche::class, "fiche_plateformes");
    }
}
