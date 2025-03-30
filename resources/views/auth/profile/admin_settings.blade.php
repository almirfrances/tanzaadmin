<x-layouts.app>

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Account Settings /</span> Account</h4>

        <ul class="nav nav-pills flex-column flex-md-row mb-4">
            <li class="nav-item">
                <a class="nav-link active" href="javascript:void(0);"><i class="ti-xs ti ti-users me-1"></i> Account</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href=""><i class="ti-xs ti ti-lock me-1"></i> Security</a>
            </li>
        </ul>

        <!-- Profile Details -->
        <div class="card mb-4">
            <h5 class="card-header">Profile Details</h5>
            <div class="card-body">
                <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <x-form.input-text id="name" name="name" label="First Name" :value="auth()->user()->name" required="true" />
                        </div>

                        <div class="col-md-6">
                            <x-form.input-email id="email" name="email" label="Email" :value="auth()->user()->email" required="true" />
                        </div>
                        <div class="col-md-6">
                            <x-form.input-text id="phone" name="phone" label="Phone Number" :value="auth()->user()->phone" />
                        </div>
                    </div>

                    <div class="mt-3">
                        <x-partials.button type="primary" label="Save changes" />
                        <x-partials.button type="secondary" label="Cancel" isLabelButton="true" />
                    </div>
                </form>
            </div>
        </div>

        <!-- Delete Account -->
        <div class="card">
            <h5 class="card-header">Delete Account</h5>
            <div class="card-body">
                <div class="alert alert-warning">
                    <h5 class="alert-heading mb-1">Are you sure you want to delete your account?</h5>
                    <p class="mb-0">Once you delete your account, there is no going back. Please be certain.</p>
                </div>
                <form action="{{ route('profile.delete') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <x-form.checkbox id="confirm-deactivation" name="confirm_deactivation" label="I confirm my account deactivation" required="true" />
                    <x-partials.button type="danger" label="Deactivate Account" />
                </form>
            </div>
        </div>
    </div>





</x-layouts.app>
