<x-layouts.app>
    @section('title', 'Manage Sections')

    <x-partials.breadcrumb
        :items="[
            ['name' => 'Home', 'url' => route('admin.dashboard')],
            ['name' => 'Settings', 'url' => route('admin.settings.index')],
            ['name' => 'Manage Sections'],
        ]"
        style="style1"
    />

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="mb-4">Manage Sections</h4>
        <p class="text-muted">Edit settings for each section as defined in your configuration.</p>

        <div class="card mt-4 shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Sections List</h5>
            </div>
            <div class="card-datatable table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Section Key</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sections as $key => $section)
                            <tr>
                                <td>{{ $key }}</td>
                                <td>{{ $section['name'] }}</td>
                                <td>{{ (isset($section['crud']) && $section['crud']) ? 'CRUD' : 'Simple' }}</td>
                                <td class="text-center">
                                    <a href="{{ route('admin.sections.edit', $key) }}" class="btn btn-secondary btn-sm">
                                        <i class="ti ti-settings me-2"></i>Settings
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @if (empty($sections))
                    <div class="text-center py-4">
                        <h5 class="text-muted">No sections found</h5>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-layouts.app>
