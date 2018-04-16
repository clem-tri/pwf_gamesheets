<?php
/**
 * Created by PhpStorm.
 * User: Clément
 * Date: 16/04/2018
 * Time: 15:51
 */

namespace GameSheets\Repositories;

use GameSheets\Models\Editeur;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class EditeurRepository
{

    /**
     * @param  \Illuminate\Http\Request  $request
     */
    public function store($request){
        $path = Storage::disk('public')->put('', $request->file('logo'));

        $editeur = new Editeur;
        $editeur->nom = $request->nom;
        $editeur->logo = $path;
        $editeur->save();
    }

    /**
     * @param Editeur $request
     */
    public function destroyImg($request){
        Storage::disk('public')->delete($request->logo);
    }
}