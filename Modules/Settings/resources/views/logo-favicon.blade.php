<x-layouts.app>
    @section('title', 'Logo & Favicon Settings')

    <x-partials.breadcrumb
        :items="[
            ['name' => 'Home', 'url' => route('admin.dashboard')],
            ['name' => 'Settings', 'url' => route('admin.settings.index')],
            ['name' => 'Logo & Favicon']
        ]"
        style="style1"
    />

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3">
            <div class="d-flex flex-column justify-content-center">
                <h4 class="mb-1 mt-3">Logo and Favicon Settings</h4>
                <p class="text-muted">Update the site logos and favicon here to ensure your branding is consistent across all platforms.</p>
            </div>
        </div>

        <form action="{{ route('admin.settings.logo-favicon.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row g-4 d-flex flex-wrap">

                <!-- Logo Light -->
                <div class="col-md-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Logo Light</h5>
                        </div>
                        <div class="card-body text-center">
                            <img src="{{ asset('storage/' . $settings['logo_light']) }}" alt="Light Logo" class="img-fluid mb-3" id="preview-logo-light" style="max-height: 120px;">
                            <input type="file" class="form-control mb-3" name="logo_light" id="logo_light" onchange="previewImage(event, 'preview-logo-light')">
                            <small class="form-text text-muted">Recommended size: 243x61 px</small>
                        </div>
                    </div>
                </div>
                <style>
                    #preview-logo-light {
                        background-color: black;
                    }
                </style>

                <!-- Logo Dark -->
                <div class="col-md-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Logo Dark</h5>
                        </div>
                        <div class="card-body text-center">
                            <img src="{{ asset('storage/' . $settings['logo_dark']) }}" alt="Dark Logo" class="img-fluid mb-3" id="preview-logo-dark" style="max-height: 120px;">
                            <input type="file" class="form-control mb-3" name="logo_dark" id="logo_dark" onchange="previewImage(event, 'preview-logo-dark')">
                            <small class="form-text text-muted">Recommended size: 243x61 px</small>
                        </div>
                    </div>
                </div>

                <!-- Favicon -->
                <div class="col-md-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Favicon</h5>
                        </div>
                        <div class="card-body text-center">
                            <img src="{{ asset('storage/' . $settings['favicon']) }}" alt="Favicon" class="img-fluid mb-3" id="preview-favicon" style="max-height: 120px;">
                            <input type="file" class="form-control mb-3" name="favicon" id="favicon" onchange="previewImage(event, 'preview-favicon')">
                            <small class="form-text text-muted">Recommended size: 512x512 px</small>
                        </div>
                    </div>
                </div>

            </div>

            <div class="d-flex justify-content-center mt-4">
                <button type="submit" class="btn btn-primary waves-effect waves-light me-2">
                    <i class="ti ti-check me-1"></i> Update Settings
                </button>
                <button type="button" class="btn btn-label-secondary waves-effect" onclick="window.history.back();">
                    <i class="ti ti-arrow-left me-1"></i> Cancel
                </button>
            </div>
        </form>
    </div>

    <script>
        function previewImage(event, previewId) {
            const fileInput = event.target;
            const file = fileInput.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById(previewId).src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        }
    </script>
</x-layouts.app>
