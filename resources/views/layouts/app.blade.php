<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'GameSheets') }}</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
    @yield('css')
</head>
<body>
<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-darkblue">
    <a class="navbar-brand" href="{{ route('home') }}">{{ config('app.name', 'GameSheets') }}</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle
        @isset($genre)
                {{ currentRoute(route('genre', $genre->slug)) }}
                @endisset
                        " href="#" id="navbarDropdownCat" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    @lang('Genres')
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownCat">
                    @foreach($genres as $genre)
                        <a class="dropdown-item" href="{{ route('genre', $genre->slug) }}">{{ $genre->nom }}</a>
                    @endforeach
                </div>
            </li>

            @admin
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle{{ currentRoute(
            route('genre.create'),
            route('genre.index')
        )}}" href="#" id="navbarDropdownGestCat" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    @lang('Administration')
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownGestCat">
                    <a class="dropdown-item" href="{{ route('genre.create') }}">
                        <i class="fas fa-plus fa-lg"></i> @lang('Ajouter un genre')
                    </a>
                    <a class="dropdown-item" href="{{ route('editeur.create') }}">
                        <i class="fa fa-plus fa-lg"></i> @lang('Ajouter un éditeur')
                    </a>
                    <a class="dropdown-item" href="{{ route('developpeur.create') }}">
                        <i class="fa fa-plus fa-lg"></i> @lang('Ajouter un développeur')
                    </a>
                    <a class="dropdown-item" href="{{ route('pictogramme.create') }}">
                        <i class="fa fa-plus fa-lg"></i> @lang('Ajouter un pictogramme')
                    </a>
                    <a class="dropdown-item" href="{{ route('plateforme.create') }}">
                        <i class="fa fa-plus fa-lg"></i> @lang('Ajouter une plateforme')
                    </a>

                    <div class="dropdown-divider"></div>

                    <a class="dropdown-item" href="{{ route('fiche.index') }}">
                        <i class="fas fa-sticky-note fa-lg"></i> @lang('Gérer les fiches')
                    </a>
                    <a class="dropdown-item" href="{{ route('genre.index') }}">
                        <i class="fas fa-wrench fa-lg"></i> @lang('Gérer les genres')
                    </a>
                    <a class="dropdown-item" href="{{ route('editeur.index') }}">
                        <i class="fas fa-wrench fa-lg"></i> @lang('Gérer les éditeurs')
                    </a>
                    <a class="dropdown-item" href="{{ route('developpeur.index') }}">
                        <i class="fas fa-wrench fa-lg"></i> @lang('Gérer les développeurs')
                    </a>
                    <a class="dropdown-item" href="{{ route('pictogramme.index') }}">
                        <i class="fas fa-wrench fa-lg"></i> @lang('Gérer les pictogrammes')
                    </a>
                    <a class="dropdown-item" href="{{ route('plateforme.index') }}">
                        <i class="fas fa-wrench fa-lg"></i> @lang('Gérer les plateformes')
                    </a>
                </div>
            </li>
            @endadmin
            @auth
                <li class="nav-item{{ currentRoute(route('fiche.create')) }}"><a class="nav-link" href="{{ route('fiche.create') }}">@lang('Créer une fiche')</a></li>
                <li class="nav-item{{ currentRoute(route('recueil.create')) }}"><a class="nav-link" href="{{ route('recueil.create') }}">@lang('Créer un recueil')</a></li>
            @endauth
            <li class="nav-item">
                <a class="nav-link" href="{{route('contact')}}">Contact</a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            @guest
            <li class="nav-item{{ currentRoute(route('login')) }}"><a class="nav-link" href="{{ route('login') }}">@lang('Connexion')</a></li>
            <li class="nav-item{{ currentRoute(route('register')) }}"><a class="nav-link" href="{{ route('register') }}">@lang('Inscription')</a></li>
            @else
                <li class="nav-item"><a class="nav-link" href="{{ route('user',Auth::user()->id ) }}">{{Auth::user()->name}}</a></li>
                <li class="nav-item">
                    <a id="logout" class="nav-link" href="{{ route('logout') }}">@lang('Déconnexion')</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hide">
                        {{ csrf_field() }}
                    </form>
                </li>
                @endguest
        </ul>
    </div>
</nav>
@if (session('ok'))
    <div class="container">
        <div class="alert alert-dismissible alert-success fade show" role="alert">
            {{ session('ok') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
@endif
@yield('content')
<script src="{{ asset('js/app.js') }}"></script>
@yield('script')
<script>
    $(function() {
        $('#logout').click(function(e) {
            e.preventDefault();
            $('#logout-form').submit()
        })
    })
</script>
</body>
</html>