<div class="mb-3">
    <label class="form-label" for="{{ $id }}">{{ $label }}</label>
    <div class="input-group">
        <input
            type="password"
            id="{{ $id }}"
            name="{{ $name }}"
            class="form-control {{ $class ?? '' }}"
            placeholder="{{ $placeholder ?? '' }}"
            {{ $attributes->merge(['required' => $required ?? false]) }}
            aria-describedby="password" />
        <span class="input-group-text cursor-pointer" id="toggle-password">
            <i class="ti ti-eye-off" id="eye-icon"></i>
        </span>
    </div>
</div>

<script>
    // Get the input and eye icon elements
    const passwordInput = document.getElementById('{{ $id }}');
    const eyeIcon = document.getElementById('eye-icon');
    const togglePassword = document.getElementById('toggle-password');

    // Toggle password visibility
    togglePassword.addEventListener('click', function() {
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeIcon.classList.remove('ti-eye-off');
            eyeIcon.classList.add('ti-eye');
        } else {
            passwordInput.type = 'password';
            eyeIcon.classList.remove('ti-eye');
            eyeIcon.classList.add('ti-eye-off');
        }
    });
</script>
