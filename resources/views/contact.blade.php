@extends('layouts.form')
@section('card')
    @component('components.card')
    @slot('title')
    @lang('Contact')
    @endslot
   <div class="row">

       Vous pouvez nous contacter par mail Projet web :

           carvalhopt22@gmail.com<br/>
           nicolas.sarrazin88@gmail.com<br/>
           clement.tritta@gmail.com<br/>
           omar.abdallaa@gmail.com<br/>



           Projet flux :   <br/>


       noemie.loubiere@gmail.com

   </div>
    @endcomponent
@endsection