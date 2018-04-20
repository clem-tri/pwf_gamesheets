<?php

namespace GameSheets\Http\Controllers;

use GameSheets\Models\Fiche;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fiches = Fiche::paginate(config('app.pagination'));

        return view('home', compact('fiches'));
    }
}
