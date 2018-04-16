<?php

namespace GameSheets\Models;

use Illuminate\Database\Eloquent\Model;

class Editeur extends Model
{
    protected $fillable = [
        'nom', 'logo',
    ];

    public function fiches()
    {
        return $this->hasMany(Fiche::class);
    }
}
