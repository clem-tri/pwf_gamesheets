@extends('layouts.form')

@section('card')

    @component('components.card')

        @slot('title')
            @lang('Créer un recueil')
        @endslot

        <form method="POST" action="{{ route('recueil.generate')  }}" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="form-group">
            <label for="Fiches">Selectionner les fiches que vous voulez inclure</label>
            <select id="Fiches" name="Fiches[]" data-class="btn-primary" class="four-boot-select" multiple required>
                @foreach($fiches as $fiche)
                    <option value="{{$fiche->id}}">{{$fiche->nom}}</option>
                @endforeach
            </select>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success pull-right" name="generate" value="epub"><i class="fa fa-book"></i> EPUB</button>
                <button type="submit" class="btn btn-danger pull-right" name="generate" value="pdf"><i class="fa fa-file-pdf"></i> PDF</button>
            </div>




        </form>

    @endcomponent

@endsection

@section('script')
<script>
    $(document).ready(function() {
        $('.four-boot-select').fourBoot();
    });
</script>
@endsection
