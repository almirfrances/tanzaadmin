<div class="demo-inline-spacing">
    <x-partials.button type="primary" label="Primary" />
    <x-partials.button type="secondary" label="Secondary" />
    <x-partials.button type="success" label="Success" />
    <x-partials.button type="danger" label="Danger" />
    <x-partials.button type="warning" label="Warning" />
    <x-partials.button type="info" label="Info" />
    <x-partials.button type="dark" label="Dark" />
</div>

<div class="demo-inline-spacing">
    <x-partials.button type="primary" label="Primary" isLabelButton="true" />
    <x-partials.button type="secondary" label="Secondary" isLabelButton="true" />
    <x-partials.button type="success" label="Success" isLabelButton="true" />
    <x-partials.button type="danger" label="Danger" isLabelButton="true" />
    <x-partials.button type="warning" label="Warning" isLabelButton="true" />
    <x-partials.button type="info" label="Info" isLabelButton="true" />
    <x-partials.button type="dark" label="Dark" isLabelButton="true" />
</div>


<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Account Settings /</span> Security</h4>

    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-pills flex-column flex-md-row mb-4">
                <li class="nav-item">
                    <a class="nav-link" href="pages-account-settings-account.html"><i
                            class="ti-xs ti ti-users me-1"></i> Account</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="javascript:void(0);"><i class="ti-xs ti ti-lock me-1"></i>
                        Security</a>
                </li>

            </ul>
            <!-- Change Password -->
            <div class="card mb-4">
                <h5 class="card-header">Change Password</h5>
                <div class="card-body">
                    <form id="formAccountSettings" method="GET" onsubmit="return false"
                        class="fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate">
                        <div class="row">
                            <div class="mb-3 col-md-6 form-password-toggle fv-plugins-icon-container">
                                <label class="form-label" for="currentPassword">Current Password</label>
                                <div class="input-group input-group-merge has-validation">
                                    <input class="form-control" type="password" name="currentPassword"
                                        id="currentPassword" placeholder="············">
                                    <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                                </div>
                                <div
                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6 form-password-toggle fv-plugins-icon-container">
                                <label class="form-label" for="newPassword">New Password</label>
                                <div class="input-group input-group-merge has-validation">
                                    <input class="form-control" type="password" id="newPassword" name="newPassword"
                                        placeholder="············">
                                    <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                                </div>
                                <div
                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                </div>
                            </div>

                            <div class="mb-3 col-md-6 form-password-toggle fv-plugins-icon-container">
                                <label class="form-label" for="confirmPassword">Confirm New Password</label>
                                <div class="input-group input-group-merge has-validation">
                                    <input class="form-control" type="password" name="confirmPassword"
                                        id="confirmPassword" placeholder="············">
                                    <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                                </div>
                                <div
                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                </div>
                            </div>
                            <div class="col-12 mb-4">
                                <h6>Password Requirements:</h6>
                                <ul class="ps-3 mb-0">
                                    <li class="mb-1">Minimum 8 characters long - the more, the better</li>
                                    <li class="mb-1">At least one lowercase character</li>
                                    <li>At least one number, symbol, or whitespace character</li>
                                </ul>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary me-2 waves-effect waves-light">Save
                                    changes</button>
                                <button type="reset" class="btn btn-label-secondary waves-effect">Cancel</button>
                            </div>
                        </div>
                        <input type="hidden">
                    </form>
                </div>
            </div>
            <!--/ Change Password -->


            <!-- Recent Devices -->
            <div class="card mb-4">
                <h5 class="card-header">Recent Devices</h5>
                <div class="table-responsive">
                    <table class="table border-top">
                        <thead>
                            <tr>
                                <th class="text-truncate">Browser</th>
                                <th class="text-truncate">Device</th>
                                <th class="text-truncate">Location</th>
                                <th class="text-truncate">Recent Activities</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            <tr>
                                <td class="text-truncate">
                                    <i class="ti ti-brand-windows text-info me-2 ti-sm"></i>
                                    <span class="fw-medium">Chrome on Windows</span>
                                </td>
                                <td class="text-truncate">HP Spectre 360</td>
                                <td class="text-truncate">Switzerland</td>
                                <td class="text-truncate">10, July 2021 20:07</td>
                            </tr>
                            <tr>
                                <td class="text-truncate">
                                    <i class="ti ti-device-mobile text-danger me-2 ti-sm"></i>
                                    <span class="fw-medium">Chrome on iPhone</span>
                                </td>
                                <td class="text-truncate">iPhone 12x</td>
                                <td class="text-truncate">Australia</td>
                                <td class="text-truncate">13, July 2021 10:10</td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
            <!--/ Recent Devices -->
        </div>
    </div>
</div>
