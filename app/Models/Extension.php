<?php

namespace GameSheets\Models;

use Illuminate\Database\Eloquent\Model;

class Extension extends Model
{
    protected $fillable = [
        'nom'
    ];

    public function fiche()
    {
        return $this->belongsTo(Fiche::class);
    }
}
