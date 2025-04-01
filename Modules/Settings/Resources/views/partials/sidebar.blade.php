<li class="menu-header small text-uppercase">
    <span class="menu-header-text" data-i18n="Settings & Configurations">Settings & Configurations</span>
</li>
{{-- <x-partials.sidebar-menu-item route="admin.settings*" icon="ti ti-settings" label="Settings" /> --}}
@php
    $adminPrefix = config('admin.route_prefix', 'admin');
@endphp
<li class="menu-item btn-page-block-overlay waves-effect waves-light {{ request()->is($adminPrefix . '/settings*') ? 'active' : '' }}">
    <a href="{{ route('admin.settings.index') }}" class="menu-link">
        <i class="menu-icon tf-icons ti ti-settings"></i>
        <div data-i18n="Settings">Settings</div>
    </a>
</li>
