<x-layouts.app>
    @section('title', 'Manage Posts')

    <x-partials.breadcrumb
        :items="[
            ['name' => 'Home', 'url' => route('admin.dashboard')],
            ['name' => 'Blog', 'url' => route('admin.blog.index')],
            ['name' => 'Manage Posts'],
        ]"
        style="style1"
    />

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="mb-4">Blog Posts</h4>
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <button class="btn btn-primary" onclick="window.location='{{ route('admin.blog.create') }}'">Add New Post</button>
                <form method="GET" action="{{ route('admin.blog.index') }}" class="row g-3 align-items-center">
                    <div class="col-auto">
                        <input type="text" class="form-control" name="search" placeholder="Search by title" value="{{ request('search') }}">
                    </div>
                    <div class="col-auto">
                        <select class="form-select" name="status">
                            <option value="">All Statuses</option>
                            <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Published</option>
                            <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                        </select>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-secondary">Filter</button>
                    </div>
                </form>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Tags</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $post)
                        <tr>
                            <td>
                                <img src="{{ asset('storage/' . $post->featured_image) }}" alt="Featured Image" class="img-fluid" style="width: 60px; height: 60px; object-fit: cover;">
                            </td>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->category->name ?? 'Uncategorized' }}</td>
                            <td>{{ $post->tags->pluck('name')->join(', ') }}</td>
                            <td>
                                <span class="badge {{ $post->status == 'published' ? 'bg-success' : 'bg-warning' }}">
                                    {{ ucfirst($post->status) }}
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                        Actions
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <li>
                                            <a href="{{ route('admin.blog.edit', $post->id) }}" class="dropdown-item" >
                                                <i class="ti ti-pencil me-2"></i>Edit
                                            </a>
                                        </li>
                                        <li>
                                            <form action="{{ route('admin.blog.destroy', $post->id) }}" method="POST">
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
                        @endforeach
                    </tbody>
                </table>
                {{ $posts->appends(request()->query())->links() }} <!-- Pagination with query string -->
            </div>
        </div>
    </div>
</x-layouts.app>
