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

            <div class="form-group{{ $errors->has('fiche') ? ' is-invalid' : '' }}">
                <label for="image">@lang('Image')</label>
                <div class="custom-file">
                    <input type="file" id="image" name="image" class="{{ $errors->has('fiche') ? ' is-invalid ' : '' }}custom-file-input" required>
                    <label class="custom-file-label" for="image"></label>
                    @if ($errors->has('fiche'))
                        <div class="invalid-feedback">
                            {{ $errors->first('fiche') }}
                        </div>
                    @endif
                </div>
            </div>



            @include('partials.form-group-select', [
               'title' => __('Genre'),
               'name' => 'genre_id',
               'listoptions'=> $genres,
               'property' => 'nom',
               'required' => true,
               ])

            @include('partials.form-group-select', [
                'title' => __('Développeur'),
                'name' => 'developpeur_id',
                'listoptions'=> $developpeurs,
                'property' => 'nom',
                'required' => true,
                ])


            @include('partials.form-group-select', [
                'title' => __('Editeur'),
                'name' => 'editeur_id',
                'listoptions'=> $editeurs,
                'property' => 'nom',
                'required' => true,
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
            'required' => true,
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