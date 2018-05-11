<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



//contact

Route::get('/contact', function () {
    return view('contact');
})->name('contact');
//
Auth::routes();

Route::get('/', 'HomeController@index')->name('home');



// ADMIN

Route::middleware('admin')->group(function () {
    Route::resource ('genre', 'GenreController', [
        'except' => 'show'
    ]);
    Route::resource ('editeur', 'EditeurController', [
        'except' => 'show'
    ]);
    Route::resource ('developpeur', 'DeveloppeurController', [
        'except' => 'show'
    ]);
    Route::resource ('fiche', 'FicheController');

    Route::resource ('pictogramme', 'PictogrammeController', [
        'except' => 'show'
    ]);

    Route::resource ('plateforme', 'PlateformeController', [
        'except' => 'show'
    ]);

    Route::resource ('extension', 'ExtensionController', [
        'except' => 'show'
    ]);

});
//
Route::name('genre')->get('genre/{slug}', 'FicheController@genre');
Route::name('user')->get('user/{user}', 'FicheController@user');

//

Route::middleware('auth')->group(function () {
    Route::resource('fiche', 'FicheController', [
        'only' => ['show','create', 'store', 'destroy']
    ]);

    Route::post('recueil/generate', 'RecueilController@generate')->name('recueil.generate');;
    Route::resource('recueil', 'RecueilController', [
        'only' => ['create', 'generate']
    ]);
});
