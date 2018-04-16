<?php

namespace GameSheets\Models;

use Illuminate\Database\Eloquent\Model;

class FichePicto extends Model
{

    public function pictogramme(){
        $this->belongsTo(Pictogramme::class);
    }

    public function fiche(){
        return $this->belongsTo(Fiche::class);
    }
}
