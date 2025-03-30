<div class="mb-3">
    <label class="switch switch-primary">
        <input
            type="checkbox"
            id="{{ $id }}"
            name="{{ $name }}"
            class="switch-input {{ $class ?? '' }}"
            {{ $attributes->merge(['required' => $required ?? false]) }}
            {{ $checked ?? false ? 'checked' : '' }}>
        <span class="switch-toggle-slider">
            <span class="switch-on"><i class="ti ti-check"></i></span>
            <span class="switch-off"><i class="ti ti-x"></i></span>
        </span>
        <span class="switch-label">{{ $label }}</span>
    </label>
</div>
