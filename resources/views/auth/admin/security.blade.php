<x-layouts.app>
    <x-partials.breadcrumb
    :items="[
        ['name' => 'Home', 'url' => route('admin.dashboard')],
        ['name' => 'Profile'],
        ['name' => 'Security']
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
                        <a class="nav-link " href="{{ route('admin.profile.account.view') }}">
                            <i class="ti-xs ti ti-users me-1"></i> Account
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active"  href="{{ route('admin.profile.security.index') }}">
                            <i class="ti-xs ti ti-lock me-1"></i> Security
                        </a>
                    </li>
                </ul>

                <div class="card">
                    <h5 class="card-header">Profile Details</h5>
                    <div class="card-body">
                        <form action="{{ route('admin.profile.security.update') }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="mb-3 col-md-6 form-password-toggle">
                                    <label class="form-label" for="currentPassword">Current Password</label>
                                    <div class="input-group input-group-merge">
                                        <input class="form-control" type="password" name="currentPassword" id="currentPassword" placeholder="············" required>
                                        <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                                    </div>
                                    @error('currentPassword')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-md-6 form-password-toggle">
                                    <label class="form-label" for="newPassword">New Password</label>
                                    <div class="input-group input-group-merge">
                                        <input class="form-control" type="password" name="newPassword" id="newPassword" placeholder="············" required>
                                        <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                                    </div>
                                    @error('newPassword')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6 form-password-toggle">
                                    <label class="form-label" for="confirmPassword">Confirm New Password</label>
                                    <div class="input-group input-group-merge">
                                        <input class="form-control" type="password" name="confirmPassword" id="confirmPassword" placeholder="············" required>
                                        <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                                    </div>
                                    @error('confirmPassword')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 mb-4">
                                <h6>Password Requirements:</h6>
                                <ul class="ps-3 mb-0">
                                    <li class="mb-1">Minimum 8 characters long - the more, the better</li>
                                    <li class="mb-1">At least one lowercase character</li>
                                    <li>At least one number or symbol</li>
                                </ul>
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
