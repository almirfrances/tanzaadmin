<x-layouts.app>
    @section('title', isset($post) ? 'Edit Post' : 'Create Post')

    <x-partials.breadcrumb
        :items="[
            ['name' => 'Home', 'url' => route('admin.dashboard')],
            ['name' => 'Blog', 'url' => route('admin.blog.index')],
            ['name' => isset($post) ? 'Edit Post' : 'Create Post'],
        ]"
        style="style1"
    />

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="mb-4">{{ isset($post) ? 'Edit Post' : 'Create Post' }}</h4>
        <form action="{{ isset($post) ? route('admin.blog.update', $post->id) : route('admin.blog.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($post))
                @method('PUT')
            @endif

            <div class="row g-4">
                <div class="col-md-8">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $post->title ?? '') }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="slug" class="form-label">Slug</label>
                                <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug', $post->slug ?? '') }}">
                                <small class="text-muted">Leave blank to auto-generate from title.</small>
                            </div>
                            <div class="mb-3">
                                <label for="content" class="form-label">Content</label>
                                <textarea class="form-control" id="content" name="content" rows="15" required>{{ old('content', $post->content ?? '') }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="meta_description" class="form-label">Meta Description</label>
                                <input type="text" class="form-control" id="meta_description" name="meta_description" value="{{ old('meta_description', $post->meta_description ?? '') }}">
                            </div>
                            <div class="mb-3">
                                <label for="featured_image" class="form-label">Featured Image</label>
                                <input type="file" class="form-control" id="featured_image" name="featured_image">
                                @if(isset($post) && $post->featured_image)
                                    <img src="{{ asset('storage/' . $post->featured_image) }}" alt="Featured Image" class="img-fluid mt-2" style="max-width: 100px; max-height: 100px;">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select" id="status" name="status">
                                    <option value="published" {{ (old('status', $post->status ?? '') == 'published') ? 'selected' : '' }}>Published</option>
                                    <option value="draft" {{ (old('status', $post->status ?? '') == 'draft') ? 'selected' : '' }}>Draft</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="post_category_id" class="form-label">Category</label>
                                <select class="form-select" id="post_category_id" name="post_category_id">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ (old('post_category_id', $post->post_category_id ?? '') == $category->id) ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="tags" class="form-label">Tags</label>
                                <input type="text" class="form-control" id="tags" name="tags" value="{{ old('tags', isset($post) ? $post->tags->pluck('name')->join(', ') : '') }}">
                                <small class="text-muted">Separate tags with commas.</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <button type="button" class="btn btn-secondary ms-2" onclick="window.history.back();">Cancel</button>
            </div>
        </form>
    </div>


    <!-- Include TinyMCE Script -->
    <script src="https://cdn.tiny.cloud/1/{{ $tinymceApiKey }}/tinymce/7/tinymce.min.js"
    <script>
        tinymce.init({
            selector: '#content',
            plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            toolbar_mode: 'floating',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
        });
    </script>
</x-layouts.app>
