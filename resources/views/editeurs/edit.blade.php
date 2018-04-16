@extends('layouts.form')
@section('card')
    @component('components.card')
        @slot('title')
            @lang('Modifier un éditeur')
        @endslot
        <form method="POST" action="{{ route('editeur.update', $editeur->id) }}">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            @include('partials.form-group', [
                'title' => __('Nom'),
                'type' => 'text',
                'name' => 'nom',
                'value' => $editeur->nom,
                'required' => true,
                ])
            <div class="form-group{{ $errors->has('logo') ? ' is-invalid' : '' }}">
                <label for="logo">@lang('Logo')</label>
                <div class="custom-file">
                    <input type="file" id="logo" name="logo" value="{{$editeur->logo}}"  class="{{ $errors->has('logo') ? ' is-invalid ' : '' }}custom-file-input">
                    <label class="custom-file-label" for="logo"> {{$editeur->logo}}</label>
                    @if ($errors->has('logo'))
                        <div class="invalid-feedback">
                            {{ $errors->first('logo') }}
                        </div>
                    @endif
                </div>
            </div>
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