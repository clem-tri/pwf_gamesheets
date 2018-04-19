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

            <div class="form-group">
                <label>Plateformes</label>
                <ul>
                    @foreach($plateformes as $plateforme)
                        <li style="display: inline-list-item;">
                            <label for="Plateforme_{{$plateforme->id}}">{{$plateforme->nom}}</label>
                            <input class=" checkbox-inline" id="Plateforme_{{$plateforme->id}}" name="Plateformes[]" value="{{$plateforme->id}}" type="checkbox"
                            @foreach($fiche->plateformes as $fplateforme)
                                @if($plateforme->id == $fplateforme->id)
                                        checked="checked"
                                        @endif
                            @endforeach
                            >
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
                            <input class=" checkbox-inline" id="Pictogramme_{{$pictogramme->id}}" name="Pictogrammes[]" value="{{$pictogramme->id}}" type="checkbox"
                                   @foreach($fiche->pictogrammes as $fpictogramme)
                                   @if($pictogramme->id == $fpictogramme->id)
                                   checked="checked"
                                    @endif
                                    @endforeach
                            >
                        </li>
                    @endforeach
                </ul>
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