@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

                @for ($i = 0; $i < 2; $i++)
                    <div class="row mb-3">
                        @for ($x = 0; $x < 4; $x++)
                            <div class="card col-md-3">
                                <img class="card-img-top" src="{{asset("img/miniature.jpg")}}" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title">PACMAN</h5>
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                    <a href="#" class="btn btn-primary">Voir fiche</a>
                                </div>
                            </div>
                        @endfor

                    </div>
                @endfor


        </div>
    </div>


@endsection
