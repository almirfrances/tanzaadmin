<div class="mb-3">
    <label class="form-label d-block">{{ $label }}</label>
    @foreach($options as $key => $option)
        <div class="form-check">
            <input
                type="radio"
                id="{{ $id }}-{{ $key }}"
                name="{{ $name }}"
                value="{{ $key }}"
                class="form-check-input {{ $class ?? '' }}"
                {{ (isset($value) && $key == $value) ? 'checked' : '' }}

            <label class="form-check-label" for="{{ $id }}-{{ $key }}">{{ $option }}</label>
        </div>
    @endforeach
</div>
