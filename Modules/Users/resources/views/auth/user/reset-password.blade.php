<x-layouts.main>
    @section('title', 'Reset Password')

    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner py-4">
                <!-- Reset Password -->
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

                        <h4 class="mb-1">Reset Your Password 🔒</h4>
                        <p class="mb-4">
                            Enter a new password to secure your account.
                        </p>

                        <!-- Display Flash Messages -->
                        @if(session('status'))
                            <x-partials.alert type="success" message="{{ session('status') }}" />
                        @elseif($errors->any())
                            <x-partials.alert type="danger" message="Please fix the errors below." />
                        @endif

                        <form id="resetPasswordForm" class="mb-3 fv-plugins-bootstrap5 fv-plugins-framework" action="{{ route('user.update-password') }}" method="POST" novalidate="novalidate">
                            @csrf

                            <!-- New Password Input -->
                            <x-form.input-password
                                id="password"
                                name="password"
                                label="New Password"
                                placeholder="············"
                                required="true"
                                class="{{ $errors->has('password') ? 'is-invalid' : '' }}"
                            />
                            @error('password')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror

                            <!-- Confirm Password Input -->
                            <x-form.input-password
                                id="password_confirmation"
                                name="password_confirmation"
                                label="Confirm New Password"
                                placeholder="············"
                                required="true"
                                class="{{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}"
                            />
                            @error('password_confirmation')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror

                            <!-- Submit Button -->
                            <x-partials.button
                                type="primary"
                                label="Set New Password"
                                class="d-grid w-100"
                            />
                        </form>
                    </div>
                </div>
                <!-- /Reset Password -->
            </div>
        </div>
    </div>
</x-layouts.main>
