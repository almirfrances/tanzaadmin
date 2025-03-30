<x-layouts.app>
    @section('title', 'Modules Management')

    <!-- Index View -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4>Modules Management</h4>
        <p class="text-muted mb-4">Streamline your application modules with advanced tools. Activate, deactivate,
            delete, or upload modules in just a few clicks.</p>




        <div class="mb-4">
            <div class="card p-3 shadow-sm border-0">
                <div class="row align-items-center justify-content-between g-3">
                    <!-- Search and Upload Section -->
                    <div class="col-md-8 col-sm-12">
                        <form class="d-flex align-items-center" method="GET"
                            action="{{ route('admin.modules.index') }}">
                            <input class="form-control me-2" type="search" name="search" placeholder="Search modules..."
                                value="{{ request('search') }}" style="min-width: 200px;">
                            <button class="btn btn-primary btn-page-block-overlay waves-effect waves-light px-4 d-flex align-items-center" type="submit">
                                <i class="ti ti-search me-1"></i> Search
                            </button>
                        </form>

                    </div>
                    <div class="col-md-4 col-sm-12 text-md-end text-start">
                        <button class="btn btn-primary px-4" data-bs-toggle="modal" data-bs-target="#uploadModuleModal">
                            <i class="ti ti-upload"></i> Upload Module
                        </button>
                    </div>
                </div>

                <hr class="my-3">

                <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                    <!-- Bulk Actions Form -->
                    <form id="bulkActionForm" method="POST" action=""
                        class="d-flex flex-column flex-md-row align-items-center justify-content-between w-100">
                        @csrf
                        <input type="hidden" name="_method" value="">
                        <input type="hidden" name="remove_tables" value="0">
                        <div id="bulkSelectedModules"></div>

                        <!-- Select All Checkbox -->
                        <div class="mb-2 mb-md-0 d-flex align-items-center">
                            <input type="checkbox" id="selectAllModules" class="form-check-input me-2">
                            <label for="selectAllModules" class="form-check-label fw-semibold mb-0">Select All</label>
                        </div>

                        <!-- Spacer for proper alignment -->
                        <div class="d-none d-md-block flex-grow-1"></div>

                        <!-- Bulk Action Buttons -->
                        <div class="d-flex flex-wrap gap-2">
                            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                data-bs-target="#bulkActivateModal">
                                <i class="ti ti-plug-connected"></i> Activate
                            </button>
                            <button type="button" class="btn btn-warning btn-sm text-white" data-bs-toggle="modal"
                                data-bs-target="#bulkDeactivateModal">
                                <i class="ti ti-power"></i> Deactivate
                            </button>
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                data-bs-target="#bulkDeleteModal">
                                <i class="ti ti-trash"></i> Delete
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>




        <div class="row g-4">
            @forelse ($modules as $module)
            <div class="col-xl-4 col-lg-6 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <!-- Header Section -->
                        <div class="d-flex align-items-center mb-3">
                            <!-- Module Icon and Name -->
                            <a href="javascript:;" class="d-flex align-items-center">
                                <div class="avatar me-2">
                                    <i class="ti ti-plug-connected text-primary" style="font-size: 2rem;"></i>
                                </div>
                                <div class="me-2 text-body h5 mb-0">{{ $module->name }}</div>
                            </a>

                            <!-- Select Checkbox -->
                            <div class="form-check ms-auto">
                                <input class="form-check-input moduleCheckbox" type="checkbox"
                                    value="{{ $module->name }}" id="select-{{ $module->name }}">
                                <label class="form-check-label visually-hidden"
                                    for="select-{{ $module->name }}">Select</label>
                            </div>
                        </div>

                        <!-- Description -->
                        <p class="mb-3">
                            {{ $module->description ? Str::limit($module->description, 100) : 'No description available.' }}
                        </p>

                        <!-- Author and Version -->
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="text-muted small">
                                <strong>Version:</strong> {{ $module->version }}
                            </span>
                            @if ($module->author)
                            <span class="text-muted small">
                                <strong>Author:</strong>
                                @if ($module->author_url)
                                <a href="{{ $module->author_url }}" target="_blank"
                                    class="text-primary">{{ $module->author }}</a>
                                @else
                                {{ $module->author }}
                                @endif
                            </span>
                            @endif
                        </div>

                        <!-- Status Badge -->
                        <div class="d-flex align-items-center pt-1">
                            <div class="badge {{ $module->status ? 'bg-success' : 'bg-secondary' }}">
                                {{ $module->status ? 'Active' : 'Inactive' }}
                            </div>

                            <div class="ms-auto">
                                <!-- Action Buttons -->
                                <div class="d-flex align-items-center gap-2">
                                    @if (!$module->status)
                                    <!-- Activate Button -->
                                    <form action="{{ route('admin.modules.activate', $module->name) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <button class="btn btn-sm btn-success btn-page-block-overlay waves-effect waves-light" title="Activate">
                                            <i class="ti ti-plug-connected"></i>
                                        </button>
                                    </form>
                                    @else
                                    <!-- Deactivate Button -->
                                    <button class="btn btn-sm btn-warning" data-module="{{ $module->name }}" data-bs-toggle="modal"
                                        data-bs-target="#deactivateModal">
                                        <i class="ti ti-power"></i>
                                    </button>
                                    @endif

                                    <!-- Delete Button -->
                                    <button class="btn btn-sm btn-danger" data-module="{{ $module->name }}" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal" {{ $module->status ? 'disabled' : '' }}>
                                        <i class="ti ti-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center">
                <p class="text-muted">No modules found.</p>
            </div>
            @endforelse
        </div>



        <div class="d-flex justify-content-center mt-4">
            {{ $modules->links('vendor.pagination.bootstrap-4') }}
        </div>

        <!-- Modals -->
        @include('modules.modals.upload')
        @include('modules.modals.deactivate')
        @include('modules.modals.delete')
        @include('modules.modals.bulk-actions')
    </div>
</x-layouts.app>
