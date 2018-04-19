@extends('layouts.app')
@section('css')
<style>
    .card-img-top {
        width: 100%;
        height: 15vw;
        object-fit: cover;
    }
</style>
@endsection
@section('content')
<div class="container">
    {{--<div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>--}}

        <div class="card-columns">


            @foreach ($fiches as $fiche)
                <div class="card h-100" style="width: 18rem;">
                    <img class="card-img-top" src="{{asset("storage/$fiche->image")}}" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">{{$fiche->nom}}</h5>
                        <p class="card-text">
                            {{$synopsis = strlen($fiche->synopsis) > 150 ? substr($fiche->synopsis,0,150)."..." : $fiche->synopsis}}
                        </p>
                        <a href="{{route("fiche.show", $fiche->id)}}" class="btn btn-primary">Voir fiche</a>
                    </div>
                </div>
            @endforeach

    </div>

</div>

@endsection
