<div class="mb-3">
    <div class="form-check">
        <input
            type="checkbox"
            id="{{ $id }}"
            name="{{ $name }}"
            class="form-check-input {{ $class ?? '' }}"
            {{ $attributes->merge(['required' => $required ?? false]) }}>
        <label class="form-check-label" for="{{ $id }}">{{ $label }}</label>
        <div class="invalid-feedback">{{ $error ?? '' }}</div>
    </div>
</div>
