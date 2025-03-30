<x-layouts.main>
    @section('title', 'Verify Email Address')

    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner py-4">
                <div class="card">
                    <div class="card-body">
                        <!-- Logo -->
                        @isModule('Settings')
                        <div class="app-brand justify-content-center mb-4 mt-2">
                            <a href="{{ route('login') }}" class="app-brand-link gap-2">
                                <span class="app-brand-logo">
                                    <img src="{{ asset('storage/' . $settings['logo_dark']) }}" style="width: auto; height: 45px;">
                                </span>
                            </a>
                        </div>
                        @endisModule

                        <h4 class="mb-1">Verify Your Email Address 🔒</h4>
                        <p class="mb-4">Enter the 6-digit code we sent to your email.</p>

                        @if($errors->any())
                            <x-partials.alert type="danger" message="{{ $errors->first() }}" />
                        @endif

                        <form method="POST" action="{{ route('user.verify-email.post') }}">
                            @csrf


                            <div class="mb-3 fv-plugins-icon-container">
                                <label class="form-label mb-2" for="code">Verification Code</label>
                                <div class="auth-input-wrapper d-flex align-items-center justify-content-sm-between numeral-mask-wrapper">
                                    <input type="tel" class="form-control auth-input h-px-50 text-center numeral-mask mx-1 my-2" maxlength="1" name="digit1" autofocus>
                                    <input type="tel" class="form-control auth-input h-px-50 text-center numeral-mask mx-1 my-2" maxlength="1" name="digit2">
                                    <input type="tel" class="form-control auth-input h-px-50 text-center numeral-mask mx-1 my-2" maxlength="1" name="digit3">
                                    <input type="tel" class="form-control auth-input h-px-50 text-center numeral-mask mx-1 my-2" maxlength="1" name="digit4">
                                    <input type="tel" class="form-control auth-input h-px-50 text-center numeral-mask mx-1 my-2" maxlength="1" name="digit5">
                                    <input type="tel" class="form-control auth-input h-px-50 text-center numeral-mask mx-1 my-2" maxlength="1" name="digit6">
                                </div>
                                <input type="hidden" id="code" name="code">
                                @error('code')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>
                            <x-partials.button
                                type="primary"
                                label="Verify Email"
                                class="d-grid w-100"
                            />
                        </form>

                        <div class="text-center mt-3">
                            Didn't receive the code?
                            <a href="#"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="text-primary">Resend Code</a>

                         <form id="logout-form" action="{{ route('user.resend-email-code') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.main>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const inputs = document.querySelectorAll('.numeral-mask');
        const hiddenField = document.getElementById('code');

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
