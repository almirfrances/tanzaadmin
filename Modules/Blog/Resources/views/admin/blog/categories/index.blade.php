<x-layouts.app>
    @section('title', 'Manage Categories')

    <x-partials.breadcrumb
        :items="[
            ['name' => 'Home', 'url' => route('admin.dashboard')],
            ['name' => 'Blog', 'url' => route('admin.blog.index')],
            ['name' => 'Manage Categories'],
        ]"
        style="style1"
    />

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="mb-4">Blog Categories</h4>
        <p class="text-muted">Create, edit, or delete blog categories.</p>

        <div class="card mt-4 shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createCategoryModal">Add New Category</button>
            </div>

            <div class="card-datatable table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Slug</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->slug }}</td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                        Actions
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <li>
                                            <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editCategoryModal-{{ $category->id }}">
                                                <i class="ti ti-pencil me-2"></i>Edit
                                            </button>
                                        </li>
                                        <li>
                                            <form action="{{ route('admin.blog.category.destroy', $category->id) }}" method="POST">
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
                    <tfoot>
                        <tr>
                            <td colspan="3">
                                {{ $categories->links() }} <!-- Pagination Links -->
                            </td>
                        </tr>
                    </tfoot>
                </table>
                @if ($categories->isEmpty())
                    <div class="text-center py-4">
                        <h5 class="text-muted">No categories found</h5>
                    </div>
                @endif
            </div>
        </div>

        <!-- Create Category Modal -->
        <div class="modal fade" id="createCategoryModal" tabindex="-1" aria-labelledby="createCategoryLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('admin.blog.category.store') }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="createCategoryLabel">Add New Category</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="nameCreate" class="form-label">Category Name</label>
                                <input type="text" class="form-control" id="nameCreate" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="slugCreate" class="form-label">Category Slug</label>
                                <input type="text" class="form-control" id="slugCreate" name="slug" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Create Category</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Edit Category Modal -->
        @foreach ($categories as $category)
        <div class="modal fade" id="editCategoryModal-{{ $category->id }}" tabindex="-1" aria-labelledby="editCategoryLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('admin.blog.category.update', $category->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title" id="editCategoryLabel">Edit Category</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="nameEdit-{{ $category->id }}" class="form-label">Category Name</label>
                                <input type="text" class="form-control" id="nameEdit-{{ $category->id }}" name="name" value="{{ $category->name }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="slugEdit-{{ $category->id }}" class="form-label">Category Slug</label>
                                <input type="text" class="form-control" id="slugEdit-{{ $category->id }}" name="slug" value="{{ $category->slug }}" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const nameInputCreate = document.getElementById('nameCreate');
            const slugInputCreate = document.getElementById('slugCreate');
            nameInputCreate.addEventListener('keyup', function () {
                slugInputCreate.value = this.value.toLowerCase().replace(/[\s\W-]+/g, '-');
            });

            @foreach ($categories as $category)
            const nameInputEdit = document.getElementById('nameEdit-{{ $category->id }}');
            const slugInputEdit = document.getElementById('slugEdit-{{ $category->id }}');
            nameInputEdit.addEventListener('keyup', function () {
                slugInputEdit.value = this.value.toLowerCase().replace(/[\s\W-]+/g, '-');
            });
            @endforeach
        });
        </script>


</x-layouts.app>
