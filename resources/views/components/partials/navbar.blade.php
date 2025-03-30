@php
// Retrieve the authenticated admin using the 'admin' guard
$admin = Auth::guard('admin')->user();

// Generate a background color based on the hashed name
$bgColor = '#' . substr(md5($admin->name ?? 'A'), 0, 6);

// Calculate luminance to determine appropriate text color
$r = hexdec(substr($bgColor, 1, 2));
$g = hexdec(substr($bgColor, 3, 2));
$b = hexdec(substr($bgColor, 5, 2));
$textColor = ($r * 0.299 + $g * 0.587 + $b * 0.114) > 186 ? '#000' : '#fff';
@endphp
<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
    id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="ti ti-menu-2 ti-sm"></i>
        </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">



        <ul class="navbar-nav flex-row align-items-center ms-auto">



            @isModule('Settings')
             <!-- Backup Icon -->
             <li class="nav-item dropdown-notifications navbar-dropdown  me-3 me-xl-1">
                <a class="nav-link position-relative" href="{{ route('admin.backups.index') }}" data-bs-toggle="tooltip" data-bs-placement="bottom"
                    title="Backup">
                    <i class="ti ti-database-export ti-md"></i>
                </a>
            </li>

            <!-- Clear Cache Icon -->
            <li class="nav-item dropdown-notifications navbar-dropdown me-3 me-xl-1">
                <a class="nav-link position-relative" href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="bottom"
                   title="Clear Cache" onclick="submitClearCacheForm()">
                    <i class="ti ti-refresh ti-md"></i>
                </a>
            </li>
                    <!-- Hidden form for Clear Cache -->
                <form id="clearCacheForm" action="{{ route('admin.settings.clear-cache') }}" method="POST" style="display: none;">
                    @csrf
                </form>

                <script>
                    // Function to submit the hidden clear cache form
                    function submitClearCacheForm() {
                        document.getElementById('clearCacheForm').submit();
                    }
                </script>
            @endisModule


             <!-- Messages Notification -->
             <li class="nav-item dropdown-notifications navbar-dropdown dropdown me-3 me-xl-1">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown"
                    data-bs-auto-close="outside" aria-expanded="false" data-bs-toggle="tooltip"
                    data-bs-placement="bottom" title="Notifications">
                    <i class="ti ti-bell ti-md"></i>
                    <span class="badge bg-danger rounded-pill badge-notifications">12</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end py-0">
                    <li class="dropdown-menu-header border-bottom">
                        <div class="dropdown-header d-flex align-items-center py-3">
                            <h5 class="text-body mb-0 me-auto">Messages</h5>
                            <a href="#" class="dropdown-notifications-all text-body" data-bs-toggle="tooltip"
                                data-bs-placement="top" title="Mark all as read">
                                <i class="ti ti-mail-opened fs-4"></i>
                            </a>
                        </div>
                    </li>
                    <li class="dropdown-notifications-list scrollable-container">
                        <ul class="list-group list-group-flush">
                            {{-- Uncomment and populate this section with dynamic messages --}}
                            {{-- @foreach ($messages->where('is_opened', false) as $message) --}}
                            {{-- <li class="list-group-item list-group-item-action dropdown-notifications-item"> --}}
                            {{-- <div class="d-flex"> --}}
                            {{-- <div class="flex-grow-1"> --}}
                            {{-- <h6 class="mb-1">{{ $message->name }}</h6> --}}
                            {{-- <p class="mb-0">{{ Str::limit($message->message, 50) }}</p> --}}
                            {{-- <small class="text-muted">{{ $message->created_at->diffForHumans() }}</small> --}}
                            {{-- </div> --}}
                            {{-- <div class="flex-shrink-0 dropdown-notifications-actions"> --}}
                            {{-- <a href="{{ route('admin.messages.show', $message->id) }}"
                            class="dropdown-notifications-read"> --}}
                            {{-- <span class="badge badge-dot"></span> --}}
                            {{-- </a> --}}
                            {{-- <a href="{{ route('admin.messages.destroy', $message->id) }}"
                            class="dropdown-notifications-archive"> --}}
                            {{-- <span class="ti ti-x"></span> --}}
                            {{-- </a> --}}
                            {{-- </div> --}}
                            {{-- </div> --}}
                            {{-- </li> --}}
                            {{-- @endforeach --}}
                        </ul>
                    </li>
                    <li class="dropdown-menu-footer border-top">
                        <a href="#"
                            class="dropdown-item d-flex justify-content-center text-primary p-2 h-px-40 mb-1 align-items-center">
                            View all messages
                        </a>
                    </li>
                </ul>
            </li>
            <!--/ Messages Notification -->

            <!-- User -->
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                        <span class="avatar-initials rounded-circle d-flex justify-content-center align-items-center"
                            style="background-color: {{ $bgColor }}; width: 40px; height: 40px; font-size: 18px; font-weight: bold; color: {{ $textColor }};">
                            {{ strtoupper($admin->name[0] ?? 'A') }}
                        </span>
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="#">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar avatar-online">
                                        <span
                                            class="avatar-initials rounded-circle d-flex justify-content-center align-items-center"
                                            style="background-color: {{ $bgColor }}; width: 40px; height: 40px; font-size: 18px; font-weight: bold; color: {{ $textColor }};">
                                            {{ strtoupper($admin->name[0] ?? 'A') }}
                                        </span>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <span class="fw-medium d-block">{{ $admin->name }}</span>
                                    <small class="text-muted">{{ $admin->username }}</small>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('admin.profile.account.view') }}">
                            <i class="ti ti-user-check me-2 ti-sm"></i>
                            <span class="align-middle">My Profile</span>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="javascript:void(0);">
                            <i class="ti ti-settings me-2 ti-sm"></i>
                            <span class="align-middle">Settings</span>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <a class="dropdown-item btn-page-block-overlay waves-effect waves-light" href="#"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="ti ti-logout me-2 ti-sm"></i>
                            <span class="align-middle">Log Out</span>
                        </a>
                        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </li>
        </ul>

    </div>


</nav>
