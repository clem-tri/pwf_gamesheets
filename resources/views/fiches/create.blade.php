@extends('layouts.form')
@section('card')
    @component('components.card')
        @slot('title')
            @lang('Ajouter une fiche')
        @endslot
        <form method="POST" action="{{ route('fiche.store') }}" enctype="multipart/form-data">
            {{ csrf_field() }}

            @include('partials.form-group', [
               'title' => __('Nom'),
               'type' => 'text',
               'name' => 'nom',
               'required' => true,
               ])

            <div class="form-group{{ $errors->has('image') ? ' is-invalid' : '' }}">
                <label for="image">@lang('Image')</label>
                <div class="custom-file">
                    <input type="file" id="image" name="image" class="{{ $errors->has('image') ? ' is-invalid ' : '' }}custom-file-input" required>
                    <label class="custom-file-label" for="image"></label>
                    @if ($errors->has('image'))
                        <div class="invalid-feedback">
                            {{ $errors->first('image') }}
                        </div>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label>Plateformes</label>
                <ul>
            @foreach($plateformes as $plateforme)
                <li style="display: inline-list-item;">
                    <label for="Plateforme_{{$plateforme->id}}">{{$plateforme->nom}}</label>
                    <input class=" checkbox-inline" id="Plateforme_{{$plateforme->id}}" name="Plateformes[]" value="{{$plateforme->id}}" type="checkbox">
                </li>
            @endforeach
                </ul>
            </div>

            <div class="form-group">
                <label>Pictogrammes</label>
                <ul>
                    @foreach($pictogrammes as $pictogramme)
                        <li style="display: inline-block;">
                            <img width="20%" src="{{asset("storage/$pictogramme->logo")}}"/>
                            <input class=" checkbox-inline" id="Pictogramme_{{$pictogramme->id}}" name="Pictogrammes[]" value="{{$pictogramme->id}}" type="checkbox">
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="form-group">
                <label for="extension">Extension(s) :</label>
                <div class="input-group">
                    <input class="form-control" id="extension" name="extension">

                    <button id="addExtension" type="button" class="btn btn-success" ><i class="fa fa-plus"></i></button>
                </div>
            </div>

            <div class="form-group">
                <div id="extensions">
                </div>
            </div>




            @include('partials.form-group-select', [
               'title' => __('Genre'),
               'name' => 'genre_id',
               'listoptions'=> $genres->sortBy("nom"),
               'property' => 'nom',
               'required' => true
               ])

            @include('partials.form-group-select', [
                'title' => __('Développeur'),
                'name' => 'developpeur_id',
                'listoptions'=> $developpeurs->sortBy("nom"),
                'property' => 'nom',
                'required' => true
                ])


            @include('partials.form-group-select', [
                'title' => __('Editeur'),
                'name' => 'editeur_id',
                'listoptions'=> $editeurs->sortBy("nom"),
                'property' => 'nom',
                'required' => true
                ])

            <div class="form-group{{ $errors->has('fiche') ? ' is-invalid' : '' }}">
                <label for="synopsis">@lang('Synopsis (optionnel)')</label>
                <textarea class="form-control" rows="5" id="synopsis" name="synopsis" ></textarea>
            </div>

            @include('partials.form-group', [
            'title' => __('Date de sortie'),
            'type' => 'date',
            'name' => 'annee',
            'required' => true,
            ])

            <div class="checkbox">
                <label for="en_ligne">Jouable en ligne</label>
                    <input class=" checkbox-inline" id="en_ligne" name="en_ligne" type="checkbox">
            </div>

            @include('partials.form-group', [
            'title' => __('Site internet'),
            'type' => 'text',
            'name' => 'site',
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
    <script>
        $( "#addExtension" ).click(function() {
            let extension = $("#extension").val();
            let nbExt = $("#extensions > div").length;
            if(extension){

                $( "#extensions").append(
                    '<div class="input-group">' +
                    '<input class="form-control" id="Extensions_'+nbExt+'" name="Extensions['+nbExt+']" value="'+extension+'"/>' +
                    ' <button type="button" class="btn btn-warning"><i class="fa fa-times"</button>' +
                    '</div>'
                );
                $("#extension").val('');
            }

        });

    </script>
@endsection
