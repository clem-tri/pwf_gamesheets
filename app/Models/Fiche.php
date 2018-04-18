<?php

namespace GameSheets\Models;

use Illuminate\Database\Eloquent\Model;
use GameSheets\Events\FicheSaving;

class Fiche extends Model
{
    protected $dispatchesEvents = [
        'saving' => FicheSaving::class
    ];

    public function editeur()
    {
        return $this->belongsTo(Editeur::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function developpeur(){
        return $this->belongsTo(Developpeur::class);
    }

    public function genre(){
        return $this->belongsTo(Genre::class);
    }

    public function extensions()
    {
        return $this->hasMany(Extension::class);
    }

    public function pictogrammes(){
        return $this->belongsToMany(Pictogramme::class, 'fiche_pictos');
    }

    public function plateformes(){
        return $this->belongsToMany(Plateforme::class);
    }
}
