@extends('layouts.form')
@section('card')
    @component('components.card')
    @slot('title')
    @lang('Créer une fiche')
    @endslot
    <form method="POST">
        {{ csrf_field() }}
        @include('partials.form-group-select', [
            'title' => __('Editeur'),
             'name' => 'editeur',
            'listoptions' => array('Rockstar', '2K'),
            'required' => true,
            ])
        @include('partials.form-group-select', [
            'title' => __('Developpeur'),
            'name' => 'developpeur',
            'listoptions' => array('Bandai', 'Namco'),
            'required' => true,
            ])
        @include('partials.form-group', [
            'title' => __('Année de sortie'),
            'type' => 'date',
            'name' => 'annee',
            'required' => true,
            ])
        @include('partials.form-group-select', [
            'title' => __('Genre'),
            'name' => 'genre',
            'listoptions' => array('Arcarde', 'Action'),
            'required' => true,
            ])
        @include('partials.form-group-select', [
           'title' => __('Catégorie'),
           'name' => 'categorie',
           'listoptions' => array('Labyrinthe', 'Puzzle'),
           'required' => true,
           ])
        @include('partials.form-group-select', [
           'title' => __('Plateforme'),
           'name' => 'genre',
           'listoptions' => array('PC', 'PS4', 'XBOX ONE'),
           'required' => true,
           ])
        @include('partials.form-group', [
            'title' => __('Prix'),
            'type' => 'number',
            'name' => 'prix',
            'required' => true,
            ])
        @component('components.button')
        @lang('Créer fiche')
        @endcomponent
    </form>
    @endcomponent
@endsection