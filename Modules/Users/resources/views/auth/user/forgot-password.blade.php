<x-layouts.main>
    @section('title', 'Forgot Password')

    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner py-4">
                <!-- Forgot Password -->
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
                        <!-- /Logo -->

                        <h4 class="mb-1">Forgot Password? 🔒</h4>
                        <p class="mb-4">
                            Enter your email, phone, or username below, and we'll send you a 6-digit reset code to recover your account.
                        </p>

                        <!-- Display Flash Messages -->
                        @if(session('status'))
                            <x-partials.alert type="success" message="{{ session('status') }}" />
                        @elseif($errors->has('login'))
                            <x-partials.alert type="danger" message="{{ $errors->first('login') }}" />
                        @endif

                        <form id="formAuthentication" class="mb-3 fv-plugins-bootstrap5 fv-plugins-framework" action="{{ route('user.send-reset-code') }}" method="POST" novalidate="novalidate">
                            @csrf

                            <!-- Input for Email, Username, or Phone -->
                            <x-form.input-text
                                id="login"
                                name="login"
                                label="Email, Phone or Username"
                                placeholder="Enter your email, phone or username"
                                value="{{ old('login') }}"
                                required="true"
                                class="{{ $errors->has('login') ? 'is-invalid' : '' }}"
                            />

                            <!-- Submit Button -->
                            <x-partials.button
                                type="primary"
                                label="Send Reset Code"
                                class="d-grid w-100"
                            />
                        </form>

                        <div class="text-center mt-3">
                            <a href="{{ route('login') }}" class="d-flex align-items-center justify-content-center">
                                <i class="ti ti-chevron-left scaleX-n1-rtl"></i> Back to login
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /Forgot Password -->
            </div>
        </div>
    </div>
</x-layouts.main>
