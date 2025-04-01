<x-layouts.app>
    @section('title', 'Social Logins Settings')

    <x-partials.breadcrumb
        :items="[
            ['name' => 'Home', 'url' => route('admin.dashboard')],
            ['name' => 'Settings', 'url' => route('admin.settings.index')],
            ['name' => 'Social Logins'],
        ]"
        style="style1"
    />

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3">
            <div class="d-flex flex-column justify-content-center">
                <h4 class="mb-1 mt-3">Social Logins Settings</h4>
                <p class="text-muted">Manage your social login integrations for providers like Google, Facebook, Twitter, and GitHub.</p>
            </div>
        </div>

        <form action="{{ route('admin.settings.social-logins.update') }}" method="POST">
            @csrf
            <div class="row g-4">
                @foreach ($socialLogins as $login)
                    <div class="col-12 col-lg-6">
                        <div class="card mb-4 shadow-sm">
                            <div class="card-header">
                                <h5 class="card-title mb-0">{{ ucfirst($login->provider) }}</h5>
                            </div>
                            <div class="card-body">
                                <input type="hidden" name="id[]" value="{{ $login->id }}">
                                <div class="mb-3">
                                    <label class="form-label" for="client_id_{{ $login->id }}">Client ID</label>
                                    <input type="text" class="form-control" id="client_id_{{ $login->id }}" name="client_id[]" value="{{ $login->client_id }}" required>
                                    <small class="form-text text-muted">Enter the Client ID for {{ ucfirst($login->provider) }}.</small>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="client_secret_{{ $login->id }}">Client Secret</label>
                                    <input type="text" class="form-control" id="client_secret_{{ $login->id }}" name="client_secret[]" value="{{ $login->client_secret }}" required>
                                    <small class="form-text text-muted">Enter the Client Secret for {{ ucfirst($login->provider) }}.</small>
                                </div>
                            
                                <div class="mb-3">
                                    <label class="form-label" for="redirect_url_{{ $login->id }}">Redirect URL</label>
                                    <input type="url" class="form-control" id="redirect_url_{{ $login->id }}" value="{{ url('/social-login/' . $login->provider . '/callback') }}" disabled>
                                    <small class="form-text text-muted">Redirect URL for {{ ucfirst($login->provider) }}.</small>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="status_{{ $login->id }}">Status</label>
                                    <select class="form-select" id="status_{{ $login->id }}" name="status[]">
                                        <option value="1" {{ $login->status ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ !$login->status ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                    <small class="form-text text-muted">Set the status for {{ ucfirst($login->provider) }} login.</small>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
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
