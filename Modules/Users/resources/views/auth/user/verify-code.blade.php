<x-layouts.main>
    @section('title', 'Verify Reset Code')

    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner py-4">
                <!-- Verify Reset Code -->
                <div class="card">
                    <div class="card-body">
                        <!-- Logo -->
                        @isModule('Settings')
                        <div class="app-brand justify-content-center mb-4 mt-2">
                            <a href="{{ route('login') }}" class="app-brand-link gap-2">
                                <span class="app-brand-logo">
                                    <img src="{{ asset('storage/' . ($settings['logo_dark'] ?? 'default-logo.png')) }}" style="width: auto; height: 45px;">
                                </span>
                            </a>
                        </div>
                        @endisModule
                        <!-- /Logo -->

                        <h4 class="mb-1">Verify Your Reset Code 🔒</h4>
                        <p class="mb-4">
                            A 6-digit verification code was sent to your email address. Please enter the code below to proceed.
                        </p>

                        <!-- Display Flash Messages -->
                        @if(session('status'))
                            <x-partials.alert type="success" message="{{ session('status') }}" />
                        @elseif($errors->has('reset_code'))
                            <x-partials.alert type="danger" message="{{ $errors->first('reset_code') }}" />
                        @endif

                        <form id="verifyCodeForm" class="mb-3 fv-plugins-bootstrap5 fv-plugins-framework" action="{{ route('user.verify-reset-code') }}" method="POST" novalidate="novalidate">
                            @csrf
                            <div class="mb-3 fv-plugins-icon-container">
                                <label class="form-label mb-2" for="reset_code">Verification Code</label>
                                <div class="auth-input-wrapper d-flex align-items-center justify-content-sm-between numeral-mask-wrapper">
                                    <input type="tel" class="form-control auth-input h-px-50 text-center numeral-mask mx-1 my-2" maxlength="1" name="digit1" autofocus>
                                    <input type="tel" class="form-control auth-input h-px-50 text-center numeral-mask mx-1 my-2" maxlength="1" name="digit2">
                                    <input type="tel" class="form-control auth-input h-px-50 text-center numeral-mask mx-1 my-2" maxlength="1" name="digit3">
                                    <input type="tel" class="form-control auth-input h-px-50 text-center numeral-mask mx-1 my-2" maxlength="1" name="digit4">
                                    <input type="tel" class="form-control auth-input h-px-50 text-center numeral-mask mx-1 my-2" maxlength="1" name="digit5">
                                    <input type="tel" class="form-control auth-input h-px-50 text-center numeral-mask mx-1 my-2" maxlength="1" name="digit6">
                                </div>
                                <input type="hidden" id="reset_code" name="reset_code">
                                @error('reset_code')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Submit Button -->
                            <x-partials.button
                                type="primary"
                                label="Verify Code"
                                class="d-grid w-100"
                            />
                        </form>

                        <div class="text-center">
                            Didn't receive the code?
                            <a href="{{ route('user.forgot-password') }}" class="text-primary">Resend</a>
                        </div>
                    </div>
                </div>
                <!-- /Verify Reset Code -->
            </div>
        </div>
    </div>
</x-layouts.main>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const inputs = document.querySelectorAll('.numeral-mask');
        const hiddenField = document.getElementById('reset_code');

        inputs.forEach((input, index) => {
            input.addEventListener('input', () => {
                if (input.value.length === 1 && index < inputs.length - 1) {
                    inputs[index + 1].focus();
                }
                updateHiddenField();
            });

            input.addEventListener('keydown', (e) => {
                if (e.key === 'Backspace' && input.value === '' && index > 0) {
                    inputs[index - 1].focus();
                }
            });
        });

        function updateHiddenField() {
            const code = Array.from(inputs).map(input => input.value).join('');
            hiddenField.value = code;
        }
    });
</script>
