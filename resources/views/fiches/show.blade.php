@extends('layouts.form-large')
@section('card')
    @component('components.card-details')
        @slot('title')
            <h5 class="card-title"> {{$fiche->nom}}</h5>
           {{-- <button type="button" class="btn btn-success pull-right"><i class="fa fa-book"></i> EPUB</button>
            <button type="button" class="btn btn-danger pull-right"><i class="fa fa-file-pdf"></i> PDF</button>--}}
        @endslot
        @slot('slot')

            <div class="form-group">
            <img class="card-img-top w-50 mw-100" src="{{asset("storage/$fiche->image")}}" alt="Image">
            </div>
            <hr>
            <div class="form-group">
            <h5 class="card-title">Editeur / Developpeur :</h5>

                <figure>
                    <img alt="Editeur" class="img-responsive w-25 h-25" src="{{asset("storage/".$fiche->editeur->logo)}}"/>
                    <figcaption class="card-text font-weight-bold font-italic">{{$fiche->editeur->nom}}</figcaption>
                </figure>
                <figure>
                    <img alt="Developpeur" class="img-responsive w-25 h-25" src="{{asset("storage/".$fiche->developpeur->logo)}}"/>
                    <figcaption class="card-text font-weight-bold font-italic">{{$fiche->developpeur->nom}}</figcaption>
                </figure>

            </div>



            @if(count($fiche->plateformes)> 0)
                <hr>
                <div class="form-group">
                    <h5 class="card-title">Plateformes :</h5>

                        @foreach($fiche->plateformes as $plateforme)
                        <div> {{$plateforme->nom}} </div>
                        @endforeach

                </div>
                    @endif
            <hr>
            <div class="form-group">
            <h5 class="card-title">Genre :</h5>
            <p class="card-text">{{$fiche->genre->nom}}</p>
            </div>

            <hr>
            <div class="form-group">
            <h5 class="card-title">Sortie :</h5>
            <p class="card-text">{{date("d/m/Y",strtotime($fiche->annee))}}</p>
            </div>

            <hr>
            <div class="form-group">
            @if($fiche->synopsis)
            <h5 class="card-title">Synopsis :</h5>
            <p class="card-text">{{$fiche->synopsis}}</p>
            @endif
            </div>

            @if(count($fiche->extensions)> 0)
                <hr>
                <div class="form-group">
                    <h5 class="card-title">Extensions :</h5>
                        @foreach($fiche->extensions as $extension)
                            <div><span class="badge badge-pill badge-light">{{$extension->nom}}</span></div>
                        @endforeach
                </div>
            @endif

            <hr>
            <div class="form-group">
            <h5 class="card-title">Jouable en ligne :</h5>
            <p class="card-text">
                @if($status = $fiche->en_ligne == 1 ? 'check' : 'times')
                    <i class="fas fa-{{$status}} fa-lg"></i>
                    @endif
            </p>
            </div>



            @if($fiche->site)
                <hr>
                <div class="form-group">
                    <h5 class="card-title">Site internet :</h5>
                    <p class="card-text"><a href="{{$fiche->site}}">{{$fiche->site}}</a></p>
                </div>
            @endif


            <hr>
            <div class="form-group">
                @foreach($fiche->pictogrammes as $pictogramme)

                    <img class="img-responsive" width="20%" src="{{asset("storage/$pictogramme->logo")}}"/>

                @endforeach
            </div>



        @endslot

        @slot('footer')
        Auteur : {{$fiche->user->name}}, le {{date_format($fiche->created_at,'d/m/Y')}}
        @endslot
    @endcomponent
@endsection
