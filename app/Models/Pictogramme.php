<?php

namespace GameSheets\Models;

use Illuminate\Database\Eloquent\Model;

class Pictogramme extends Model
{
    protected $fillable = [
        'nom', 'logo'
    ];


    public function fiches(){
        return $this->belongsToMany(Fiche::class, 'fiche_pictos');
    }
}
