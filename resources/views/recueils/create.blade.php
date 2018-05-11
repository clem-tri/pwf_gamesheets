@extends('layouts.form')

@section('card')

    @component('components.card')

        @slot('title')
            @lang('Créer un recueil')
        @endslot

        <form method="POST" action="{{ route('recueil.generate')  }}" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="form-group">
            <label for="existingFiches">Selectionner les fiches que vous voulez inclure</label>
            <select id="existingFiches" data-class="btn-primary" class="four-boot-select" multiple>
                @foreach($fiches as $fiche)
                    <option value="{{$fiche->id}}">{{$fiche->nom}}</option>
                @endforeach
            </select>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success pull-right" name="ePub"><i class="fa fa-book"></i> EPUB</button>
                <button type="submit" class="btn btn-danger pull-right" name="pdf"><i class="fa fa-file-pdf"></i> PDF</button>
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