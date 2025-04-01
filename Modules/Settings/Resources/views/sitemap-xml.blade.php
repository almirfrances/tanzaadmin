<x-layouts.app>
    @section('title', 'Sitemap XML')

    <x-partials.breadcrumb
        :items="[
            ['name' => 'Home', 'url' => route('admin.dashboard')],
            ['name' => 'Settings', 'url' => route('admin.settings.index')],
            ['name' => 'Sitemap XML'],
        ]"
        style="style1"
    />

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="mb-4">Sitemap XML</h4>
        <p class="mb-4">
            The <code>sitemap.xml</code> file helps search engines index your site more efficiently. Use this tool to edit and update your sitemap directly.
            After making changes, your updated sitemap will be available at:
            <a href="{{ url('sitemap.xml') }}" target="_blank" class="text-primary fw-bold">{{ url('sitemap.xml') }}</a>.
        </p>

        <form action="{{ route('admin.settings.update-sitemap-xml') }}" method="POST">
            @csrf

            <div class="card h-100">
                <div class="card-header">
                    <h5 class="card-title">Edit Sitemap XML</h5>
                </div>
                <div class="card-body">
                    <textarea class="form-control" id="sitemap_content" name="sitemap_content" rows="20" required>{{ old('sitemap_content', $sitemapContent) }}</textarea>
                    <small class="text-muted d-block mt-2">
                        <strong>Tips:</strong>
                        <ul>
                            <li>Ensure the XML structure is valid to avoid errors during crawling.</li>
                            <li>Use the <code>&lt;url&gt;</code> tag to define each page. Example:
                                <pre>&lt;url&gt;
    &lt;loc&gt;https://example.com/page&lt;/loc&gt;
    &lt;lastmod&gt;2023-12-31&lt;/lastmod&gt;
    &lt;changefreq&gt;weekly&lt;/changefreq&gt;
    &lt;priority&gt;0.8&lt;/priority&gt;
&lt;/url&gt;</pre>
                            </li>
                            <li>Refer to the <a href="https://www.sitemaps.org/protocol.html" target="_blank">Sitemaps Protocol</a> for more details.</li>
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
