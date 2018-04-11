@extends('layouts.app')

@section('content')
    <style>
        #pseudocard {
            border: 2px solid #fd5700;
            border-radius: 10px;
            background-color: rgba(253, 87, 0, 0.5);
            padding-top:30px;
            color:white;
        }
    </style>
    <div class="container">

        <div id="pseudocard" class="row">
            <div class="col-md-6">

                <img id="colgauche" src="{{asset('img/miniature.jpg')}}" >
                <br><br>
                <label class="lititle">Description :</label>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                    labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
                    nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit
                    esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat.</p>
            </div>
            <div id="coldroite" class="col-md-6">
                <h1>Pacman</h1>
                <br>
                <ul id="contenuefiche">
                    <li class="lititle">Editeur : Namco</li>

                    <li class="lititle">Année de sortie : 1980</li>

                    <li class="lititle">Plateforme : Atari 2600, Atari 5200, ColecoVision, Famicom Disk System, NES, Game Boy, Game Boy Color, Game Boy Advance, Game Gear, Intellivision, iPod, PlayStation, Xbox 360
                    </li>

                    <li class="lititle">Catégorie : Arcade</li>

                    <li class="lititle">Genre : Labyrinthe</li>

                    <li class="lititle">Prix : 10€</li>

                </ul>

            </div>


        </div>

    </div>


@endsection