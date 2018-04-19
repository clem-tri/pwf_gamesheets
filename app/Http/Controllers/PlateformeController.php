<?php

namespace GameSheets\Http\Controllers;

use GameSheets\Models\Plateforme;
use Illuminate\Http\Request;

class PlateformeController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('plateformes.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('plateformes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Plateforme::create($request->all());

        return redirect()->route('plateforme.index')->with('ok', __("La plateforme a bien été enregistrée"));
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
    public function edit(Plateforme $plateforme)
    {
        return view('plateformes.edit', compact('plateforme'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Plateforme  $plateforme
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Plateforme $plateforme)
    {
        $plateforme->update($request->all());

        return redirect()->route('plateforme.index')->with('ok', __('La plateforme a bien été modifiée'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Plateforme $plateforme
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Plateforme $plateforme)
    {
        $plateforme->delete();

        return response()->json();
    }
}
