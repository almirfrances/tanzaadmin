<x-layouts.app>
    @section('title', 'Manage Sections for ' . $page->name)

    <x-partials.breadcrumb
        :items="[
            ['name' => 'Home', 'url' => route('admin.dashboard')],
            ['name' => 'Pages', 'url' => route('admin.pages.index')],
            ['name' => $page->name],
            ['name' => 'Manage Sections']
        ]"
        style="style1"
    />

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="mb-4">Manage Sections for {{ $page->name }}</h4>
        <p class="text-muted">Drag and drop sections from the available list into your page. Then click "Update Now" to save changes.</p>
        
        <div class="row">
            <!-- Left Column: Assigned Sections -->
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h5 class="card-title">{{ $page->name }} Sections</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.pages.sections.updateOrder', $page->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <ol id="page_sections" class="list-group">
                                @if($page->sections->count())
                                    @foreach($page->sections as $assigned)
                                        <li class="list-group-item" data-key="{{ $assigned->section_key }}" data-id="{{ $assigned->id }}">
                                            <!-- Drag handle icon -->
                                            <i class="fas fa-bars drag-handle me-2" style="cursor: move;"></i>
                                            <span>
                                                {{ config('sections.' . $assigned->section_key . '.name') ?? ucfirst($assigned->section_key) }}
                                            </span>
                                            <input type="hidden" name="sections[]" value="{{ $assigned->section_key }}">
                                        </li>
                                    @endforeach
                                @else
                                    <li class="list-group-item empty-state">
                                        <span>Drag & drop your section here</span>
                                    </li>
                                @endif
                            </ol>
                            <button type="submit" class="btn btn-primary mt-3 w-100">Update Now</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Right Column: Available Sections -->
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h5 class="card-title">Available Sections</h5>
                    </div>
                    <div class="card-body">
                        @php
                            // Load the blueprint definitions from config (ensure config/sections.php exists)
                            $blueprint = config('sections', []);
                            // Gather keys of sections already assigned to the page
                            $assignedKeys = $page->sections->pluck('section_key')->toArray();
                        @endphp
                        <ol id="available_sections" class="list-group">
                            @foreach($blueprint as $key => $def)
                                @if(empty($def['no_selection']) && !in_array($key, $assignedKeys))
                                    <li class="list-group-item" data-key="{{ $key }}">
                                        <div class="d-flex align-items-center">
                                            <!-- Drag handle icon -->
                                            <i class="fas fa-bars drag-handle me-2" style="cursor: move;"></i>
                                            <span>{{ $def['name'] ?? ucfirst($key) }}</span>
                                            @if(!empty($def['builder']))
                                                <a class="btn btn-link btn-sm ms-auto" href="{{ route('admin.sections.edit', $key) }}" target="_blank">
                                                    <i class="la la-cog"></i>
                                                </a>
                                            @endif
                                        </div>
                                    </li>
                                @endif
                            @endforeach
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include SortableJS from CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
    <script>
        // Initialize Sortable for the assigned sections list with an onAdd callback
        var pageSections = document.getElementById('page_sections');
        Sortable.create(pageSections, {
            group: 'sections',
            animation: 150,
            handle: '.drag-handle',
            onAdd: function(evt) {
                var item = evt.item;
                // If the dropped item doesn't have a hidden input, create one.
                if (!item.querySelector('input[name="sections[]"]')) {
                    var sectionKey = item.getAttribute('data-key');
                    var input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'sections[]';
                    input.value = sectionKey;
                    item.appendChild(input);
                }
            }
        });

        // Initialize Sortable for the available sections list
        var availableSections = document.getElementById('available_sections');
        Sortable.create(availableSections, {
            group: 'sections',
            animation: 150,
            handle: '.drag-handle'
        });
    </script>
</x-layouts.app>
