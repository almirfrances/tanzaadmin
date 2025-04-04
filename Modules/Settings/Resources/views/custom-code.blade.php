<x-layouts.app>
    @section('title', 'Custom Code')

    <x-partials.breadcrumb
        :items="[
            ['name' => 'Home', 'url' => route('admin.dashboard')],
            ['name' => 'Settings', 'url' => route('admin.settings.index')],
            ['name' => 'Custom Code'],
        ]"
        style="style1"
    />

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="mb-4">Custom Code</h4>
        <p class="mb-4">
            Add custom CSS, JavaScript, or HTML for the header or footer of your application. Use responsibly to avoid conflicts with existing scripts or styles.
        </p>

        <form action="{{ route('admin.settings.update-custom-code') }}" method="POST">
            @csrf

            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="card h-100">
                        <div class="card-header">
                            <h5 class="card-title">Header Code</h5>
                        </div>
                        <div class="card-body">
                            <textarea class="form-control" id="header_code" name="header_code" rows="10"
                                placeholder="Add custom code for the header...">{{ old('header_code', $settings['header_code'] ?? '') }}</textarea>
                            <small class="text-muted">
                                This code will be added inside the <code>&lt;head&gt;</code> section of your site.
                            </small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card h-100">
                        <div class="card-header">
                            <h5 class="card-title">Footer Code</h5>
                        </div>
                        <div class="card-body">
                            <textarea class="form-control" id="footer_code" name="footer_code" rows="10"
                                placeholder="Add custom code for the footer...">{{ old('footer_code', $settings['footer_code'] ?? '') }}</textarea>
                            <small class="text-muted">
                                This code will be added before the closing <code>&lt;/body&gt;</code> tag of your site.
                            </small>
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
</x-layouts.app>
