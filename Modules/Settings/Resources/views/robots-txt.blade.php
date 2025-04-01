<x-layouts.app>
    @section('title', 'Robots.txt')

    <x-partials.breadcrumb
        :items="[
            ['name' => 'Home', 'url' => route('admin.dashboard')],
            ['name' => 'Settings', 'url' => route('admin.settings.index')],
            ['name' => 'Robots.txt'],
        ]"
        style="style1"
    />

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="mb-4">Robots.txt</h4>
        <p class="mb-4">
            The <code>robots.txt</code> file provides instructions to web crawlers on how to interact with your website.
            Manage it effectively to improve SEO and control access to specific areas of your site. The live file is accessible at:
            <a href="{{ url('robots.txt') }}" target="_blank" class="text-primary fw-bold">{{ url('robots.txt') }}</a>.
        </p>

        <form action="{{ route('admin.settings.update-robots-txt') }}" method="POST">
            @csrf

            <div class="card h-100">
                <div class="card-header">
                    <h5 class="card-title">Edit Robots.txt</h5>
                </div>
                <div class="card-body">
                    <textarea class="form-control" id="robots_content" name="robots_content" rows="15" required>{{ old('robots_content', $robotsContent) }}</textarea>
                    <small class="text-muted d-block mt-2">
                        <strong>Guidelines:</strong>
                        <ul>
                            <li>Use <code>User-agent</code> to target specific bots (e.g., Googlebot).</li>
                            <li>Block areas by using <code>Disallow</code> (e.g., <code>Disallow: /admin/</code>).</li>
                            <li>To allow full access, use:
                                <pre>User-agent: *
Disallow:</pre>
                            </li>
                            <li>For reference, visit the <a href="https://developers.google.com/search/docs/crawling-indexing/robots-txt" target="_blank">Google Robots.txt Guide</a>.</li>
                        </ul>
                    </small>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary btn-page-block-overlay waves-effect waves-light">
                        Save Changes
                    </button>
                </div>
            </div>
        </form>
    </div>
</x-layouts.app>
