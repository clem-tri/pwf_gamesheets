<div class="form-group">
    <label for="{{ $name }}">{{ $title }}</label>
    <select class="form-control" id="{{ $name }}" name="{{$name}}">
        <option value=""></option>
        @foreach($listoptions as $option)

            <option value="{{ $option->id }}"
                    @if (isset($value) && $option->id == $value)
                    selected="selected"
                    @endif>
                {{ $option->$property }}
            </option>

        @endforeach
    </select>
</div>