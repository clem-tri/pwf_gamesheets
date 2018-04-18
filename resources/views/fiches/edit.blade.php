@extends('layouts.form')
@section('card')
    @component('components.card')
        @slot('title')
            @lang('Modifier une fiche')
        @endslot
        <form method="POST" action="{{ route('fiche.update', $fiche->id) }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PUT') }}

            @include('partials.form-group', [
               'title' => __('Nom'),
               'type' => 'text',
               'name' => 'nom',
               'value' => $fiche->nom,
               'required' => true,
               ])

            <div class="form-group{{ $errors->has('image') ? ' is-invalid' : '' }}">
                <label for="image">@lang('Image')</label>
                <div class="custom-file">
                    <input type="file" id="image" name="image" value="{{$fiche->image}}"  class="{{ $errors->has('image') ? ' is-invalid ' : '' }}custom-file-input">
                    <label class="custom-file-label" for="image"> {{$fiche->image}}</label>
                    @if ($errors->has('image'))
                        <div class="invalid-feedback">
                            {{ $errors->first('image') }}
                        </div>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <img id="currentImg" class="img-fluid img-thumbnail" src="{{asset('storage/'.$fiche->image)}}"/>
            </div>



            @include('partials.form-group-select', [
               'title' => __('Genre'),
               'name' => 'genre_id',
               'listoptions'=> $genres,
               'value' => $fiche->genre->id,
               'property' => 'nom',
               'required' => true,
               ])

            @include('partials.form-group-select', [
                'title' => __('Développeur'),
                'name' => 'developpeur_id',
                'listoptions'=> $developpeurs,
                'value' => $fiche->developpeur->id,
                'property' => 'nom',
                'required' => true,
                ])


            @include('partials.form-group-select', [
                'title' => __('Editeur'),
                'name' => 'editeur_id',
                'listoptions'=> $editeurs,
                'value' => $fiche->editeur->id,
                'property' => 'nom',
                'required' => true,
                ])

            <div class="form-group">
                <label for="synopsis">@lang('Synopsis (optionnel)')</label>
                <textarea class="form-control" rows="5" id="synopsis" name="synopsis" >{{$fiche->synopsis}}</textarea>
            </div>

            @include('partials.form-group', [
            'title' => __('Date de sortie'),
            'type' => 'date',
            'value' => $fiche->annee,
            'name' => 'annee',
            'required' => true,
            ])

            <div class="form-group">
                <div class="form-check">

                <input class="form-check-input" id="en_ligne" name="en_ligne" type="checkbox"
                @if ($fiche->en_ligne == 1)
                    checked="checked"
                @endif
                >
                <label class="form-check-label" for="en_ligne">Jouable en ligne</label>
            </div>
            </div>


            @include('partials.form-group', [
            'title' => __('Site internet'),
            'type' => 'text',
            'name' => 'site',
            'value' => $fiche->site,
            'required' => false,
            ])
            @component('components.button')
                @lang('Envoyer')
            @endcomponent
        </form>
    @endcomponent
@endsection
@section('script')
    <script>
        $(function() {
            $('input[type="file"]').on('change',function(){
                let fileName = $(this).val().replace(/^.*[\\\/]/, '')
                $(this).next('.custom-file-label').html(fileName)
            })
        })
    </script>
@endsection