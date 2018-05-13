<?php
/**
 * Created by PhpStorm.
 * User: Clément
 * Date: 17/04/2018
 * Time: 15:33
 */

namespace GameSheets\Repositories;


use GameSheets\Models\Extension;
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
        $fiche->plateformes()->attach($request->Plateformes);
        $fiche->pictogrammes()->attach($request->Pictogrammes);

        if(isset($request->Extensions)){
            foreach ($request->Extensions as $extension){
                $objExtension = new Extension;
                $objExtension->nom = $extension;
                $objExtension->fiche()->associate($fiche);
                $objExtension->save();
            }
        }



    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  Fiche $fiche
     */
    public function update($request, $fiche){

        if($request->image != null){

            // on supprime la photo actuelle
            Storage::disk('public')->delete($fiche->image);
            // on ajoute la nouvelle
            $path = Storage::disk('public')->put('', $request->file('image'));


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

        $fiche->plateformes()->sync($request->Plateformes);
        $fiche->pictogrammes()->sync($request->Pictogrammes);

        if(isset($request->Extensions)) {

            foreach ($request->Extensions as $key => $extension) {

                $existingExt = Extension::find($key);

                if (is_null($existingExt)) {
                    $objExtension = new Extension;
                    $objExtension->nom = $extension;
                    $objExtension->fiche()->associate($fiche);
                    $objExtension->save();
                } else
                    $existingExt->update(['nom' => $extension]);

            }
        }
    }

    /**
     * @param Request $request
     */
    public function destroy(Fiche $request){
        Storage::disk('public')->delete($request->image);
        $request->plateformes()->detach();
        $request->pictogrammes()->detach();
        $request->extensions()->delete();

    }

    public function getFichesForGenre($slug){
        return Fiche::latest()->whereHas('genre',function($query) use ($slug){
            $query->whereSlug($slug);
        })->paginate(config('app.pagination'));
    }

    public function getFichesForUser($id)
    {
        return Fiche::latest()->whereHas('user', function ($query) use ($id) {
            $query->whereId($id);
        })->paginate(config('app.pagination'));
    }

}