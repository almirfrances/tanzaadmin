<x-layouts.app>
    @section('title', 'Manage Pages')

    <x-partials.breadcrumb
        :items="[
            ['name' => 'Home', 'url' => route('admin.dashboard')],
            ['name' => 'Settings', 'url' => route('admin.settings.index')],
            ['name' => 'Manage Pages'],
        ]"
        style="style1"
    />

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="mb-4">Manage Pages</h4>
        <p class="text-muted">Create or delete pages from the system.</p>

        <div class="card mt-4 shadow-sm">
            <div class="card-header">
                <div class="row align-items-center">
                    <!-- Search Form (constrained width) -->
                    <div class="col-md-8 col-sm-12 mb-sm-0 mb-2">
                        <form action="{{ route('admin.pages.index') }}" method="GET" class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Search pages..."
                                   value="{{ request()->get('search') }}">
                            <button type="submit" class="btn btn-secondary">Search</button>
                        </form>
                    </div>
                    <!-- Add Button aligned to right -->
                    <div class="col-md-4 col-sm-12 text-md-end text-sm-start">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createPageModal">
                            Add New Page
                        </button>
                    </div>
                </div>
            </div>

            <div class="card-datatable table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Closed</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pages as $page)
                            <tr id="page-{{ $page->id }}">
                                <td>{{ $page->name }}</td>
                                <td>{{ $page->slug }}</td>
                                <td>
                                    <span class="badge {{ $page->is_closed ? 'bg-success' : 'bg-secondary' }}">
                                        {{ $page->is_closed ? 'Yes' : 'No' }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="dropdown">
                                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button"
                                                id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                            Actions
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <li>
                                                <form action="{{ route('admin.pages.destroy', $page->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="dropdown-item text-danger" type="submit">
                                                        <i class="ti ti-trash me-2"></i>Delete
                                                    </button>
                                                </form>
                                            </li>

                                            <li>
                                                <!-- Manage link -->
                                                <a href="{{ route('admin.pages.manage', $page->id) }}" class="btn btn-secondary btn-sm">
                                                    <i class="ti ti-settings me-1"></i>Manage
                                                </a>
                                            </li>
                                        </ul>

                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @if ($pages->isEmpty())
                    <div class="text-center py-4">
                        <h5 class="text-muted">No pages found</h5>
                    </div>
                @endif
                <div class="d-flex justify-content-center mt-4">
                    {{ $pages->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Create Page Modal -->
    <div class="modal fade" id="createPageModal" tabindex="-1" aria-labelledby="createPageModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('admin.pages.store') }}" method="POST" id="createPageForm">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createPageModalLabel">Create New Page</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="pageName" class="form-label">Page Name</label>
                            <input type="text" name="name" id="pageName" class="form-control"
                                   placeholder="Enter page name" required>
                        </div>
                        <div class="mb-3">
                            <label for="pageSlug" class="form-label">Page Slug</label>
                            <input type="text" name="slug" id="pageSlug" class="form-control"
                                   placeholder="Enter unique slug" required>
                        </div>
                        <div class="mb-3">
                            <div class="form-check">
                                <input type="checkbox" name="is_closed" id="is_closed" value="1" class="form-check-input">
                                <label class="form-check-label" for="is_closed">Set as Closed</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                                data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Create Page</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @section('scripts')
        <!-- Include SweetAlert if not already included -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <!-- Auto-generate slug based on Page Name -->
        <script>
            document.getElementById('pageName').addEventListener('input', function(e) {
                let name = e.target.value;
                let slug = name.toLowerCase().trim()
                    .replace(/[\s\W-]+/g, '-')
                    .replace(/^-+|-+$/g, '');
                document.getElementById('pageSlug').value = slug;
            });
        </script>
    @endsection
</x-layouts.app>
