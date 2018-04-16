<?php

namespace GameSheets\Models;

use Illuminate\Database\Eloquent\Model;

class FicheExtension extends Model
{
    public function extension()
    {
        return $this->belongsTo(Extension::class);
    }

    public function fiche(){
        return $this->belongsTo(Fiche::class);
    }
}
