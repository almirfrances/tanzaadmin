<x-layouts.main>
    @section('title', 'User Registration')

    <div class="container-xxl">
        <div class="authentication-wrapper authentication container-p-y">
            <div class="authentication-inner py-4">
                <!-- Register -->
                <div class="card mt-4 shadow-lg" style="max-width: 700px; margin: auto;">
                    <div class="card-body">
                        <!-- Logo -->
                        @isModule('Settings')
                        <div class="app-brand justify-content-center mb-4 mt-2">
                            <a href="{{ route('register') }}" class="app-brand-link gap-2">
                                <span class="app-brand-logo">
                                    <img src="{{ asset('storage/' . $settings['logo_dark']) }}"
                                        style="width: auto; height: 45px;">
                                </span>
                            </a>
                        </div>
                        @endisModule

                        <h4 class="mb-1 pt-2 text-center">Welcome to {{ config('app.name') }}! 👋</h4>
                        <p class="mb-4 text-center">Create an account to get started</p>

                        <!-- Flash Messages -->
                        @if(session('status'))
                        <x-partials.alert type="success" message="{{ session('status') }}" />
                        @elseif($errors->any())
                        <x-partials.alert type="danger" message="{{ $errors->first() }}" />
                        @endif

                        <!-- Registration Form -->
                        <form id="formAuthentication" class="mb-3" action="{{ route('register') }}" method="POST">
                            @csrf
                            <div class="row g-3">
                                <!-- Full Name -->
                                <div class="col-md-6">
                                    <x-form.input-text id="name" name="name" label="Full Name"
                                        placeholder="Enter your full name" value="{{ old('name') }}" required="true"
                                        class="{{ $errors->has('name') ? 'is-invalid' : '' }}" />
                                </div>

                                <!-- Username -->
                                <div class="col-md-6">
                                    <x-form.input-text id="username" name="username" label="Username"
                                        placeholder="Enter your username" value="{{ old('username') }}" required="true"
                                        class="{{ $errors->has('username') ? 'is-invalid' : '' }}" />
                                </div>

                                <!-- Phone -->
                                <div class="col-md-6">
                                    <x-form.input-text id="phone" name="phone" label="Phone Number"
                                        placeholder="Enter your phone number" value="{{ old('phone') }}" required="true"
                                        class="{{ $errors->has('phone') ? 'is-invalid' : '' }}" />
                                </div>

                                <!-- Email -->
                                <div class="col-md-6">
                                    <x-form.input-text id="email" name="email" label="Email"
                                        placeholder="Enter your email" value="{{ old('email') }}" required="true"
                                        class="{{ $errors->has('email') ? 'is-invalid' : '' }}" />
                                </div>

                                <!-- Password -->
                                <div class="col-md-6">
                                    <x-form.input-password id="password" name="password" label="Password"
                                        placeholder="Enter your password" required="true"
                                        class="{{ $errors->has('password') ? 'is-invalid' : '' }}" />
                                </div>

                                <!-- Confirm Password -->
                                <div class="col-md-6">
                                    <x-form.input-password id="password_confirmation" name="password_confirmation"
                                        label="Confirm Password" placeholder="Re-enter your password" required="true" />
                                </div>

                                <!-- Terms and Conditions -->
                                <div class="col-md-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="terms-conditions"
                                            name="terms">
                                        <label class="form-check-label" for="terms-conditions">
                                            I agree to
                                            <a href="javascript:void(0);">privacy policy & terms</a>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="mt-3">
                                <x-partials.button type="primary" label="Sign Up" class="d-grid w-100" />
                            </div>
                        </form>

                        <!-- Redirect to Login -->
                        <p class="text-center">
                            <span>Already have an account?</span>
                            <a href="{{ route('login') }}">
                                <span>Sign in instead</span>
                            </a>
                        </p>

                        <!-- Divider -->
                        <div class="divider my-4">
                            <div class="divider-text">or</div>
                        </div>






                        <!-- Divider -->
                        <div class="divider my-4">
                            <div class="divider-text">or</div>
                        </div>

                        <!-- Social Icons -->
                        <div class="d-flex justify-content-center gap-3">
                            @php
                            // Fetch active social login providers
                            $activeProviders = \Modules\Users\Models\SocialLogin::where('status',
                            1)->pluck('provider')->toArray();

                            // Map providers to their respective icon classes, labels, and colors
                            $socialIcons = [
                            'facebook' => [
                            'class' => 'icon-tabler-brand-facebook',
                            'label' => 'Facebook',
                            'color' => '#1877F2',
                            ],
                            'google' => [
                            'class' => 'icon-tabler-brand-google',
                            'label' => 'Google',
                            'color' => '#DB4437',
                            ],
                            'twitter' => [
                            'class' => 'icon-tabler-brand-x',
                            'label' => 'X (Twitter)',
                            'color' => '#1DA1F2',
                            ],
                            'github' => [
                            'class' => 'icon-tabler-brand-github',
                            'label' => 'GitHub',
                            'color' => '#333333',
                            ],
                            ];
                            @endphp

                            @foreach ($activeProviders as $provider)
                            @if (array_key_exists($provider, $socialIcons))
                            <a href="{{ route('social.redirect', ['provider' => $provider]) }}"
                                class="social-login-icon" title="Sign in with {{ $socialIcons[$provider]['label'] }}"
                                style="background: linear-gradient(45deg, {{ $socialIcons[$provider]['color'] }}70, #f3f3f3);">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="{{ $socialIcons[$provider]['color'] }}" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="icon">
                                    <!-- Replace this path with the respective SVG path for each provider -->
                                    @if ($provider === 'facebook')
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M7 10v4h3v7h4v-7h3l1 -4h-4v-2a1 1 0 0 1 1 -1h3v-4h-3a5 5 0 0 0 -5 5v2h-3" />
                                    @elseif ($provider === 'google')
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M20.945 11a9 9 0 1 1 -3.284 -5.997l-2.655 2.392a5.5 5.5 0 1 0 2.119 6.605h-4.125v-3h7.945z" />
                                    @elseif ($provider === 'twitter')
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M4 4l11.733 16h4.267l-11.733 -16z" />
                                    <path d="M4 20l6.768 -6.768m2.46 -2.46l6.772 -6.772" />
                                    @elseif ($provider === 'github')
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M9 19c-4.3 1.4 -4.3 -2.5 -6 -3m12 5v-3.5c0 -1 .1 -1.4 -.5 -2c2.8 -.3 5.5 -1.4 5.5 -6a4.6 4.6 0 0 0 -1.3 -3.2a4.2 4.2 0 0 0 -.1 -3.2s-1.1 -.3 -3.5 1.3a12.3 12.3 0 0 0 -6.2 0c-2.4 -1.6 -3.5 -1.3 -3.5 -1.3a4.2 4.2 0 0 0 -.1 3.2a4.6 4.6 0 0 0 -1.3 3.2c0 4.6 2.7 5.7 5.5 6c-.6 .6 -.6 1.2 -.5 2v3.5" />
                                    @endif
                                </svg>
                            </a>
                            @endif
                            @endforeach
                        </div>

                        <style>
                            .social-login-icon {
                                width: 50px;
                                height: 50px;
                                display: flex;
                                align-items: center;
                                justify-content: center;
                                border-radius: 20%;
                                transition: all 0.3s;
                                text-decoration: none;
                            }

                            .social-login-icon:hover {
                                opacity: 0.6;
                            }

                        </style>



                    </div>
                </div>
                <!-- /Register -->
            </div>
        </div>
    </div>
</x-layouts.main>
