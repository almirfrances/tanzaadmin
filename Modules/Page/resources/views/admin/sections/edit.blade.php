<x-layouts.app>
    @section('title', 'Edit Section: ' . $section['name'])
    
    <x-partials.breadcrumb
        :items="[
            ['name' => 'Home', 'url' => route('admin.dashboard')],
            ['name' => 'Sections', 'url' => route('admin.sections.index')],
            ['name' => $section['name']],
        ]"
        style="style1"
    />

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="mb-4">Edit Section: {{ $section['name'] }}</h4>
        <p class="text-muted">Update settings for this section.</p>
        
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <form action="{{ route('admin.sections.update', ['sectionKey' => $sectionKey]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="row g-3">
                        @foreach($section['content'] as $fieldName => $fieldType)
                            <div class="col-12 mb-3">
                                @switch($fieldType)
                                    @case('text')
                                        <x-form.input-text 
                                            id="{{ $fieldName }}" 
                                            name="{{ $fieldName }}" 
                                            label="{{ ucfirst(str_replace('_', ' ', $fieldName)) }}" 
                                            :value="old($fieldName, data_get($data, 'content.' . $fieldName, ''))" 
                                            required="true" />
                                        @break
                                    @case('textarea')
                                        <x-form.textarea 
                                            id="{{ $fieldName }}" 
                                            name="{{ $fieldName }}" 
                                            label="{{ ucfirst(str_replace('_', ' ', $fieldName)) }}" 
                                            rows="4" 
                                            :value="old($fieldName, data_get($data, 'content.' . $fieldName, ''))" />
                                        @break
                                    @case('image')
                                        <x-form.file-upload 
                                            id="{{ $fieldName }}" 
                                            name="{{ $fieldName }}" 
                                            label="{{ ucfirst(str_replace('_', ' ', $fieldName)) }}" />
                                        @break
                                    @default
                                        <x-form.input-text 
                                            id="{{ $fieldName }}" 
                                            name="{{ $fieldName }}" 
                                            label="{{ ucfirst(str_replace('_', ' ', $fieldName)) }}" 
                                            :value="old($fieldName, data_get($data, 'content.' . $fieldName, ''))" />
                                @endswitch
                            </div>
                        @endforeach
                    </div>

                    <div class="d-flex justify-content-end mt-3">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                        <button type="button" class="btn btn-secondary ms-2" onclick="window.history.back();">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>
