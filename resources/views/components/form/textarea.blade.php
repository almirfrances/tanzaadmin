<div class="mb-3">
    <label class="form-label" for="{{ $id }}">{{ $label }}</label>
    <textarea
        id="{{ $id }}"
        name="{{ $name }}"
        class="form-control {{ $class ?? '' }}"
        rows="{{ $rows ?? 3 }}"
        placeholder="{{ $placeholder ?? '' }}"
        {{ $attributes->merge(['required' => $required ?? false]) }}>
        {{ $value ?? '' }}
    </textarea>
    <div class="valid-feedback">Looks good!</div>
    <div class="invalid-feedback">{{ $error ?? '' }}</div>
</div>
