<div class="mb-3">
    <label class="form-label" for="{{ $id }}">{{ $label }}</label>
    <input
        type="text"
        id="{{ $id }}"
        name="{{ $name }}"
        class="form-control {{ $class ?? '' }}"
        value="{{ $value ?? '' }}"
        placeholder="{{ $placeholder ?? '' }}"
        {{ $attributes->merge(['required' => $required ?? false]) }}>
    
</div>
