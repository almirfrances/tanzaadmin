<x-layouts.app>
    @section('title', 'Backup Management')

    <x-partials.breadcrumb
        :items="[
            ['name' => 'Home', 'url' => route('admin.dashboard')],
            ['name' => 'Settings', 'url' => route('admin.settings.index')],
            ['name' => 'Backup Management'],
        ]"
        style="style1"
    />

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="mb-4">Backup Management</h4>
        <p class="text-muted">Manage your application backups. Create, download, restore, or delete backups easily.</p>

        <div class="card mt-4 shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <!-- Create Backup Button -->
                <button type="button" class="btn btn-primary btn-page-block-overlay" onclick="document.getElementById('createBackupForm').submit();">
                    <i class="ti ti-plus"></i> Create Backup
                </button>

                <!-- Hidden Form for Backup Creation -->
                <form id="createBackupForm" action="{{ route('admin.backups.create') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>

            <div class="card-body table-responsive">
                @if ($files->isEmpty())
                    <div class="text-center py-4">
                        <h5 class="text-muted">No backups found</h5>
                    </div>
                @else
                    <table class="table table-hover table-striped">
                        <thead class="thead-light">
                            <tr>
                                <th>Name</th>
                                <th>Size</th>
                                <th>Last Modified</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($files as $file)
                                <tr>
                                    <td>{{ $file['name'] }}</td>
                                    <td>{{ $file['size'] }}</td>
                                    <td>{{ $file['last_modified'] }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.backups.download', $file['name']) }}" class="btn btn-sm btn-primary">
                                            <i class="ti ti-download"></i> Download
                                        </a>
                                        <form action="{{ route('admin.backups.delete', $file['name']) }}" method="POST" class="d-inline-block">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="ti ti-trash"></i> Delete
                                            </button>
                                        </form>
                                        <a href="{{ route('admin.backups.restore', $file['name']) }}" class="btn btn-sm btn-warning">
                                            <i class="ti ti-rotate"></i> Restore
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</x-layouts.app>
