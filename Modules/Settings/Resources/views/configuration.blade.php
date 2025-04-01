<x-layouts.app>
    @section('title', 'Site Configurations')

    <x-partials.breadcrumb
        :items="[
            ['name' => 'Home', 'url' => route('admin.dashboard')],
            ['name' => 'Settings', 'url' => route('admin.settings.index')],
            ['name' => 'Site Configurations'],
        ]"
        style="style1"
    />

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="mb-4">Site Configurations</h4>
        <p class="mb-4">Configure essential site features and behaviors. Toggle settings to customize your site's functionality and security.</p>

        <div class="row g-4">
            <!-- HTTPS Enforcement -->
            <div class="col-lg-6 col-md-12">
                <div class="card h-100">
                    <div class="card-header">
                        <h5 class="card-title">HTTPS Enforcement Settings</h5>
                    </div>
                    <div class="card-body d-flex flex-column">
                        <form action="{{ route('admin.settings.update-force-https') }}" method="POST">
                            @csrf
                            <div class="form-check form-switch">
                                <input class="form-check-input toggle-setting" type="checkbox" id="force_https" name="force_https"
                                    value="1" {{ $settings['force_https'] ?? false ? 'checked' : '' }}>
                                <label class="form-check-label" for="force_https">Force HTTPS</label>
                            </div>
                            <small class="form-text text-muted mt-auto">
                                Enforce HTTPS to secure data transmission and protect user information by ensuring all traffic uses encrypted connections.
                            </small>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-12">
                <div class="card h-100">
                    <div class="card-header">
                        <h5 class="card-title">Authentication Form Settings</h5>
                    </div>
                    <div class="card-body d-flex flex-column">
                        <form action="{{ route('admin.settings.update-auth-forms') }}" method="POST">
                            @csrf
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input toggle-setting" type="checkbox" id="enable_register_form" name="enable_register_form"
                                    value="1" {{ $settings['enable_register_form'] ?? false ? 'checked' : '' }}>
                                <label class="form-check-label" for="enable_register_form">Enable Registration Form</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input toggle-setting" type="checkbox" id="enable_login_form" name="enable_login_form"
                                    value="1" {{ $settings['enable_login_form'] ?? false ? 'checked' : '' }}>
                                <label class="form-check-label" for="enable_login_form">Enable Login Form</label>
                            </div>
                            <small class="form-text text-muted mt-auto">
                                Toggle the visibility of registration and login forms. When disabled, only social login options will be shown.
                            </small>
                            
                        </form>
                    </div>
                </div>
            </div>

            @isModule('Users')
            <!-- User Registration -->
            <div class="col-lg-6 col-md-12">
                <div class="card h-100">
                    <div class="card-header">
                        <h5 class="card-title">User Registration</h5>
                    </div>
                    <div class="card-body d-flex flex-column">
                        <form action="{{ route('admin.settings.update-allow-user-registration') }}" method="POST">
                            @csrf
                            <div class="form-check form-switch">
                                <input class="form-check-input toggle-setting" type="checkbox" id="allow_user_registration" name="allow_user_registration"
                                    value="1" {{ $settings['allow_user_registration'] ?? false ? 'checked' : '' }}>
                                <label class="form-check-label" for="allow_user_registration">Allow User Registration</label>
                            </div>
                            <small class="form-text text-muted mt-auto">
                                Enable this option to allow new users to sign up on your site. Disable it to restrict user registrations.
                            </small>
                        </form>
                    </div>
                </div>
            </div>
            @endisModule
            @if (\App\Models\AdminModule::isModuleEnabled('Users') && \App\Models\AdminModule::isModuleEnabled('Email'))
            <!-- Email Confirmation -->
            <div class="col-lg-6 col-md-12">
                <div class="card h-100">
                    <div class="card-header">
                        <h5 class="card-title">Email Confirmation</h5>
                    </div>
                    <div class="card-body d-flex flex-column">
                        <form action="{{ route('admin.settings.update-require-email-confirmation') }}" method="POST">
                            @csrf
                            <div class="form-check form-switch">
                                <input class="form-check-input toggle-setting" type="checkbox" id="require_email_confirmation" name="require_email_confirmation"
                                    value="1" {{ $settings['require_email_confirmation'] ?? false ? 'checked' : '' }}>
                                <label class="form-check-label" for="require_email_confirmation">Require Email Confirmation</label>
                            </div>
                            <small class="form-text text-muted mt-auto">
                                Mandate email verification during user registration to improve account security and ensure accurate email addresses.
                            </small>
                        </form>
                    </div>
                </div>
            </div>
            @endif
            @isModule('Email')
            <!-- Admin Login Notifications -->
            <div class="col-lg-6 col-md-12">
                <div class="card h-100">
                    <div class="card-header">
                        <h5 class="card-title">Admin Login Notifications</h5>
                    </div>
                    <div class="card-body d-flex flex-column">
                        <form action="{{ route('admin.settings.update-admin-login-notifications') }}" method="POST">
                            @csrf
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input toggle-setting" type="checkbox" id="notify_admin_on_login" name="notify_admin_on_login"
                                    value="1" {{ $settings['notify_admin_on_login'] ?? false ? 'checked' : '' }}>
                                <label class="form-check-label" for="notify_admin_on_login">Notify on Successful Login</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input toggle-setting" type="checkbox" id="notify_admin_on_login_fail" name="notify_admin_on_login_fail"
                                    value="1" {{ $settings['notify_admin_on_login_fail'] ?? false ? 'checked' : '' }}>
                                <label class="form-check-label" for="notify_admin_on_login_fail">Notify on Failed Login</label>
                            </div>
                            <small class="form-text text-muted mt-auto">
                                Stay informed about administrative account activity. Receive alerts for both successful and failed login attempts.
                            </small>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Allow Email Notifications -->
            <div class="col-lg-6 col-md-12">
                <div class="card h-100">
                    <div class="card-header">
                        <h5 class="card-title">Email Notifications</h5>
                    </div>
                    <div class="card-body d-flex flex-column">
                        <form action="{{ route('admin.settings.update-allow-email-notifications') }}" method="POST">
                            @csrf
                            <div class="form-check form-switch">
                                <input class="form-check-input toggle-setting" type="checkbox" id="allow_email_notifications" name="allow_email_notifications"
                                    value="1" {{ $settings['allow_email_notifications'] ?? false ? 'checked' : '' }}>
                                <label class="form-check-label" for="allow_email_notifications">Allow Email Notifications</label>
                            </div>
                            <small class="form-text text-muted mt-auto">
                                Enable email notifications for all events. Disabling this will restrict notifications to critical events only.
                            </small>
                        </form>
                    </div>
                </div>
            </div>
            @endisModule
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toggles = document.querySelectorAll('.toggle-setting');
            toggles.forEach(toggle => {
                toggle.addEventListener('change', function () {
                    this.closest('form').submit();
                });
            });
        });
    </script>
</x-layouts.app>
