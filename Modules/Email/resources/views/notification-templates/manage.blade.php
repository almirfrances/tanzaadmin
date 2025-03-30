<x-layouts.app>
    @section('title', $template ? 'Edit Notification Template' : 'Add Notification Template')

    <x-partials.breadcrumb
        :items="[
            ['name' => 'Home', 'url' => route('admin.dashboard')],
            ['name' => 'Settings', 'url' => route('admin.settings.index')],
            ['name' => 'Notification Templates', 'url' => route('admin.email.notification-templates')],
            ['name' => $template ? 'Edit Template' : 'Add Template'],
        ]"
        style="style1"
    />

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="mb-4">{{ $template ? 'Edit Notification Template' : 'Create Notification Template' }}</h4>
        <div class="card shadow-sm">
            <div class="card-body">
                <form
                action="{{ $template ? route('admin.email.notification-templates.save', $template->id) : route('admin.email.notification-templates.store') }}"
                method="{{ $template ? 'POST' : 'POST' }}">
                @csrf
                @if($template)
                    @method('PUT')
                @endif

                    <!-- Template Name -->
                    @if (!$template)
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="name" class="form-label">Template Name</label>
                                <input type="text" id="name" name="name" class="form-control"
                                    value="{{ old('name', $template->name ?? '') }}" required>
                                <small class="form-text text-muted">Enter a unique name for this template.</small>
                            </div>
                        </div>
                    @endif

                    <!-- Status -->
                    <div class="row mb-3">
                         <!-- Subject -->
                        <div class="col-md-6">
                            <label for="subject" class="form-label">Subject</label>
                            <input type="text" id="subject" name="subject" class="form-control"
                                value="{{ old('subject', $template->subject ?? '') }}" required>
                            <small class="form-text text-muted">You can use shortcodes like <code>@{{site_name}}</code>.</small>
                        </div>
                        <div class="col-md-6">
                            <label for="status" class="form-label">Status</label>
                            <select id="status" name="status" class="form-select" required>
                                <option value="1" {{ old('status', $template->status ?? '') == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('status', $template->status ?? '') == 0 ? 'selected' : '' }}>Inactive</option>
                            </select>
                            <small class="form-text text-muted">Set the template's current status.</small>
                        </div>
                    </div>



                    <!-- Message Body -->
                    <div class="mb-3">
                        <label for="body" class="form-label">Message Body</label>
                        <textarea id="body" name="body" rows="10" class="form-control" required>{{ old('body', $template->body ?? '') }}</textarea>
                        <small class="form-text text-muted">
                            Use shortcodes like <code>@{{name}}</code>, <code>@{{username}}</code>, and more to personalize content.
                        </small>
                    </div>

                                            <!-- Include TinyMCE Script -->
                                            <script src="https://cdn.tiny.cloud/1/{{ $tinymceApiKey }}/tinymce/7/tinymce.min.js"
                                            referrerpolicy="origin"></script>
                                        <script>
                                            tinymce.init({
                                                selector: '#body',
                                                plugins: [
                                                    // Core editing features
                                                    'anchor', 'autolink', 'charmap', 'codesample', 'emoticons', 'image',
                                                    'link', 'lists', 'media', 'searchreplace', 'table', 'visualblocks',
                                                    'wordcount',
                                                    // Your account includes a free trial of TinyMCE premium features
                                                    // Try the most popular premium features until Jan 21, 2025:
                                                    'checklist', 'mediaembed', 'casechange', 'export', 'formatpainter',
                                                    'pageembed', 'a11ychecker', 'tinymcespellchecker', 'permanentpen',
                                                    'powerpaste', 'advtable', 'advcode', 'editimage', 'advtemplate', 'ai',
                                                    'mentions', 'tinycomments', 'tableofcontents', 'footnotes', 'mergetags',
                                                    'autocorrect', 'typography', 'inlinecss', 'markdown', 'importword',
                                                    'exportword', 'exportpdf'
                                                ],
                                                toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
                                                tinycomments_mode: 'embedded',
                                                tinycomments_author: 'Author name',
                                                mergetags_list: [{
                                                        value: 'First.Name',
                                                        title: 'First Name'
                                                    },
                                                    {
                                                        value: 'Email',
                                                        title: 'Email'
                                                    },
                                                ],
                                                ai_request: (request, respondWith) => respondWith.string(() => Promise.reject(
                                                    'See docs to implement AI Assistant')),
                                            });
                
                                        </script>
                    <!-- Buttons -->
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary btn-page-block-overlay waves-effect waves-light">
                            <i class="ti ti-check me-1"></i> {{ $template ? 'Update Template' : 'Create Template' }}
                        </button>
                        <a href="{{ route('admin.email.notification-templates') }}" class="btn btn-secondary ms-2 btn-page-block-overlay waves-effect waves-light">
                            <i class="ti ti-arrow-left me-1"></i> Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>
