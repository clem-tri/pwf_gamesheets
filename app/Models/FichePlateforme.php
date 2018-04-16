<?php

namespace GameSheets\Models;

use Illuminate\Database\Eloquent\Model;

class FichePlateforme extends Model
{

    public function plateforme(){
        return $this->belongsTo(Plateforme::class);
    }

    public function fiche(){
        return $this->belongsTo(Fiche::class);
    }
}
