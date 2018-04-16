<?php

namespace GameSheets\Http\Controllers;

use GameSheets\Models\Editeur;
use Illuminate\Http\Request;
use GameSheets\Repositories\EditeurRepository;

class EditeurController extends Controller
{

    protected $repository;


    public function __construct(EditeurRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $editeurs = Editeur::all();
        return view('editeurs.index', compact ('editeurs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('editeurs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'logo' => 'required|mimes:jpeg,jpg,png|max:2000',


        ]);
        $this->repository->store($request);

        return back()->with('ok', __("L'editeur a bien été enregistrée"));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Editeur $editeur)
    {
        return view('editeurs.edit', compact('editeur'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Editeur $editeur)
    {

       
        $editeur->update($request->all());

        return redirect()->route('home')->with('ok', __('L\'éditeur a bien été modifiée'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Editeur  $editeur
     * @return \Illuminate\Http\Response
     */
    public function destroy(Editeur $editeur)
    {
        $this->repository->destroyImg($editeur);
        $editeur->delete();
        return response()->json();
    }
}
