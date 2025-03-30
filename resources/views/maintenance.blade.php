<x-layouts.main>
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-misc.css') }}">
    <div class="container-xxl container-p-y">
        <div class="misc-wrapper">
            <h2 class="mb-1 mx-2">Under Maintenance!</h2>
            <p class="mb-4 mx-2">Sorry for the inconvenience, but we're performing some maintenance at the moment.</p>
            <a href="{{ $button_url ?? url('/') }}" class="btn btn-primary mb-4 waves-effect waves-light">{{ $button_text ?? 'Back to Home' }}</a>
            <div class="mt-4">
                <img src="{{ asset('storage/' . $settings['image_path']) }}"
                     alt="Under Maintenance" width="550" class="img-fluid">
            </div>
        </div>
    </div>
</x-layouts.main>

