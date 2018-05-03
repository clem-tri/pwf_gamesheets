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
<div class="container-fluid">

    @isset($genre)
        <h2 class="text-title mb-3 text-light">{{ $genre->nom }}</h2>
    @endif

        @isset($user)
            <h2 class="text-title mb-3 text-light">Fiches de {{ $user->name }}</h2>
        @endif


        @if (Auth::guest())
    @if( Route::currentRouteName() == 'home' && (!isset($_GET['page']) || $_GET['page'] == 1) )
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-4">Bienvenue</h1>
            <p class="lead">Gamesheets vous propose de créer des fichiers aux formats ePub et PDF regroupant des informations sur les jeux vidéos de votre choix à partir de notre base de données </p>
            <h4>En vous inscrivant, vous pourrez :</h4>
            <ul>
                <li class="lead">Contribuer à la richesse de notre collection de fiches sur les jeux vidéos !</li>
                <li class="lead">Créer gratuitement votre ePub/PDF à partir de celles-ci !</li>
            </ul>

        </div>
    </div>
    @endif
        @endif

        @if(count($fiches) < 1)
            <div class="alert alert-info" role="alert">
                Aucune fiche disponible!
            </div>
        @endif

        <div class="card-columns">

            @foreach ($fiches as $fiche)
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="{{asset("storage/$fiche->image")}}" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">{{$fiche->nom}}</h5>
                        <p class="card-text">
                            {{$synopsis = strlen($fiche->synopsis) > 150 ? substr($fiche->synopsis,0,150)."..." : $fiche->synopsis}}
                        </p>
                        <a href="{{route("fiche.show", $fiche->id)}}" class="btn btn-primary">Voir fiche</a>
                        @adminOrOwner($fiche->created_by)
                        <a class="form-delete pull-right" href="{{ route('fiche.destroy', $fiche->id) }}" data-toggle="tooltip" title="@lang('Supprimer cette fiche')"><i class="fa fa-trash"></i></a>
                        <form action="{{ route('fiche.destroy', $fiche->id) }}" method="POST" class="hide">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                        </form>
                        @endadminOrOwner
                    </div>
                </div>
            @endforeach



    </div>

    <div class="d-flex justify-content-center">
        {{ $fiches->links() }}
    </div>

</div>

@endsection
@section('script')
    <script>
        $(function() {
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            })
            $('[data-toggle="tooltip"]').tooltip()
            $('a.form-delete').click(function(e) {
                let that = $(this)
                e.preventDefault()
                swal({
                    title: '@lang('Vraiment supprimer cette fiche?')',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#DD6B55',
                    confirmButtonText: '@lang('Oui')',
                    cancelButtonText: '@lang('Non')'
                }).then(function () {
                    $('[data-toggle="tooltip"]').tooltip('hide')
                    $.ajax({
                        url: that.attr('href'),
                        type: 'DELETE'
                    })
                        .done(function () {
                            location.reload();
                        })
                        .fail(function (status) {
                                swal({
                                    title: status.status + " : " + status.responseJSON.message,
                                    type: 'warning'
                                })
                            }
                        )
                })
            })
        })
    </script>
})
@endsection


