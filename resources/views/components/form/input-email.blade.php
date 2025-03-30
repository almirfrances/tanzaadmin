<div class="mb-3">
    <label class="form-label" for="{{ $id }}">{{ $label }}</label>
    <input
        type="email"
        id="{{ $id }}"
        name="{{ $name }}"
        class="form-control {{ $class ?? '' }}"
        value="{{ $value ?? '' }}"
        placeholder="{{ $placeholder ?? '' }}"
        {{ $attributes->merge(['required' => $required ?? false]) }}>
    <div class="valid-feedback">Looks good!</div>
    <div class="invalid-feedback">{{ $error ?? 'Please provide a valid email.' }}</div>
</div>
