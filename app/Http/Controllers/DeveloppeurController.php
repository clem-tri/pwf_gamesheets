<?php

namespace GameSheets\Http\Controllers;

use GameSheets\Models\Developpeur;
use GameSheets\Repositories\DeveloppeurRepository;
use Illuminate\Http\Request;

class DeveloppeurController extends Controller
{

    protected $repository;


    public function __construct(DeveloppeurRepository $repository)
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
        return view('developpeurs.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('developpeurs.create');
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

        return redirect()->route('developpeur.index')->with('ok', __("Le développeur a bien été enregistré"));
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
     * @param  Developpeur $developpeur
     * @return \Illuminate\Http\Response
     */
    public function edit(Developpeur $developpeur)
    {
        return view('developpeurs.edit', compact('developpeur'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Developpeur  $developpeur
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Developpeur $developpeur)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'logo' => '|mimes:jpeg,jpg,png|max:2000',


        ]);

        $this->repository->update($request, $developpeur);

        return back()->with('ok', __('Le développeur a bien été modifié'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Developpeur $developpeur
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy($developpeur)
    {
        $developpeur->delete();
        return response()->json();
    }
}
