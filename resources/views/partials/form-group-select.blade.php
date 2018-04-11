<div class="form-group">
    <label for="{{ $name }}">{{ $title }}</label>
    <select class="form-control" id="{{ $name }}" name="{{$name}} {{ $required ? 'required' : ''}}">
        <option value=""></option>
        @foreach($listoptions as $id => $option)

            <option value="{{ $id }}">{{ $option }}</option>

        @endforeach
    </select>
</div>