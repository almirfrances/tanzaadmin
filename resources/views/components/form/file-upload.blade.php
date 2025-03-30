<div class="mb-3">
    <label class="form-label" for="{{ $id }}">{{ $label }}</label>
    <input
        type="file"
        id="{{ $id }}"
        name="{{ $name }}"
        class="form-control {{ $class ?? '' }}"
        {{ $attributes->merge(['required' => $required ?? false]) }}>
    <div class="invalid-feedback">{{ $error ?? 'Please upload a file.' }}</div>
</div>
