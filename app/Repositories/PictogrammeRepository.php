<?php
/**
 * Created by PhpStorm.
 * User: Clément
 * Date: 17/04/2018
 * Time: 11:00
 */

namespace GameSheets\Repositories;

use GameSheets\Models\Pictogramme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PictogrammeRepository
{

    /**
     * @param  \Illuminate\Http\Request  $request
     */
    public function store($request){
        $path = Storage::disk('public')->put('', $request->file('logo'));

        $pictogramme = new Pictogramme();
        $pictogramme->nom = $request->nom;
        $pictogramme->logo = $path;
        $pictogramme->save();
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  Pictogramme $pictogramme
     */
    public function update($request, $pictogramme){

        if($request->logo != null){
            // on supprime la photo actuelle
            Storage::disk('public')->delete($pictogramme->logo);
            // on ajoute la nouvelle
            $path = Storage::disk('public')->put('', $request->file('logo'));


            $pictogramme->logo = $path;

        }
        // on change les propriétés de l'objet pour update la bdd
        $pictogramme->nom = $request->nom;

        $pictogramme->save();
    }

    /**
     * @param Request $request
     */
    public function destroyImg($request){
        Storage::disk('public')->delete($request->logo);
    }
}