          <!-- Menu -->
          <aside id="layout-menu" class="layout-menu-horizontal menu-horizontal menu bg-menu-theme flex-grow-0">
            <div class="container-xxl d-flex h-100">
              <ul class="menu-inner">
                <x-partials.sidebar-menu-item route="user.dashboard" icon="ti ti-dashboard" label="Dashboard" />
                   <!-- Dynamic module menus -->
                @foreach (Nwidart\Modules\Facades\Module::all() as $module)
                    @if ($module->isEnabled())
                        @php
                            $moduleSidebarPath = $module->getPath() . '/resources/views/partials/menu.blade.php';
                        @endphp
                        @if (file_exists($moduleSidebarPath))
                            @includeIf($module->getLowerName() . '::partials.menu')
                        @endif
                    @endif
                @endforeach


              </ul>
            </div>
          </aside>
          <!-- / Menu -->
