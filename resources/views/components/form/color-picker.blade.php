<div class="mb-3 row">
    <label class="col-md-2 col-form-label" for="{{ $id }}">{{ $label }}</label>
    <div class="col-md-10">
        <input
            type="color"
            id="{{ $id }}"
            name="{{ $name }}"
            value="{{ $value ?? '#000000' }}"
            class="form-control {{ $class ?? '' }}"
            {{ $attributes->merge(['required' => $required ?? false]) }}>
    </div>
</div>
