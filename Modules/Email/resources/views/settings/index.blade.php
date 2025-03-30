<x-layouts.app>
    @section('title', 'Email Settings')

    <x-partials.breadcrumb
        :items="[
            ['name' => 'Home', 'url' => route('admin.dashboard')],
            ['name' => 'Settings', 'url' => route('admin.settings.index')],
            ['name' => 'Email Settings'],
        ]"
        style="style1"
    />

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3">
            <div class="d-flex flex-column justify-content-center">
                <h4 class="mb-1 mt-3">Email Notification Settings</h4>
                <p class="text-muted">Configure your email provider and test your email settings easily.</p>
            </div>

            <button type="button" class="btn btn-primary  waves-light" data-bs-toggle="modal" data-bs-target="#testEmailModal">
                <i class="ti ti-mail me-1"></i> Test Email
            </button>
        </div>

        <!-- Tabs Navigation -->
        <ul class="nav nav-tabs mb-4">
            <li class="nav-item">
                <a class="nav-link btn-page-block-overlay waves-effect waves-light {{ request()->routeIs('admin.email.settings') ? 'active' : '' }}" href="{{ route('admin.email.settings') }}">
                    <i class="ti ti-settings me-1"></i> Email Settings
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link btn-page-block-overlay waves-effect waves-light {{ request()->routeIs('admin.email.global-template') ? 'active' : '' }}" href="{{ route('admin.email.global-template') }}">
                    <i class="ti ti-template me-1"></i> Global Template
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link btn-page-block-overlay waves-effect waves-light {{ request()->routeIs('admin.email.notification-templates') ? 'active' : '' }}" href="{{ route('admin.email.notification-templates') }}">
                    <i class="ti ti-bell me-1"></i> Notification Templates
                </a>
            </li>
        </ul>

        <!-- Email Settings Form -->
        <form action="{{ route('admin.email.settings.update') }}" method="POST">
            @csrf
            <div class="card shadow-sm">
                <div class="card-body">
                    <!-- Email Provider Selection -->
                    <div class="mb-4">
                        <label class="form-label" for="provider">Email Send Method</label>
                        <select class="form-select" id="provider" name="provider" onchange="showProviderFields()" required>
                            <option value="">-- Select Provider --</option>
                            <option value="php_mailer" {{ old('provider', $settings->provider ?? '') === 'php_mailer' ? 'selected' : '' }}>PHP Mailer</option>
                            <option value="smtp" {{ old('provider', $settings->provider ?? '') === 'smtp' ? 'selected' : '' }}>SMTP</option>
                            <option value="sendgrid" {{ old('provider', $settings->provider ?? '') === 'sendgrid' ? 'selected' : '' }}>SendGrid</option>
                            <option value="mailjet" {{ old('provider', $settings->provider ?? '') === 'mailjet' ? 'selected' : '' }}>Mailjet</option>
                        </select>
                        <small class="form-text text-muted">Select the email provider for sending emails.</small>
                    </div>

                    <!-- PHP Mailer Fields -->
                    <div id="php-mailer-fields" class="provider-fields d-none">
                        <div class="mb-3">
                            <label class="form-label" for="php_mailer_email">Sender Email</label>
                            <input type="email" class="form-control" id="php_mailer_email" name="php_mailer_email"
                                value="{{ old('php_mailer_email', $settings->settings['email'] ?? '') }}">
                            <small class="form-text text-muted">Enter the sender email address for PHP Mailer.</small>
                        </div>
                    </div>

                    <!-- SMTP Fields -->
                    <div id="smtp-fields" class="provider-fields d-none">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label" for="smtp_host">Host</label>
                                <input type="text" class="form-control" id="smtp_host" name="smtp_host"
                                    value="{{ old('smtp_host', $settings->settings['host'] ?? '') }}" placeholder="e.g. smtp.googlemail.com">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="smtp_port">Port</label>
                                <input type="number" class="form-control" id="smtp_port" name="smtp_port"
                                    value="{{ old('smtp_port', $settings->settings['port'] ?? '') }}" placeholder="Available port">
                            </div>
                        </div>
                        <div class="row g-3 mt-3">
                            <div class="col-md-6">
                                <label class="form-label" for="smtp_encryption">Encryption</label>
                                <select class="form-select" id="smtp_encryption" name="smtp_encryption">
                                    <option value="tls" {{ old('smtp_encryption', $settings->settings['encryption'] ?? '') === 'tls' ? 'selected' : '' }}>TLS</option>
                                    <option value="ssl" {{ old('smtp_encryption', $settings->settings['encryption'] ?? '') === 'ssl' ? 'selected' : '' }}>SSL</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="smtp_email">Sender Email</label>
                                <input type="email" class="form-control" id="smtp_email" name="smtp_email"
                                    value="{{ old('smtp_email', $settings->settings['email'] ?? '') }}">
                            </div>
                        </div>
                        <div class="row g-3 mt-3">
                            <div class="col-md-6">
                                <label class="form-label" for="smtp_username">Username</label>
                                <input type="text" class="form-control" id="smtp_username" name="smtp_username"
                                    value="{{ old('smtp_username', $settings->settings['username'] ?? '') }}" placeholder="Normally your email address">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="smtp_password">Password</label>
                                <input type="password" class="form-control" id="smtp_password" name="smtp_password"
                                    value="{{ old('smtp_password', $settings->settings['password'] ?? '') }}" placeholder="Your email password">
                            </div>
                        </div>
                    </div>

                    <!-- SendGrid Fields -->
                    <div id="sendgrid-fields" class="provider-fields d-none">
                        <div class="mb-3">
                            <label class="form-label" for="sendgrid_app_key">App Key</label>
                            <input type="text" class="form-control" id="sendgrid_app_key" name="sendgrid_app_key"
                                value="{{ old('sendgrid_app_key', $settings->settings['app_key'] ?? '') }}">
                            <small class="form-text text-muted">Enter your SendGrid App Key.</small>
                        </div>
                    </div>

                    <!-- Mailjet Fields -->
                    <div id="mailjet-fields" class="provider-fields d-none">
                        <div class="mb-3">
                            <label class="form-label" for="mailjet_api_public_key">API Public Key</label>
                            <input type="text" class="form-control" id="mailjet_api_public_key" name="mailjet_api_public_key"
                                value="{{ old('mailjet_api_public_key', $settings->settings['api_public_key'] ?? '') }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="mailjet_api_secret_key">API Secret Key</label>
                            <input type="text" class="form-control" id="mailjet_api_secret_key" name="mailjet_api_secret_key"
                                value="{{ old('mailjet_api_secret_key', $settings->settings['api_secret_key'] ?? '') }}">
                        </div>
                    </div>

                </div>
            </div>

            <div class="d-flex justify-content-end mt-4">
                <button type="submit" class="btn btn-primary btn-page-block-overlay waves-effect waves-light">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
        <!-- Test Email Modal -->
        <div class="modal fade" id="testEmailModal" tabindex="-1" aria-labelledby="testEmailModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('admin.email.test') }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="testEmailModalLabel">Send Test Email</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="test_email" class="form-label">Email Address</label>
                                <input type="email" name="test_email" id="test_email" class="form-control" placeholder="Enter email address" required>
                                <small class="form-text text-muted">This email will be used to send a test email.</small>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-label-secondary btn-page-block-overlay waves-effect waves-light" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary btn-page-block-overlay waves-effect waves-light">Send Test Email</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Ensure any existing modals are reset when dismissed
            const modal = document.getElementById('testEmailModal');
            modal.addEventListener('hidden.bs.modal', () => {
                modal.querySelector('form').reset();
            });
        });
    </script>
    <script>
        function showProviderFields() {
            const selectedProvider = document.getElementById('provider').value;
            document.querySelectorAll('.provider-fields').forEach(el => el.classList.add('d-none'));
            if (selectedProvider) {
                document.getElementById(`${selectedProvider}-fields`).classList.remove('d-none');
            }
        }

        function testEmail() {
            alert('This will trigger a test email. Implement functionality in the backend.');
        }

        // Run on page load to show fields for pre-selected provider
        document.addEventListener('DOMContentLoaded', showProviderFields);
    </script>
</x-layouts.app>
