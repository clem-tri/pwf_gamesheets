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

Route::get('/', function () {
    return view('welcome');
})->name('index');

//contact

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



// ADMIN

Route::middleware('admin')->group(function () {
    Route::resource ('genre', 'GenreController', [
        'except' => 'show'
    ]);
    Route::resource ('editeur', 'EditeurController', [
        'except' => 'show'
    ]);
});



//

Route::middleware('auth')->group(function () {
    Route::resource('fiche', 'FicheController', [
        'only' => ['create', 'store', 'destroy']
    ]);
});
