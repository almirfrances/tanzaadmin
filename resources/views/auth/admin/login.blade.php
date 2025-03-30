<x-layouts.main>
    @section('title', 'Admin Login')

    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner py-4">
                <!-- Login -->
                <div class="card">
                    <div class="card-body">
                        <!-- Logo -->
                        @isModule('Settings')
                        <div class="app-brand justify-content-center mb-4 mt-2">
                            <a href="{{ route('admin.login') }}" class="app-brand-link gap-2">
                                <span class="app-brand-logo">
                                    <img src="{{ asset('storage/' . $settings['logo_dark']) }}" style="width: auto; height: 45px;">
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
                        <form id="formAuthentication" class="mb-3 fv-plugins-bootstrap5 fv-plugins-framework" action="{{ route('admin.login') }}" method="POST" novalidate="novalidate">
                            @csrf

                            <!-- Email or Username Input -->
                            <x-form.input-text
                                id="login"
                                name="login"
                                label="Email, Phone or Username"
                                placeholder="Enter your email, phone or username"
                                value="{{ old('login') }}"
                                required="true"
                                class="{{ $errors->has('login') ? 'is-invalid' : '' }}"
                            />


                            <!-- Password Input -->
                            <x-form.input-password
                                id="password"
                                name="password"
                                label="Password"
                                placeholder="············"
                                required="true"
                                class="{{ $errors->has('password') ? 'is-invalid' : '' }}"
                            />


                            <!-- Remember Me Checkbox -->
                            <x-form.checkbox
                                id="remember-me"
                                name="remember"
                                label="Remember me"
                                class="{{ $errors->has('remember') ? 'is-invalid' : '' }}"
                            />

                        

                            <!-- Submit Button -->
                            <x-partials.button
                                type="primary"
                                label="Sign in"
                                class="d-grid w-100"
                            />

                        </form>
                        @isModule('Email')
                        <div>
                            <a href="{{ route('admin.forgot-password') }}">
                                <small>Forgot Password?</small>
                              </a>
                        </div>
                        @endisModule
                    </div>
                </div>
                <!-- /Login -->
            </div>
        </div>
    </div>
</x-layouts.main>
