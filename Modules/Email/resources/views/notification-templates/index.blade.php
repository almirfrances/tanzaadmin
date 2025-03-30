<x-layouts.app>
    @section('title', 'Notification Templates')

    <x-partials.breadcrumb
        :items="[
            ['name' => 'Home', 'url' => route('admin.dashboard')],
            ['name' => 'Settings', 'url' => route('admin.settings.index')],
            ['name' => 'Notification Templates'],
        ]"
        style="style1"
    />

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3">
            <div class="d-flex flex-column justify-content-center">
                <h4 class="mb-1 mt-3">Notification Templates</h4>
                <p class="text-muted">Manage your notification templates efficiently.</p>
            </div>
            <a href="{{ route('admin.email.notification-templates.manage') }}" class="btn btn-primary btn-page-block-overlay waves-effect waves-light">
                <i class="ti ti-plus me-1"></i> Add New Template
            </a>
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

        <!-- Table Card -->
        <div class="card shadow-sm">
            <div class="card-body">
                <table class="table table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>Name</th>
                            <th>Subject</th>
                            <th>Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($templates as $template)
                            <tr>
                                <td>
                                    <span class="text-primary font-weight-bold">{{ $template->name }}</span>
                                </td>
                                <td>{{ $template->subject }}</td>
                                <td>
                                    <span class="badge bg-{{ $template->status ? 'success' : 'secondary' }}">
                                        {{ $template->status ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="dropdown">
                                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton-{{ $template->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                            Actions
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton-{{ $template->id }}">
                                            <li>
                                                <a href="{{ route('admin.email.notification-templates.manage', $template->id) }}" class="dropdown-item">
                                                    <i class="ti ti-pencil me-2"></i> Edit
                                                </a>
                                            </li>
                                            <li>
                                                <form action="{{ route('admin.email.notification-templates.delete', $template->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Are you sure?')">
                                                        <i class="ti ti-trash me-2"></i> Delete
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4">
                                    <h5 class="text-muted">No templates available</h5>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4" class="text-center">
                                <small class="text-muted">Total Templates: {{ $templates->count() }}</small>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $templates->links('vendor.pagination.simple-bootstrap-4') }}
        </div>
    </div>
</x-layouts.app>
