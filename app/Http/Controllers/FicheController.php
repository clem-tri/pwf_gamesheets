<?php

namespace GameSheets\Http\Controllers;

use GameSheets\Models\Fiche;
use GameSheets\Repositories\FicheRepository;
use Illuminate\Http\Request;

class FicheController extends Controller
{


    protected $repository;


    public function __construct(FicheRepository $repository)
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

        return view('fiches.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('fiches.create');
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
            'image' => 'required|mimes:jpeg,jpg,png|max:2000',
            'site' => 'nullable|string|max:255'


        ]);
        $this->repository->store($request);

        return redirect()->route('home')->with('ok', __("La fiche a bien été enregistrée"));
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
    public function edit(Fiche $fiche)
    {
        return view('fiches.edit', compact('fiche'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Fiche $fiche
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fiche $fiche)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'image' => 'nullable|mimes:jpeg,jpg,png|max:2000',
            'site' => 'nullable|string|max:255'


        ]);

        $this->repository->update($request,$fiche);

        return redirect()->route('fiche.index')->with('ok', __("La fiche a bien été mise à jour"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Fiche $fiche
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Fiche $fiche)
    {
        $this->repository->destroyImg($fiche);
        $fiche->delete();
        return response()->json();
    }
}
