<div class="mb-3">
    <label class="form-label" for="flatpickr-date">{{ $label }}</label>
    <input type="text" id="flatpickr-date" name="{{ $name }}"
        class="form-control flatpickr-input active {{ $class ?? '' }}" placeholder="{{ $placeholder ?? 'YYYY-MM-DD' }}"
        readonly {{ $attributes->merge(['required' => $required ?? false]) }}>
    <div class="valid-feedback">Looks good!</div>
    <div class="invalid-feedback">{{ $error ?? 'Please select a date.' }}</div>
</div>
