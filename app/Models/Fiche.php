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
        return $this->belongsTo(User::class);
    }

    public function developpeur(){
        return $this->belongsTo(Developpeur::class);
    }

    public function genre(){
        return $this->belongsTo(Genre::class);
    }
}
