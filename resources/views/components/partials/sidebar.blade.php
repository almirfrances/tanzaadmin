<!-- Menu -->

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
      <a href="/" class="app-brand-link">
        @isModule('Settings')
        <span class="app-brand-logo">
            <img src="{{ asset('storage/' . $settings['favicon']) }}" style="width: auto; height: 32px;">
          </span>
          @endisModule
        <span class="app-brand-text demo menu-text fw-bold">{{ config('app.name') }}</span>
      </a>

      <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
        <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
        <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
      </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
      <!-- Dashboards -->
      <x-partials.sidebar-menu-item route="admin.dashboard" icon="ti ti-dashboard" label="Dashboard" />

              <!-- Dynamic module menus -->
        @foreach (Nwidart\Modules\Facades\Module::all() as $module)
            @if ($module->isEnabled())
                @php
                    $moduleSidebarPath = $module->getPath() . '/resources/views/partials/sidebar.blade.php';
                @endphp
                @if (file_exists($moduleSidebarPath))
                    @includeIf($module->getLowerName() . '::partials.sidebar')
                @endif
            @endif
        @endforeach

    <li class="menu-header small text-uppercase">
        <span class="menu-header-text" data-i18n="Modules Management">Modules Management</span>
    </li>
    <x-partials.sidebar-menu-item route="admin.modules.index" icon="ti ti-plug-connected" label="Modules" />





    </ul>
  </aside>
  <!-- / Menu -->
