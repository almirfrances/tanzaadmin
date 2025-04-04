<x-layouts.app>
    @section('title', 'Maintenance Mode')

    <x-partials.breadcrumb
        :items="[
            ['name' => 'Home', 'url' => route('admin.dashboard')],
            ['name' => 'Settings', 'url' => route('admin.settings.index')],
            ['name' => 'Maintenance Mode'],
        ]"
        style="style1"
    />

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="mb-4">Maintenance Mode</h4>
        <p class="mb-4">
            Toggle maintenance mode, customize its display, and configure an access code to bypass the mode.
        </p>

        <form action="{{ route('admin.settings.update-maintenance-mode') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row g-4">
                <!-- Image Card -->
                <div class="col-lg-6">
                    <div class="card shadow-sm h-100">
                        <div class="card-header">
                            <h5 class="card-title">Maintenance Image</h5>
                        </div>
                        <div class="card-body text-center">
                            <!-- Current Image Preview -->
                            @if(!empty($settings['image_path']))
                                <img src="{{ asset('storage/' . $settings['image_path']) }}" alt="Current Image"
                                     class="img-fluid rounded shadow-sm mb-3" style="max-width: 200px;">
                            @else
                                <p class="text-muted mb-3">No image uploaded yet.</p>
                            @endif

                            <!-- Image Upload -->
                            <input type="file" class="form-control" id="image_path" name="image_path" accept="image/*">
                            <div class="mt-3" id="selectedImagePreview" style="display: none;">
                                <p class="text-muted mb-2">Selected Image Preview:</p>
                                <img id="previewImage" src="#" alt="Selected Image" class="img-fluid rounded shadow-sm"
                                     style="max-width: 200px;">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Settings Card -->
                <div class="col-lg-6">
                    <div class="card shadow-sm h-100">
                        <div class="card-header">
                            <h5 class="card-title">Maintenance Mode Settings</h5>
                        </div>
                        <div class="card-body">
                            <!-- Enable/Disable Maintenance Mode -->
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" id="maintenance_mode" name="maintenance_mode"
                                       value="1" {{ $settings['maintenance_mode'] ?? false ? 'checked' : '' }}>
                                <label class="form-check-label" for="maintenance_mode">Enable Maintenance Mode</label>
                            </div>

                            <div class="row g-3">
                                <!-- Button URL -->
                                <div class="col-12">
                                    <label for="button_url" class="form-label">Button URL</label>
                                    <input type="text" class="form-control" id="button_url" name="button_url"
                                           value="{{ old('button_url', $settings['button_url'] ?? '') }}">
                                </div>

                                <!-- Button Text -->
                                <div class="col-md-6">
                                    <label for="button_text" class="form-label">Button Text</label>
                                    <input type="text" class="form-control" id="button_text" name="button_text"
                                           value="{{ old('button_text', $settings['button_text'] ?? 'Back to Home') }}">
                                </div>

                                <!-- Access Code -->
                                <div class="col-md-6">
                                    <label for="access_code" class="form-label">Access Code</label>
                                    <input type="text" class="form-control" id="access_code" name="access_code"
                                           value="{{ old('access_code', $settings['access_code'] ?? '') }}">
                                    <small class="text-muted">
                                        Use this code to access the site during maintenance:
                                        <code>{{ config('app.url') }}?access_code={{ $settings['access_code'] }}</code>.
                                    </small>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary btn-page-block-overlay waves-effect waves-light">
                                Save Changes
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        // Preview selected image
        document.getElementById('image_path').addEventListener('change', function () {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const preview = document.getElementById('previewImage');
                    preview.src = e.target.result;
                    document.getElementById('selectedImagePreview').style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
</x-layouts.app>
