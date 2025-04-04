<x-layouts.app>
    @section('title', 'General Settings')

    <x-partials.breadcrumb
        :items="[
            ['name' => 'Home', 'url' => route('admin.dashboard')],
            ['name' => 'Settings', 'url' => route('admin.settings.index')],
            ['name' => 'General Settings'],
        ]"
        style="style1"
    />

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3">
            <div class="d-flex flex-column justify-content-center">
                <h4 class="mb-1 mt-3">General Settings</h4>
                <p class="text-muted">Manage your general settings efficiently</p>
            </div>
        </div>

        <form action="{{ route('admin.settings.update-general') }}" method="POST">
            @csrf
            <div class="row g-4">
                <!-- Site Information -->
                <div class="col-12 col-lg-6">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Site Information</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label" for="site_name">Site Name</label>
                                <input type="text" class="form-control" id="site_name" name="site_name"
                                    value="{{ old('site_name', $settings['site_name'] ?? '') }}" required>
                                <small class="form-text text-muted">Enter the name of your site.</small>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="site_email">Site Email</label>
                                <input type="email" class="form-control" id="site_email" name="site_email"
                                    value="{{ old('site_email', $settings['site_email'] ?? '') }}" required>
                                <small class="form-text text-muted">Enter the email address for your site.</small>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="site_phone">Site Phone</label>
                                <input type="text" class="form-control" id="site_phone" name="site_phone"
                                    value="{{ old('site_phone', $settings['site_phone'] ?? '') }}">
                                <small class="form-text text-muted">Enter the phone number for your site.</small>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="tinymce_api">Tinyme API</label>
                                <input type="text" class="form-control" id="tinymce_api" name="tinymce_api"
                                    value="{{ old('tinymce_api', $settings['tinymce_api'] ?? '') }}">
                                <small class="form-text text-muted">Enter Tinyme API .</small>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="timezone">Timezone</label>
                                <select class="form-select" id="timezone" name="timezone" required>
                                    @foreach (timezone_identifiers_list() as $timezone)
                                        <option value="{{ $timezone }}" {{ old('timezone', $settings['timezone'] ?? '') === $timezone ? 'selected' : '' }}>
                                            {{ $timezone }}
                                        </option>
                                    @endforeach
                                </select>
                                <small class="form-text text-muted">Select the timezone for your application.</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Social Media Links -->
<div class="col-12 col-lg-6">
    <div class="card mb-4 shadow-sm">
        <div class="card-header">
            <h5 class="card-title mb-0">Social Media Links</h5>
        </div>
        <div class="card-body">
            <div class="row g-3">
                @foreach ([
                    'facebook' => 'Facebook',
                    'twitter' => 'Twitter',
                    'instagram' => 'Instagram',
                    'youtube' => 'YouTube',
                    'telegram' => 'Telegram',
                    'pinterest' => 'Pinterest',
                    'linkedin' => 'LinkedIn',
                    'github' => 'GitHub',

                ] as $key => $label)
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="{{ $key }}_url">{{ $label }} URL</label>
                        <input type="url" class="form-control" id="{{ $key }}_url" name="{{ $key }}_url"
                            value="{{ old("{$key}_url", $settings["{$key}_url"] ?? '') }}">
                        <small class="form-text text-muted">Enter the {{ $label }} URL for your site.</small>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary btn-page-block-overlay waves-effect waves-light me-2">
                    <i class="ti ti-check me-1"></i> Save Changes
                </button>
                <button type="button" class="btn btn-label-secondary btn-page-block-overlay waves-effect" onclick="window.history.back();">
                    <i class="ti ti-arrow-left me-1"></i> Cancel
                </button>
            </div>
        </form>
    </div>
</x-layouts.app>
