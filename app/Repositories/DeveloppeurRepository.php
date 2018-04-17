<?php
/**
 * Created by PhpStorm.
 * User: Clément
 * Date: 17/04/2018
 * Time: 11:00
 */

namespace GameSheets\Repositories;

use GameSheets\Models\Developpeur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DeveloppeurRepository
{

    /**
     * @param  \Illuminate\Http\Request  $request
     */
    public function store($request){
        $path = Storage::disk('public')->put('', $request->file('logo'));

        $developpeur = new Developpeur();
        $developpeur->nom = $request->nom;
        $developpeur->logo = $path;
        $developpeur->save();
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  Developpeur $developpeur
     */
    public function update($request, $developpeur){

        if($request->logo != null){
            // on supprime la photo actuelle
            Storage::disk('public')->delete($developpeur->logo);
            // on ajoute la nouvelle
            $path = Storage::disk('public')->put('', $request->file('logo'));


            $developpeur->logo = $path;

        }
        // on change les propriétés de l'objet pour update la bdd
        $developpeur->nom = $request->nom;

        $developpeur->save();
    }

    /**
     * @param Request $request
     */
    public function destroyImg($request){
        Storage::disk('public')->delete($request->logo);
    }
}