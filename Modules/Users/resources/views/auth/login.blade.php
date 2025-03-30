<x-layouts.main>
    @section('title', 'User Login')
    @php
    // Fetch settings for form visibility
    $enableLoginForm = \Modules\Settings\Models\Setting::getValue('enable_login_form', true);
@endphp
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner py-4">
                <!-- Login -->
                <div class="card">
                    <div class="card-body">
                        <!-- Logo -->
                        @isModule('Settings')
                        <div class="app-brand justify-content-center mb-4 mt-2">
                            <a href="{{ route('login') }}" class="app-brand-link gap-2">
                                <span class="app-brand-logo">
                                    <img src="{{ asset('storage/' . $settings['logo_dark']) }}"
                                        style="width: auto; height: 45px;">
                                </span>
                            </a>
                        </div>
                        @endisModule
                        <!-- /Logo -->

                        <h4 class="mb-1 pt-2">Welcome to {{ config('app.name') }}! 👋</h4>
                        <p class="mb-4">Please sign-in to your account and start the adventure</p>

                        <!-- Display Flash Messages (Success, Error, Warning) -->
                        @if(session('status'))
                        <x-partials.alert type="success" message="{{ session('status') }}" />
                        @elseif($errors->has('login'))
                        <x-partials.alert type="danger" message="{{ $errors->first('login') }}" />
                        @endif
                        @if($enableLoginForm)
                        <form id="formAuthentication" class="mb-3 fv-plugins-bootstrap5 fv-plugins-framework"
                            action="{{ route('login') }}" method="POST" novalidate="novalidate">
                            @csrf

                            <!-- Email or Username Input -->
                            <x-form.input-text id="login" name="login" label="Email, Phone or Username"
                                placeholder="Enter your email, phone or username" value="{{ old('login') }}"
                                required="true" class="{{ $errors->has('login') ? 'is-invalid' : '' }}" />



                            <!-- Password Input -->
                            <x-form.input-password id="password" name="password" label="Password"
                                placeholder="············" required="true"
                                class="{{ $errors->has('password') ? 'is-invalid' : '' }}" />
                            <div class="d-flex justify-content-between">
                                <!-- Remember Me Checkbox -->
                                <x-form.checkbox id="remember-me" name="remember" label="Remember me"
                                    class="{{ $errors->has('remember') ? 'is-invalid' : '' }}" />
                                @isModule('Email')
                                <a href="{{ route('user.forgot-password') }}">
                                    <small>Forgot Password?</small>
                                </a>
                                @endisModule


                            </div>


                            <!-- Submit Button -->
                            <x-partials.button type="primary" label="Sign in" class="d-grid w-100" />

                        </form>

                        @isModule('Settings')
                        <!-- Redirect to Login -->
                        @if(isset($settings['allow_user_registration']) && $settings['allow_user_registration'])

                        <p class="text-center">
                            <span>Already have an account?</span>
                            <a href="{{ route('register') }}">
                                <span>Sign up instead</span>
                            </a>
                        </p>
                        @endif
                        @endisModule


                        <!-- Divider -->
                        <div class="divider my-4">
                            <div class="divider-text">or</div>
                        </div>
@endif
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
                <!-- /Login -->
            </div>
        </div>
    </div>
</x-layouts.main>
