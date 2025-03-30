<x-layouts.app>
    @section('title', 'Manage Users')

    <x-partials.breadcrumb
        :items="[
            ['name' => 'Home', 'url' => route('admin.dashboard')],
            ['name' => 'Settings', 'url' => route('admin.settings.index')],
            ['name' => 'Manage Users'],
        ]"
        style="style1"
    />

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="mb-4">Manage Users</h4>
        <p class="text-muted">Edit or delete users from the system.</p>

        <div class="card mt-4 shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <!-- Search Form -->
                <form action="{{ route('admin.users.index') }}" method="GET" class="d-flex w-100">
                    <input type="text" name="search" class="form-control" placeholder="Search users..."
                        value="{{ request()->get('search') }}">
                    <button type="submit" class="btn btn-secondary ms-2">Search</button>
                </form>
            </div>

            <div class="card-datatable table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                @php

                                $bgColor = '#' . substr(md5($user->name ?? 'A'), 0, 6);

                                // Calculate luminance to determine appropriate text color
                                $r = hexdec(substr($bgColor, 1, 2));
                                $g = hexdec(substr($bgColor, 3, 2));
                                $b = hexdec(substr($bgColor, 5, 2));
                                $textColor = ($r * 0.299 + $g * 0.587 + $b * 0.114) > 186 ? '#000' : '#fff';
                                @endphp
                                <td class="d-flex align-items-center">
                                    <span
                                        class="avatar-initials rounded-circle d-flex justify-content-center align-items-center"
                                        style="background-color: {{ $bgColor }}; width: 40px; height: 40px; font-size: 18px; font-weight: bold; color: {{ $textColor }};">
                                        {{ strtoupper($user->name[0] ?? 'A') }}
                                    </span>
                                    <span class="ms-2"> <strong>{{ $user->name }}</strong> </span>


                                </td>
                                <td>{{ $user->phone }}</td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <span class="badge {{ $user->status === 'active' ? 'bg-success' : 'bg-danger' }}">
                                        {{ ucfirst($user->status) }}
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
                                                <!-- Edit Button Opens Edit Modal -->
                                                <button class="dropdown-item" data-bs-toggle="modal"
                                                    data-bs-target="#editUserModal-{{ $user->id }}">
                                                    <i class="ti ti-pencil me-2"></i>Edit
                                                </button>
                                            </li>
                                            <li>
                                                <form action="{{ route('admin.users.destroy', $user->id) }}"
                                                    method="POST">
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

                            <!-- Edit Modal -->
                            <div class="modal fade" id="editUserModal-{{ $user->id }}" tabindex="-1"
                                aria-labelledby="editUserLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content p-3">
                                        <div class="modal-body">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                            <div class="text-center mb-4">
                                                <h3>Edit User</h3>
                                                <p class="text-muted">Update the details of this user.</p>
                                            </div>
                                            <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <x-form.input-text id="name" name="name" label="Name"
                                                            :value="$user->name" required="true" />
                                                        <small class=" text-muted">Enter the full name of the user.</small>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <x-form.input-text id="username" name="username"
                                                            label="Username" :value="$user->username"
                                                            required="true" />
                                                        <small class=" text-muted">Choose a unique username for the
                                                            user.</small>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <x-form.input-text id="phone" name="phone" label="Phone"
                                                            :value="$user->phone" required="true" />
                                                        <small class=" text-muted">Enter a valid phone number for
                                                            contact.</small>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <x-form.input-email id="email" name="email" label="Email"
                                                            :value="$user->email" disabled="true" />
                                                        <small class=" text-muted">Email cannot be updated.</small>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label for="status" class="form-label">Status</label>
                                                        <!-- Hidden input to send 'inactive' if the checkbox is unchecked -->
                                                        <input type="hidden" name="status" value="inactive">
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input" type="checkbox" id="status" name="status" value="active"
                                                                {{ $user->status === 'active' ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="status">
                                                                {{ $user->status === 'active' ? 'Active' : 'Inactive' }}
                                                            </label>
                                                        </div>
                                                        <small class="text-muted">Toggle the user's account status.</small>
                                                    </div>
                                                </div>

                                                <div class="text-center mt-4">
                                                    <x-partials.button type="primary" label="Save Changes" />
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
                @if ($users->isEmpty())
                    <div class="text-center py-4">
                        <h5 class="text-muted">No users found</h5>
                    </div>
                @endif
                <div class="d-flex justify-content-center mt-4">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
