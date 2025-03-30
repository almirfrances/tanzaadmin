<x-layouts.app>
    @section('title', 'Global Email Template')

    <x-partials.breadcrumb :items="[
            ['name' => 'Home', 'url' => route('admin.dashboard')],
            ['name' => 'Settings', 'url' => route('admin.settings.index')],
            ['name' => 'Global Email Template'],
        ]" style="style1" />

    <div class="container-xxl flex-grow-1 container-p-y">

        <div
            class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3">
            <div class="d-flex flex-column justify-content-center">
                <h4 class="mb-1 mt-3">Global Email Template</h4>
                <p class="text-muted">Customize the global template used for all email notifications.</p>
            </div>

            <button type="button" class="btn btn-primary  waves-light" data-bs-toggle="modal"
                data-bs-target="#testEmailModal">
                <i class="ti ti-mail me-1"></i> Test Email
            </button>
        </div>

        <!-- Tabs Navigation -->
        <ul class="nav nav-tabs mb-4">
            <li class="nav-item">
                <a class="nav-link btn-page-block-overlay waves-effect waves-light {{ request()->routeIs('admin.email.settings') ? 'active' : '' }}"
                    href="{{ route('admin.email.settings') }}">
                    <i class="ti ti-settings me-1"></i> Email Settings
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link btn-page-block-overlay waves-effect waves-light {{ request()->routeIs('admin.email.global-template') ? 'active' : '' }}"
                    href="{{ route('admin.email.global-template') }}">
                    <i class="ti ti-template me-1"></i> Global Template
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link btn-page-block-overlay waves-effect waves-light {{ request()->routeIs('admin.email.notification-templates') ? 'active' : '' }}"
                    href="{{ route('admin.email.notification-templates') }}">
                    <i class="ti ti-bell me-1"></i> Notification Templates
                </a>
            </li>
        </ul>
        <!-- Shortcodes Section -->
        <div class="alert alert-info mb-4">
            <h5 class="mb-2">Available Shortcodes</h5>
            <p class="mb-0">Use these shortcodes to dynamically personalize your emails:</p>
            <div class="d-flex flex-wrap gap-2 mt-3">
                @foreach ($shortcodes as $code => $description)
                <span class="badge bg-secondary text-white">
                    <code>{{ $code }}</code>: {{ $description }}
                </span>
                @endforeach
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('admin.email.global-template.update') }}" method="POST">
                    @csrf

                    <!-- Inputs in a Row -->
                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <label for="from_name" class="form-label">Email Sent From - Name</label>
                            <input type="text" class="form-control" id="from_name" name="from_name"
                                value="{{ old('from_name', $template->from_name) }}" required>
                            <small class="text-muted">Specify the sender's name for outgoing emails.</small>
                        </div>
                        <div class="col-md-4">
                            <label for="from_email" class="form-label">Email Sent From - Email</label>
                            <input type="email" class="form-control" id="from_email" name="from_email"
                                value="{{ old('from_email', $template->from_email) }}" required>
                            <small class="text-muted">Specify the sender's email address for outgoing emails.</small>
                        </div>
                        <div class="col-md-4">
                            <label for="subject" class="form-label">Email Subject</label>
                            <input type="text" class="form-control" id="subject" name="subject"
                                value="{{ old('subject', $template->subject) }}" required>
                            <small class="text-muted">You can use shortcodes like <code>@{{site_name}}</code>.</small>
                        </div>
                    </div>

                    <!-- Email Body and Preview -->
                    <div class="row g-4">
                        <div class="col-md-12">
                            <label for="html_template" class="form-label">Email Body</label>
                            <textarea class="form-control" id="html_template" name="html_template" rows="15"
                                required>{{ old('html_template', $template->html_template) }}</textarea>
                            <small class="text-muted">
                                Use shortcodes like <code>@{{name}}</code>, <code>@{{message}}</code>,
                                <code>@{{username}}</code>, and <code>@{{site_name}}</code> to personalize the email
                                content.
                            </small>
                        </div>

                        <!-- Include TinyMCE Script -->
                        <script src="https://cdn.tiny.cloud/1/{{ $tinymceApiKey }}/tinymce/7/tinymce.min.js"
                            referrerpolicy="origin"></script>
                        <script>
                            tinymce.init({
                                selector: '#html_template',
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

                        
                    </div>

                    <!-- Form Buttons -->
                    <div class="d-flex justify-content-end mt-4">
                        <button type="submit" class="btn btn-primary btn-page-block-overlay waves-effect waves-light">
                            <i class="ti ti-check me-1"></i> Save Template
                        </button>
                        <button type="button"
                            class="btn btn-secondary ms-2 btn-page-block-overlay waves-effect waves-light"
                            onclick="window.history.back();">
                            <i class="ti ti-arrow-left me-1"></i> Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('html_template').addEventListener('input', function () {
            const previewElement = document.getElementById('email-preview');
            previewElement.innerHTML = this.value;
        });

    </script>
</x-layouts.app>
