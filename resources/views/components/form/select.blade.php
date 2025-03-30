<div class="mb-3">
    <label class="form-label" for="{{ $id }}">{{ $label }}</label>
    <select
        id="{{ $id }}"
        name="{{ $name }}"
        class="form-select {{ $class ?? '' }}"
        @if($required ?? false) required @endif
    >
        @foreach($options as $key => $option)
        <option value="{{ $key }}" {{ isset($value) && (is_array($value) ? in_array($key, $value) : $key == $value) ? 'selected' : '' }}>
            {{ $option }}
        </option>
        @endforeach
    </select>
    <div class="valid-feedback">Looks good!</div>
    <div class="invalid-feedback">{{ $error ?? '' }}</div>
</div>
