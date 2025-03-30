<li class="menu-item btn-page-block-overlay waves-effect waves-light {{ $active ? 'active' : '' }}">
    <a href="{{ $route ? route($route) : '#' }}" class="menu-link">
        <i class="menu-icon tf-icons {{ $icon }}"></i>
        <div data-i18n="{{ $label }}">{{ $label }}</div>
    </a>
</li>
