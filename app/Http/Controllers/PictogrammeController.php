<?php

namespace GameSheets\Http\Controllers;

use GameSheets\Models\Pictogramme;
use GameSheets\Repositories\PictogrammeRepository;
use Illuminate\Http\Request;

class PictogrammeController extends Controller
{

    protected $repository;


    public function __construct(PictogrammeRepository $repository)
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
        return view('pictogrammes.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pictogrammes.create');
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

        return redirect()->route('pictogramme.index')->with('ok', __("Le pictogramme a bien été enregistré"));
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
     * @param  Pictogramme  $pictogramme
     * @return \Illuminate\Http\Response
     */
    public function edit(Pictogramme $pictogramme)
    {
        return view('pictogrammes.edit', compact('pictogramme'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Pictogramme $pictogramme
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Pictogramme $pictogramme)
    {
        $this->repository->destroyImg($pictogramme);
        $pictogramme->delete();
        return response()->json();
    }
}
