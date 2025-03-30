<x-layouts.app>
    @section('title', 'Manage Section: ' . $section['name'])
    
    <x-partials.breadcrumb
        :items="[
            ['name' => 'Home', 'url' => route('admin.dashboard')],
            ['name' => 'Sections', 'url' => route('admin.sections.index')],
            ['name' => $section['name']],
        ]"
        style="style1"
    />

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="mb-4">Manage Section: {{ $section['name'] }}</h4>
        <p class="text-muted">Manage items for this section.</p>

        <div class="card mb-4 shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">{{ $section['name'] }} Items</h5>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createItemModal">
                    <i class="ti ti-plus me-2"></i>Add New Item
                </button>
            </div>
            <div class="card-datatable table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            @foreach($section['content'] as $fieldName => $fieldType)
                                <th>{{ ucfirst(str_replace('_', ' ', $fieldName)) }}</th>
                            @endforeach
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($items as $item)
                            <tr id="item-{{ $item->id }}">
                                @foreach($section['content'] as $fieldName => $fieldType)
                                <td>{{ data_get($item->content, $fieldName, '') }}</td>
                            @endforeach
                                <td class="text-center">
                                    <div class="dropdown">
                                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                            Actions
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editItemModal-{{ $item->id }}">
                                                    <i class="ti ti-pencil me-2"></i>Edit
                                                </button>
                                            </li>
                                            <li>
                                                <form action="{{ route('admin.sections.item.destroy', [$sectionKey, $item->id]) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="dropdown-item text-danger" type="submit">
                                                        <i class="ti ti-trash me-2"></i>Delete
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>

                            <!-- Edit Item Modal -->
                            <div class="modal fade" id="editItemModal-{{ $item->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <form action="{{ route('admin.sections.item.update', [$sectionKey, $item->id]) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Item</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row g-3">
                                                    @foreach($section['content'] as $fieldName => $fieldType)
                                                        <div class="col-12 mb-3">
                                                            @switch($fieldType)
                                                                @case('text')
                                                                    <x-form.input-text 
                                                                        id="{{ $fieldName }}_edit_{{ $item->id }}" 
                                                                        name="{{ $fieldName }}" 
                                                                        label="{{ ucfirst(str_replace('_', ' ', $fieldName)) }}" 
                                                                        :value="data_get($item->content, $fieldName, '')" required="true" />
                                                                    @break
                                                                @case('textarea')
                                                                    <x-form.textarea 
                                                                        id="{{ $fieldName }}_edit_{{ $item->id }}" 
                                                                        name="{{ $fieldName }}" 
                                                                        label="{{ ucfirst(str_replace('_', ' ', $fieldName)) }}" 
                                                                        rows="4" :value="data_get($item->content, $fieldName, '')" />
                                                                    @break
                                                                @case('image')
                                                                    <x-form.file-upload 
                                                                        id="{{ $fieldName }}_edit_{{ $item->id }}" 
                                                                        name="{{ $fieldName }}" 
                                                                        label="{{ ucfirst(str_replace('_', ' ', $fieldName)) }}" />
                                                                    @break
                                                                @default
                                                                    <x-form.input-text 
                                                                        id="{{ $fieldName }}_edit_{{ $item->id }}" 
                                                                        name="{{ $fieldName }}" 
                                                                        label="{{ ucfirst(str_replace('_', ' ', $fieldName)) }}" 
                                                                        :value="data_get($item->content, $fieldName, '')" />
                                                            @endswitch
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-primary">Save Changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <tr>
                                <td colspan="{{ count($section['content']) + 1 }}" class="text-center">No items found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Create Item Modal -->
        <div class="modal fade" id="createItemModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form action="{{ route('admin.sections.item.store', $sectionKey) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title">Add New Item to {{ $section['name'] }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row g-3">
                                @foreach($section['content'] as $fieldName => $fieldType)
                                    <div class="col-12 mb-3">
                                        @switch($fieldType)
                                            @case('text')
                                                <x-form.input-text 
                                                    id="{{ $fieldName }}_create" 
                                                    name="{{ $fieldName }}" 
                                                    label="{{ ucfirst(str_replace('_', ' ', $fieldName)) }}" 
                                                    required="true" />
                                                @break
                                            @case('textarea')
                                                <x-form.textarea 
                                                    id="{{ $fieldName }}_create" 
                                                    name="{{ $fieldName }}" 
                                                    label="{{ ucfirst(str_replace('_', ' ', $fieldName)) }}" 
                                                    rows="4" />
                                                @break
                                            @case('image')
                                                <x-form.file-upload 
                                                    id="{{ $fieldName }}_create" 
                                                    name="{{ $fieldName }}" 
                                                    label="{{ ucfirst(str_replace('_', ' ', $fieldName)) }}" />
                                                @break
                                            @default
                                                <x-form.input-text 
                                                    id="{{ $fieldName }}_create" 
                                                    name="{{ $fieldName }}" 
                                                    label="{{ ucfirst(str_replace('_', ' ', $fieldName)) }}" />
                                        @endswitch
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Add Item</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</x-layouts.app>
