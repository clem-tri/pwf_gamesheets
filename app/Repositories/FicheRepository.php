<?php
/**
 * Created by PhpStorm.
 * User: Clément
 * Date: 17/04/2018
 * Time: 15:33
 */

namespace GameSheets\Repositories;


use GameSheets\Models\Fiche;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class FicheRepository
{


    /**
     * @param  \Illuminate\Http\Request  $request
     */
    public function store($request){

        $path = Storage::disk('public')->put('', $request->file('image'));

        $fiche = new Fiche;
        $fiche->nom = $request->nom;
        $fiche->image = $path;
        $fiche->editeur_id = $request->editeur_id;
        $fiche->developpeur_id = $request->developpeur_id;
        $fiche->genre_id = $request->genre_id;
        $fiche->annee = $request->annee;
        $fiche->synopsis = $request->synopsis;
        $fiche->en_ligne = is_null($request->en_ligne) ? 0 : 1;
        $fiche->site = $request->site;
        $fiche->save();
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  Fiche $fiche
     */
    public function update($request, $fiche){

        if($request->logo != null){
            // on supprime la photo actuelle
            Storage::disk('public')->delete($fiche->logo);
            // on ajoute la nouvelle
            $path = Storage::disk('public')->put('', $request->file('logo'));


            $fiche->image = $path;

        }
        // on change les propriétés de l'objet pour update la bdd
        $fiche->nom = $request->nom;
        $fiche->editeur_id = $request->editeur_id;
        $fiche->developpeur_id = $request->developpeur_id;
        $fiche->genre_id = $request->genre_id;
        $fiche->annee = $request->annee;
        $fiche->synopsis = $request->synopsis;
        $fiche->en_ligne = is_null($request->en_ligne) ? 0 : 1;
        $fiche->site = $request->site;

        $fiche->save();
    }

    /**
     * @param Request $request
     */
    public function destroyImg($request){
        Storage::disk('public')->delete($request->image);
    }

}