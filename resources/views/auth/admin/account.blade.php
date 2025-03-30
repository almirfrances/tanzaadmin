<x-layouts.app>

    <x-partials.breadcrumb
    :items="[
        ['name' => 'Home', 'url' => route('admin.dashboard')],
        ['name' => 'Profile'],
        ['name' => 'Account']
    ]"
    style="style1"
/>

    <div class="container-xxl flex-grow-1 container-p-y">
       <div class="py-3">
        <h4 class="mb-2">Account Settings</h4>
        <p class="mb-4 text-muted">Manage your personal account information here. You can update your profile details, contact information, and account status. Make sure all information is accurate before saving.</p>

       </div>
        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-pills flex-column flex-md-row mb-4">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('admin.profile.account.view') }}">
                            <i class="ti-xs ti ti-users me-1"></i> Account
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.profile.security.index') }}">
                            <i class="ti-xs ti ti-lock me-1"></i> Security
                        </a>
                    </li>
                </ul>

                <div class="card">
                    <h5 class="card-header">Profile Details</h5>
                    <div class="card-body">
                        <form action="{{ route('admin.profile.account.update') }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <x-form.input-text id="name" name="name" label="Name" value="{{ $admin->name }}" required="true" />
                                    <small class="form-text text-muted">Enter your full name as it appears on official documents.</small>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <x-form.input-text id="username" name="username" label="Username" value="{{ $admin->username }}" required="true" />
                                    <small class="form-text text-muted">Choose a unique username for your account.</small>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <x-form.input-text id="phone" name="phone" label="Phone" value="{{ $admin->phone }}" required="true" />
                                    <small class="form-text text-muted">Provide a valid phone number for contact purposes.</small>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <x-form.input-email id="email" name="email" label="Email" value="{{ $admin->email }}" required="true" />
                                    <small class="form-text text-muted">Enter your email address to receive notifications.</small>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <x-form.select id="status" name="status" label="Status" :options="['active' => 'Active', 'inactive' => 'Inactive']" :value="$admin->status" required="true" />
                                    <small class="form-text text-muted">Set your account status as Active or Inactive.</small>
                                </div>
                            </div>

                            <div class="mt-2">
                                <x-partials.button type="primary" label="Save Changes" />
                                <x-partials.button type="secondary" label="Cancel" isLabelButton="true" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
