@extends('layouts.form')
@section('card')
    @component('components.card')
        @slot('title')
            @lang('Ajouter une fiche')
        @endslot
        <form method="POST" action="{{ route('fiche.store') }}" enctype="multipart/form-data">
            {{ csrf_field() }}
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
            <div class="form-group">
                <label for="genre_id">@lang('Genre')</label>
                <select id="genre_id" name="genre_id" class="form-control">
                    @foreach($genres as $genre)
                        <option value="{{ $genre->id }}">{{ $genre->nom }}</option>
                    @endforeach
                </select>
            </div>
            @include('partials.form-group', [
                'title' => __('Synopsis (optionnel)'),
                'type' => 'text',
                'name' => 'description',
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